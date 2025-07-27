<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PrayerTimesController extends Controller
{
public function index()
    {
        return view('prayer-times.index');
    }

    public function fetch(Request $request)
    {
        $lat = $request->lat;
        $long = $request->long;

        $response = Http::get("http://api.aladhan.com/v1/timings", [
            'latitude' => $lat,
            'longitude' => $long,
            'method' => 2 // ISNA
        ]);

        $data = $response->json();

        return response()->json([
            'timings' => $data['data']['timings'],
            'location' => $data['data']['meta']['timezone'],
            'gregorian' => $data['data']['date']['gregorian']['date'],
            'hijri' => $data['data']['date']['hijri']['date']
        ]);
    }
}
