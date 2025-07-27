<?php

use App\Http\Controllers\Hadithcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrayerTimesController;
use App\Http\Controllers\QuranController;

//home
Route::get('/', function () {
    return view('home');
});

// Prayer Times
Route::get('/prayer-times', [PrayerTimesController::class, 'index']);
Route::post('/fetch-prayer-times', [PrayerTimesController::class, 'fetch']);

// Quran
Route::get('/quran', [QuranController::class,"getsurahdata"]);
route::get('/read/{num}',[QuranController::class,"getsurahtext"]);


// hadith
Route::get('/hadith', [Hadithcontroller::class,'gethadith']);
Route::get('/hadith/chapters/{bookslug}', [HadithController::class, 'getHadithChapter'])->name('hadith.chapters');
Route::get('/hadith/chapters/{bookslug}/{chapterNum}', [Hadithcontroller::class, 'readHadiths'])->name('hadith.read');


