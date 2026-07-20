<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCache;
use App\Models\PositiveWord;
use App\Models\NegativeWord;
use App\Models\Country;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $countryCode = strtolower($request->input('country_code', 'id'));
        $country = Country::where('iso2', $countryCode)->first();
        $countryName = $country ? $country->name : 'Global';

        // 1. Attempt to fetch news (using cached db items or calling external GNews API)
        $cached = NewsCache::where('country_code', $countryCode)->get();
        
        if ($cached->isEmpty()) {
            $this->fetchAndCacheNews($countryCode, $countryName);
            $cached = NewsCache::where('country_code', $countryCode)->get();
        }

        // Calculate aggregate sentiments
        $posCount = 0;
        $negCount = 0;
        $totalArticles = $cached->count();

        foreach ($cached as $item) {
            if ($item->sentiment_label === 'Positive') {
                $posCount++;
            } elseif ($item->sentiment_label === 'Negative') {
                $negCount++;
            }
        }

        $neutralCount = $totalArticles - ($posCount + $negCount);

        return response()->json([
            'country' => $countryName,
            'country_code' => $countryCode,
            'summary' => [
                'total' => $totalArticles,
                'positive_percent' => $totalArticles > 0 ? round(($posCount / $totalArticles) * 100) : 0,
                'negative_percent' => $totalArticles > 0 ? round(($negCount / $totalArticles) * 100) : 0,
                'neutral_percent' => $totalArticles > 0 ? round(($neutralCount / $totalArticles) * 100) : 0,
                'overall_sentiment' => ($posCount > $negCount) ? 'Positive' : (($negCount > $posCount) ? 'Negative' : 'Neutral')
            ],
            'articles' => $cached
        ]);
    }

    private function fetchAndCacheNews($countryCode, $countryName)
    {
        $positiveWords = PositiveWord::pluck('word')->toArray();
        $negativeWords = NegativeWord::pluck('word')->toArray();

        // Check if there is an API key
        $apiKey = env('GNEWS_API_KEY');
        $articles = [];

        if ($apiKey) {
            try {
                $response = Http::timeout(5)->get("https://gnews.io/api/v4/search", [
                    'q' => "{$countryName} AND (logistics OR shipping OR trade OR economy)",
                    'lang' => 'en',
                    'token' => $apiKey,
                    'max' => 6
                ]);
                if ($response->successful()) {
                    $articles = $response->json('articles') ?? [];
                }
            } catch (\Exception $e) {
                // Fallback to simulation
            }
        }

        // Fallback: Simulation news if GNews key is missing or failed
        if (empty($articles)) {
            $articles = [
                [
                    'title' => "New infrastructure projects boost shipping speed in {$countryName}",
                    'description' => "Local governments announced significant expansion for major ports, showing robust growth and profit projection.",
                    'source' => ['name' => 'Maritime Gazette'],
                    'url' => '#',
                    'publishedAt' => now()->subHours(2)->toIso8601String()
                ],
                [
                    'title' => "Inflation crisis causes delay in supply chain exports for {$countryName}",
                    'description' => "Severe inflation rises raw material cost, causing significant export decrease and delay at customs checkpoint due to strikes.",
                    'source' => ['name' => 'SupplyChain Insider'],
                    'url' => '#',
                    'publishedAt' => now()->subHours(6)->toIso8601String()
                ],
                [
                    'title' => "Typhoon storm threatens port closure in {$countryName} waters",
                    'description' => "Severe weather and flood warning in regional maritime sector causes major delay. Shipping vessels are diverted to nearby terminals.",
                    'source' => ['name' => 'Weather Oceanic'],
                    'url' => '#',
                    'publishedAt' => now()->subDays(1)->toIso8601String()
                ],
                [
                    'title' => "Trade tariff agreement yields recovery and stable operations",
                    'description' => "A new trade agreement improves stable export flow, leading to positive profit projection and mutual economic growth.",
                    'source' => ['name' => 'Global Logistics'],
                    'url' => '#',
                    'publishedAt' => now()->subDays(2)->toIso8601String()
                ]
            ];
        }

        foreach ($articles as $art) {
            $title = $art['title'] ?? '';
            $desc = $art['description'] ?? '';
            
            // Perform lexicon based sentiment analysis
            $text = strtolower($title . ' ' . $desc);
            // clean non-alphanumeric characters
            $text = preg_replace('/[^a-z0-9\s]/', '', $text);
            $words = explode(' ', $text);

            $posScore = 0;
            $negScore = 0;

            foreach ($words as $w) {
                if (in_array($w, $positiveWords)) {
                    $posScore++;
                }
                if (in_array($w, $negativeWords)) {
                    $negScore++;
                }
            }

            $label = 'Neutral';
            if ($posScore > $negScore) {
                $label = 'Positive';
            } elseif ($negScore > $posScore) {
                $label = 'Negative';
            }

            NewsCache::create([
                'country_code' => $countryCode,
                'title' => $title,
                'description' => $desc,
                'url' => $art['url'] ?? '#',
                'source' => $art['source']['name'] ?? 'Unknown',
                'published_at' => isset($art['publishedAt']) ? date('Y-m-d H:i:s', strtotime($art['publishedAt'])) : now(),
                'sentiment_positive' => $posScore,
                'sentiment_negative' => $negScore,
                'sentiment_label' => $label
            ]);
        }
    }
}
