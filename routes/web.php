<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HighscoreController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/highscores', [HighscoreController::class, 'store']);

route::get('/{pathMatch}', function(){
    return view('welcome');
})->where('pathMatch',".*") ;