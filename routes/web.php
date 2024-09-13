<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HighscoreController;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/highscores', [HighscoreController::class, 'store']);
Route::get('/highscores', [HighscoreController::class, 'index']);
Route::get('/api/top-highscores', [HighScoreController::class, 'getTopHighScores']);
route::get('/{pathMatch}', function(){
    return view('welcome');
})->where('pathMatch',".*") ;