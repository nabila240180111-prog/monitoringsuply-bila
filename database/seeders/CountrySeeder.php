<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/countries_data.json');
        if (!file_exists($jsonPath)) {
            throw new \Exception("Local countries_data.json not found!");
        }

        $jsonData = json_decode(file_get_contents($jsonPath), true);
        $countries = [];

        foreach ($jsonData as $item) {
            $name = $item['name']['common'] ?? null;
            $iso2 = $item['cca2'] ?? null;
            $iso3 = $item['cca3'] ?? null;
            
            if (!$name || !$iso2) {
                continue;
            }

            $lat = $item['latlng'][0] ?? null;
            $lng = $item['latlng'][1] ?? null;
            
            $capital = isset($item['capital']) && is_array($item['capital']) 
                ? implode(', ', $item['capital']) 
                : null;
                
            $region = $item['region'] ?? null;
            
            $currencyCode = null;
            $currencyName = null;
            if (isset($item['currencies']) && is_array($item['currencies'])) {
                $keys = array_keys($item['currencies']);
                if (!empty($keys)) {
                    $currencyCode = $keys[0];
                    $currencyName = $item['currencies'][$currencyCode]['name'] ?? null;
                }
            }

            $population = $item['population'] ?? null;
            
            // Predefined values for major countries
            $majorData = [
                'id' => ['gdp' => 1370000000000, 'inflation' => 2.8],
                'us' => ['gdp' => 27300000000000, 'inflation' => 3.1],
                'de' => ['gdp' => 4400000000000, 'inflation' => 2.2],
                'cn' => ['gdp' => 17900000000000, 'inflation' => 0.7],
                'sg' => ['gdp' => 500000000000, 'inflation' => 3.5],
                'my' => ['gdp' => 400000000000, 'inflation' => 2.5],
                'jp' => ['gdp' => 4200000000000, 'inflation' => 2.8],
                'gb' => ['gdp' => 3300000000000, 'inflation' => 3.0],
                'au' => ['gdp' => 1700000000000, 'inflation' => 3.6],
                'in' => ['gdp' => 3700000000000, 'inflation' => 4.8],
                'nl' => ['gdp' => 1100000000000, 'inflation' => 3.8],
                'al' => ['gdp' => 19000000000, 'inflation' => 4.0], // Albania
            ];

            $iso2Lower = strtolower($iso2);
            $gdp = null;
            $inflation = null;
            
            if (isset($majorData[$iso2Lower])) {
                $gdp = $majorData[$iso2Lower]['gdp'];
                $inflation = $majorData[$iso2Lower]['inflation'];
            } else {
                // Generates random but realistic values for other countries
                $gdp = rand(5, 500) * 100000000;
                $inflation = rand(15, 80) / 10;
            }

            $countries[] = [
                'name' => $name,
                'iso2' => strtolower($iso2),
                'iso3' => strtolower($iso3),
                'latitude' => $lat,
                'longitude' => $lng,
                'currency_code' => $currencyCode,
                'currency_name' => $currencyName,
                'region' => $region,
                'capital' => $capital,
                'population' => $population,
                'gdp' => $gdp,
                'gdp_growth' => rand(1, 6),
                'inflation' => $inflation,
                'exports' => $gdp * 0.2,
                'imports' => $gdp * 0.18,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Chunk insert to handle large amount of records safely
        $chunks = array_chunk($countries, 50);
        foreach ($chunks as $chunk) {
            foreach ($chunk as $item) {
                \App\Models\Country::updateOrCreate(
                    ['iso2' => $item['iso2']],
                    $item
                );
            }
        }
    }
}
