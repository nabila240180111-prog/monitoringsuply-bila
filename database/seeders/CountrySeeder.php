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
                'gdp' => null,
                'gdp_growth' => null,
                'inflation' => null,
                'exports' => null,
                'imports' => null,
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
