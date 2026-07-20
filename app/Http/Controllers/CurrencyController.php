<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        $base = strtoupper($request->input('base', 'USD'));
        $target = strtoupper($request->input('target', 'IDR'));

        // 1. Get Live Rate (ExchangeRate API call or Fallback)
        $rate = $this->getLiveExchangeRate($base, $target);

        // 2. Generate Historical Trend Data (for Chart.js)
        $history = $this->generateSimulatedTrend($rate, $target);

        return response()->json([
            'base' => $base,
            'target' => $target,
            'rate' => $rate,
            'trend' => $history
        ]);
    }

    private function getLiveExchangeRate($base, $target)
    {
        if ($base === $target) {
            return 1.0;
        }

        // Try Open.er-api.com (No token required, completely free)
        try {
            $response = Http::timeout(4)->get("https://open.er-api.com/v6/latest/{$base}");
            if ($response->successful()) {
                $rates = $response->json('rates');
                if (isset($rates[$target])) {
                    return floatval($rates[$target]);
                }
            }
        } catch (\Exception $e) {
            // Fallback below
        }

        return $this->getDefaultRate($target);
    }

    private function getDefaultRate($target)
    {
        $rates = [
            'IDR' => 15600.0,
            'EUR' => 0.92,
            'SGD' => 1.34,
            'MYR' => 4.72,
            'CNY' => 7.23,
            'JPY' => 151.5,
            'GBP' => 0.79,
            'AUD' => 1.52,
            'INR' => 83.3,
            'KRW' => 1340.0,
            'USD' => 1.0
        ];

        return $rates[$target] ?? 1.0;
    }

    private function generateSimulatedTrend($currentRate, $target)
    {
        // Generate last 7 days historical trend data
        $labels = [];
        $values = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('d M');
            $labels[] = $date;

            // Random walk offset
            $offset = (rand(-150, 150) / 10000.0) * $currentRate;
            if ($i === 0) {
                $values[] = round($currentRate, 2);
            } else {
                $values[] = round($currentRate + $offset, 2);
            }
        }

        return [
            'labels' => $labels,
            'values' => $values
        ];
    }
}
