<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;
use App\Models\Country;

class WatchlistController extends Controller
{
    public function index()
    {
        $items = Watchlist::with('country')->get();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $countryCode = $request->input('country_code');
        $country = Country::where('iso2', strtolower($countryCode))->first();
        
        if (!$country) {
            return response()->json(['error' => 'Country not found'], 404);
        }

        $watchlist = Watchlist::updateOrCreate([
            'country_id' => $country->id,
            'user_id' => null // Public/default user for simple demo
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Country added to favorites/watchlist',
            'data' => $watchlist->load('country')
        ]);
    }

    public function destroy($id)
    {
        $watchlist = Watchlist::where('country_id', $id)->first();
        if ($watchlist) {
            $watchlist->delete();
            return response()->json(['success' => true, 'message' => 'Removed from favorites']);
        }
        
        return response()->json(['error' => 'Watchlist item not found'], 404);
    }
}
