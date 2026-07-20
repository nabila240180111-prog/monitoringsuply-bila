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

        $realPorts = [
            'id' => [
                ['name' => 'Port of Tanjung Priok (Jakarta)', 'latitude' => -6.1033, 'longitude' => 106.8792],
                ['name' => 'Port of Tanjung Perak (Surabaya)', 'latitude' => -7.2025, 'longitude' => 112.7275],
                ['name' => 'Port of Belawan (Medan)', 'latitude' => 3.7875, 'longitude' => 98.6925],
                ['name' => 'Port of Makassar (Soekarno-Hatta)', 'latitude' => -5.1264, 'longitude' => 119.4125],
                ['name' => 'Port of Teluk Bayur (Padang)', 'latitude' => -0.9997, 'longitude' => 100.3803],
                ['name' => 'Port of Boom Baru (Palembang)', 'latitude' => -2.9839, 'longitude' => 104.7828],
                ['name' => 'Port of Pontianak', 'latitude' => -0.0150, 'longitude' => 109.3400],
                ['name' => 'Port of Trisakti (Banjarmasin)', 'latitude' => -3.3244, 'longitude' => 114.5689],
                ['name' => 'Port of Semayang (Balikpapan)', 'latitude' => -1.2725, 'longitude' => 116.8083],
                ['name' => 'Port of Bitung', 'latitude' => 1.4422, 'longitude' => 125.1878],
                ['name' => 'Port of Sorong', 'latitude' => -0.8711, 'longitude' => 131.2514],
                ['name' => 'Port of Jayapura', 'latitude' => -2.5317, 'longitude' => 140.7058],
                ['name' => 'Port of Dumai', 'latitude' => 1.6833, 'longitude' => 101.4500],
                ['name' => 'Port of Batam Center', 'latitude' => 1.1306, 'longitude' => 104.0531],
                ['name' => 'Port of Benoa (Bali)', 'latitude' => -8.7453, 'longitude' => 115.2158],
                ['name' => 'Port of Tenau (Kupang)', 'latitude' => -10.1839, 'longitude' => 123.5186],
            ],
            'sg' => [
                ['name' => 'Port of Singapore (Keppel)', 'latitude' => 1.2640, 'longitude' => 103.8400],
                ['name' => 'Jurong Port', 'latitude' => 1.3117, 'longitude' => 103.7083],
                ['name' => 'Port of Singapore (Tuas)', 'latitude' => 1.2285, 'longitude' => 103.6265],
            ],
            'my' => [
                ['name' => 'Port Klang (Selangor)', 'latitude' => 3.0000, 'longitude' => 101.4000],
                ['name' => 'Port of Tanjung Pelepas (Johor)', 'latitude' => 1.3653, 'longitude' => 103.5458],
                ['name' => 'Penang Port', 'latitude' => 5.4133, 'longitude' => 100.3475],
                ['name' => 'Bintulu Port (Sarawak)', 'latitude' => 3.2725, 'longitude' => 113.0694],
                ['name' => 'Kota Kinabalu Port (Sabah)', 'latitude' => 5.9922, 'longitude' => 116.0825],
            ],
            'cn' => [
                ['name' => 'Port of Shanghai', 'latitude' => 30.6264, 'longitude' => 122.0644],
                ['name' => 'Port of Shenzhen', 'latitude' => 22.4833, 'longitude' => 113.8833],
                ['name' => 'Port of Ningbo-Zhoushan', 'latitude' => 29.8972, 'longitude' => 121.8483],
                ['name' => 'Port of Guangzhou', 'latitude' => 23.0958, 'longitude' => 113.4386],
                ['name' => 'Port of Qingdao', 'latitude' => 36.0644, 'longitude' => 120.3167],
                ['name' => 'Port of Tianjin', 'latitude' => 38.9833, 'longitude' => 117.7833],
            ],
            'us' => [
                ['name' => 'Port of Los Angeles', 'latitude' => 33.7288, 'longitude' => -118.2620],
                ['name' => 'Port of Long Beach', 'latitude' => 33.7542, 'longitude' => -118.2155],
                ['name' => 'Port of New York & New Jersey', 'latitude' => 40.6692, 'longitude' => -74.1614],
                ['name' => 'Port of Houston', 'latitude' => 29.7439, 'longitude' => -95.1764],
                ['name' => 'Port of Seattle', 'latitude' => 47.6019, 'longitude' => -122.3433],
                ['name' => 'Port of Savannah', 'latitude' => 32.1219, 'longitude' => -81.1367],
            ],
            'nl' => [
                ['name' => 'Port of Rotterdam', 'latitude' => 51.9486, 'longitude' => 4.1444],
                ['name' => 'Port of Amsterdam', 'latitude' => 52.4083, 'longitude' => 4.8667],
            ],
            'jp' => [
                ['name' => 'Port of Tokyo', 'latitude' => 35.6264, 'longitude' => 139.7789],
                ['name' => 'Port of Yokohama', 'latitude' => 35.4525, 'longitude' => 139.6644],
                ['name' => 'Port of Kobe', 'latitude' => 34.6733, 'longitude' => 135.2217],
                ['name' => 'Port of Nagoya', 'latitude' => 35.0500, 'longitude' => 136.8500],
                ['name' => 'Port of Osaka', 'latitude' => 34.6467, 'longitude' => 135.4319],
            ],
            'gb' => [
                ['name' => 'Port of Felixstowe', 'latitude' => 51.9567, 'longitude' => 1.3106],
                ['name' => 'Port of Southampton', 'latitude' => 50.9022, 'longitude' => -1.4042],
                ['name' => 'Port of London', 'latitude' => 51.4636, 'longitude' => 0.3667],
                ['name' => 'Port of Liverpool', 'latitude' => 53.4419, 'longitude' => -3.0181],
            ],
            'de' => [
                ['name' => 'Port of Hamburg', 'latitude' => 53.5358, 'longitude' => 9.9650],
                ['name' => 'Port of Bremerhaven', 'latitude' => 53.5650, 'longitude' => 8.5483],
                ['name' => 'Port of Wilhelmshaven', 'latitude' => 53.5167, 'longitude' => 8.1500],
            ],
            'au' => [
                ['name' => 'Port of Melbourne', 'latitude' => -37.8286, 'longitude' => 144.9125],
                ['name' => 'Port of Sydney (Botany)', 'latitude' => -33.9833, 'longitude' => 151.2167],
                ['name' => 'Port of Brisbane', 'latitude' => -27.3828, 'longitude' => 153.1611],
                ['name' => 'Port of Fremantle (Perth)', 'latitude' => -32.0536, 'longitude' => 115.7417],
                ['name' => 'Port of Adelaide', 'latitude' => -34.8417, 'longitude' => 138.5033],
            ],
            'in' => [
                ['name' => 'Port of Mumbai (JNPT)', 'latitude' => 18.9489, 'longitude' => 72.9467],
                ['name' => 'Port of Chennai', 'latitude' => 13.0908, 'longitude' => 80.2989],
                ['name' => 'Port of Kolkata', 'latitude' => 22.5444, 'longitude' => 88.3239],
                ['name' => 'Port of Mundra', 'latitude' => 22.7397, 'longitude' => 69.7025],
                ['name' => 'Port of Visakhapatnam', 'latitude' => 17.6908, 'longitude' => 83.2842],
            ],
            'kr' => [
                ['name' => 'Port of Busan', 'latitude' => 35.1044, 'longitude' => 129.0433],
                ['name' => 'Port of Incheon', 'latitude' => 37.4525, 'longitude' => 126.5914],
                ['name' => 'Port of Yeosu Gwangyang', 'latitude' => 34.9083, 'longitude' => 127.7019],
            ],
        ];

        foreach ($countries as $country) {
            $iso2Lower = strtolower($country->iso2);
            
            if (isset($realPorts[$iso2Lower])) {
                // Seed real ports
                foreach ($realPorts[$iso2Lower] as $idx => $realPort) {
                    $portCode = strtoupper($country->iso2) . "P" . sprintf("%02d", $idx + 1);
                    \App\Models\Port::updateOrCreate(
                        ['code' => $portCode],
                        [
                            'name' => $realPort['name'],
                            'latitude' => $realPort['latitude'],
                            'longitude' => $realPort['longitude'],
                            'country_id' => $country->id,
                        ]
                    );
                }
            } else {
                // Scatter synthetic ports across a much wider and realistic area instead of tight clumping
                $baseLat = $country->latitude ?? 0;
                $baseLng = $country->longitude ?? 0;

                for ($i = 0; $i < 5; $i++) {
                    $portName = "Port of " . $country->name . " " . $suffixes[$i];
                    $portCode = strtoupper($country->iso2) . "P0" . ($i + 1);

                    // Add a larger random offset (approx 0.5 to 2.5 degrees) for wider scattering
                    $angle = ($i * 2 * M_PI) / 5;
                    $offsetRadius = 0.5 + ($i * 0.4); 
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
}
