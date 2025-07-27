<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class QuranController extends Controller
{
    function getsurahdata()
    {
        $surahdata = Http::get("https://api.alquran.cloud/v1/meta");
        return view("quran.index", ["collection" => $surahdata["data"]["surahs"]["references"]]);
    }




    public function getsurahtext($snum)
{
    $surahdata = Http::get("https://api.alquran.cloud/v1/surah/$snum");

    return view("quran.read", [
        'collection' => $surahdata["data"]["ayahs"],
        'snum' => $snum
    ]);
}

}
