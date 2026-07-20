<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = \App\Models\Country::select('id', 'name', 'iso2', 'iso3', 'currency_code', 'currency_name', 'latitude', 'longitude')
            ->orderBy('name', 'asc')
            ->get();
            
        return response()->json($countries);
    }
}
