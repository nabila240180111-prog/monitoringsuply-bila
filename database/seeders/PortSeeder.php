<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = \App\Models\Country::all();
        $suffixes = ['Alpha', 'Beta', 'Gamma', 'Delta', 'Epsilon'];

        foreach ($countries as $country) {
            $baseLat = $country->latitude ?? 0;
            $baseLng = $country->longitude ?? 0;

            for ($i = 0; $i < 5; $i++) {
                $portName = "Port of " . $country->name . " " . $suffixes[$i];
                $portCode = strtoupper($country->iso2) . "P0" . ($i + 1);

                // Add a small offset so ports don't overlap on the map
                // Offset calculation uses sine and cosine of angles to scatter them around the center
                $angle = ($i * 2 * M_PI) / 5;
                $offsetRadius = 0.15; // roughly 15-20km offset
                $latOffset = $offsetRadius * sin($angle);
                $lngOffset = $offsetRadius * cos($angle);

                \App\Models\Port::updateOrCreate(
                    ['code' => $portCode],
                    [
                        'name' => $portName,
                        'latitude' => $baseLat + $latOffset,
                        'longitude' => $baseLng + $lngOffset,
                        'country_id' => $country->id,
                    ]
                );
            }
        }
    }
}
