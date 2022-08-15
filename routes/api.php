<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//C
Route::post('/pacijenti',"App\Http\Controllers\BolnicaController@kreirajPacijenta");
Route::post('/dijagnoze', "App\Http\Controllers\BolnicaController@kreirajDijagnozu");

//R
Route::get('/dijagnoze', "App\Http\Controllers\BolnicaController@prikaziSveDijagnoze");
Route::get('/dijagnoze/{broj_kartona}',"App\Http\Controllers\BolnicaController@prikaziDijagnozuPoBrojuKartona");
Route::get('/pacijenti/{broj_kartona}',"App\Http\Controllers\BolnicaController@prikaziPacijenta");
Route::get('/pacijenti',"App\Http\Controllers\BolnicaController@prikaziPacijente");

//U
Route::patch('/pacijenti/{broj_kartona}','App\Http\Controllers\BolnicaController@izmeniPacijenta');
Route::patch('/dijagnoze/{id}','App\Http\Controllers\BolnicaController@izmeniDijagnozu');

//D
Route::delete('/dijagnoze/{id}', "App\Http\Controllers\BolnicaController@obrisiDijagnozu");
Route::delete('/pacijenti/{broj_kartona}', "App\Http\Controllers\BolnicaController@obrisiPacijenta");
