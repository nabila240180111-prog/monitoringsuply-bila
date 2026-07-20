<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PositiveWord;
use App\Models\NegativeWord;
use App\Models\Article;
use App\Models\Watchlist;
use App\Models\Country;
use App\Models\RiskScore;

class SentimentSeeder extends Seeder
{
    public function run(): void
    {
        // Seed default Admin User
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@portbila.com'],
            ['name' => 'Bila Admin', 'password' => bcrypt('password')]
        );

        // 1. Seed Positive Words
        $posWords = ['growth', 'increase', 'profit', 'stable', 'improve', 'success', 'expansion', 'recovery', 'boost', 'gain', 'surplus', 'recovery', 'active', 'safe'];
        foreach ($posWords as $word) {
            PositiveWord::updateOrCreate(['word' => $word]);
        }

        // 2. Seed Negative Words
        $negWords = ['war', 'crisis', 'inflation', 'delay', 'disaster', 'decrease', 'conflict', 'loss', 'deficit', 'sanction', 'tariff', 'closure', 'strike', 'tension', 'bottleneck', 'block', 'storm', 'typhoon', 'rain', 'flood', 'shutdown', 'collapse'];
        foreach ($negWords as $word) {
            NegativeWord::updateOrCreate(['word' => $word]);
        }

        // 3. Seed some default Analysis Articles
        $articles = [
            [
                'title' => 'Global Shipping Bottlenecks: A Study of Tanjung Priok and Singapore',
                'content' => 'In recent months, logistical tensions have risen across major Southeast Asian hubs. Strong trade recovery has led to minor delays in Tanjung Priok, while Singapore remains stable but highly active. Risk scoring remains Low-Medium.',
                'author' => 'Bila Logistics Analyst'
            ],
            [
                'title' => 'Inflation Impact on Manufacturing Cost in Europe',
                'content' => 'Rising inflation rates in Germany and other European countries continue to increase the raw production costs. Importers are suggested to search for alternative shipping lines to minimize cargo delays.',
                'author' => 'Dr. Ziky Al-Ghifari'
            ]
        ];
        foreach ($articles as $article) {
            Article::updateOrCreate(['title' => $article['title']], $article);
        }

        // 4. Seed default Watchlist items (Indonesia, Germany)
        $idCountry = Country::where('iso2', 'id')->first();
        $deCountry = Country::where('iso2', 'de')->first();
        if ($idCountry) {
            Watchlist::updateOrCreate(['country_id' => $idCountry->id]);
        }
        if ($deCountry) {
            Watchlist::updateOrCreate(['country_id' => $deCountry->id]);
        }

        // 5. Seed initial calculated Risk Scores for Indonesia and Germany
        if ($idCountry) {
            RiskScore::updateOrCreate(
                ['country_id' => $idCountry->id],
                [
                    'weather_risk' => 15,
                    'inflation_risk' => 20,
                    'news_risk' => 10,
                    'currency_risk' => 10,
                    'total_risk' => 14, // weighted average
                ]
            );
        }
        if ($deCountry) {
            RiskScore::updateOrCreate(
                ['country_id' => $deCountry->id],
                [
                    'weather_risk' => 10,
                    'inflation_risk' => 35,
                    'news_risk' => 20,
                    'currency_risk' => 15,
                    'total_risk' => 22,
                ]
            );
        }
    }
}
