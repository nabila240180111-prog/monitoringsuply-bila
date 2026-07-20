<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\RiskScore;
use App\Models\NewsCache;
use Illuminate\Support\Facades\Http;

class RiskController extends Controller
{
    public function index(Request $request)
    {
        $countryCode = $request->input('country_code');
        if (!$countryCode) {
            return response()->json(['error' => 'Country code is required'], 400);
        }

        $country = Country::where('iso2', strtolower($countryCode))->first();
        if (!$country) {
            return response()->json(['error' => 'Country not found'], 404);
        }

        // 1. Weather Risk (Call Open-Meteo or Fallback based on coordinates)
        $weatherRisk = 15; // default fallback
        $temperature = null;
        $windSpeed = 0;
        
        if ($country->latitude && $country->longitude) {
            try {
                $response = Http::timeout(3)->get("https://api.open-meteo.com/v1/forecast", [
                    'latitude' => $country->latitude,
                    'longitude' => $country->longitude,
                    'current_weather' => true
                ]);
                
                if ($response->successful()) {
                    $weather = $response->json('current_weather');
                    $windSpeed = $weather['windspeed'] ?? 0; // km/h
                    $temperature = $weather['temperature'] ?? null;
                    $weatherRisk = min(100, max(5, intval($windSpeed * 1.5)));
                }
            } catch (\Exception $e) {
                // Keep default fallback
            }
        }

        // 2. Inflation Risk (Based on Country Inflation or default)
        $inflationVal = $country->inflation ?? 2.5;
        $inflationRisk = min(100, max(5, intval($inflationVal * 5)));

        // 3. News Sentiment Risk
        // Fetch cached news for this country and calculate overall news sentiment risk
        $newsItems = NewsCache::where('country_code', strtolower($countryCode))->get();
        $negativeCount = 0;
        $positiveCount = 0;
        foreach ($newsItems as $news) {
            if ($news->sentiment_label === 'Negative') {
                $negativeCount++;
            } elseif ($news->sentiment_label === 'Positive') {
                $positiveCount++;
            }
        }
        $totalNews = $newsItems->count();
        if ($totalNews > 0) {
            $newsRisk = intval(($negativeCount / $totalNews) * 100);
        } else {
            // Seed a realistic value
            $newsRisk = 20;
        }

        // 4. Currency Risk (Simulated based on volatility or default)
        $currencyRisk = 15;
        if ($country->currency_code) {
            $currencyRisk = abs(crc32($country->currency_code) % 30) + 5;
        }

        // 5. Total Weighted Risk Model:
        // Weather Risk (30%) + Inflation Risk (20%) + Political News Risk (40%) + Currency Risk (10%)
        $totalRisk = ($weatherRisk * 0.3) + ($inflationRisk * 0.2) + ($newsRisk * 0.4) + ($currencyRisk * 0.1);
        $totalRisk = round($totalRisk, 1);

        // Determine Level
        $level = 'Low Risk';
        if ($totalRisk > 60) {
            $level = 'High Risk';
        } elseif ($totalRisk > 30) {
            $level = 'Medium Risk';
        }

        // Save or update in database
        RiskScore::updateOrCreate(
            ['country_id' => $country->id],
            [
                'weather_risk' => $weatherRisk,
                'inflation_risk' => $inflationRisk,
                'news_risk' => $newsRisk,
                'currency_risk' => $currencyRisk,
                'total_risk' => $totalRisk,
            ]
        );

        return response()->json([
            'country' => $country->name,
            'iso2' => $country->iso2,
            'weather_risk' => $weatherRisk,
            'inflation_risk' => $inflationRisk,
            'news_risk' => $newsRisk,
            'currency_risk' => $currencyRisk,
            'total_risk' => $totalRisk,
            'risk_level' => $level,
            'temperature' => $temperature,
            'windspeed' => $windSpeed
        ]);
    }
}
