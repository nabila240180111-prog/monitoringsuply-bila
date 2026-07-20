<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Port::query();

        if ($request->has('country_id') && !empty($request->input('country_id'))) {
            $query->where('country_id', $request->input('country_id'));
        } elseif ($request->has('country_code') && !empty($request->input('country_code'))) {
            $country = \App\Models\Country::where('iso2', strtolower($request->input('country_code')))->first();
            if ($country) {
                $query->where('country_id', $country->id);
            } else {
                return response()->json([]);
            }
        } else {
            // Default to empty array to prevent heavy loads initially
            return response()->json([]);
        }

        $ports = $query->with('country:id,name,iso2')->get();
        return response()->json($ports);
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        if (strlen($q) < 2) {
            return response()->json([]);
        }

        $ports = \App\Models\Port::where('name', 'like', "%{$q}%")
            ->orWhere('code', 'like', "%{$q}%")
            ->with('country:id,name,iso2')
            ->limit(15)
            ->get();

        return response()->json($ports);
    }
}
