<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FightController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


#Route::post('/updateExperience', 'ExperienceController@updateExperience')->middleware('auth');
Route::post('/updateExperience', [App\Http\Controllers\ExperienceController::class, 'updateExperience'])->middleware('auth');
Route::post('/updateLevel', [App\Http\Controllers\ExperienceController::class, 'updateLevel'])->middleware('auth');
Route::post('/addStat', [App\Http\Controllers\BaseStatsController::class, 'addStatistic'])->middleware('auth');
Route::post('/addMission', [App\Http\Controllers\MissionController::class, 'addToDatabase'])->middleware('auth');

Route::delete('/deleteMission/{playerId}', [App\Http\Controllers\MissionController::class, 'deleteFromDatabase'])->middleware('auth');
Route::get('/sellWeapon', [App\Http\Controllers\WeaponSlotController::class, 'sellWeapon'])->middleware('auth');
Route::get('/buyWeapon', [App\Http\Controllers\WeaponSlotController::class, 'buyWeapon'])->middleware('auth');
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->middleware('auth')->name('shop');
Route::get('/deleteFight', [App\Http\Controllers\FightController::class, 'deleteDb'])->middleware('auth');
//Route::delete('/deleteFight/{playerId}','FightController@delete')->middleware('auth');
//Route::get('/deleteFight', [App\Http\Controllers\FightController::class, 'deleteFightFromDb'])->middleware('auth');//musiałem dać get ponieważ jak było tu delete dostawałem cały czas błąd 405
Route::get('/updateFight', [App\Http\Controllers\FightController::class, 'update'])->middleware('auth');
Route::get('/getFight', [App\Http\Controllers\FightController::class, 'get'])->middleware('auth');
Route::get('/addFight', [App\Http\Controllers\FightController::class, 'add'])->middleware('auth');

Route::delete('/delete-user', [App\Http\Controllers\HomeController::class, 'destroy'])->middleware('auth');
Route::get('/getWeapon', [App\Http\Controllers\WeaponSlotController::class, 'getWeapon'])->middleware('auth');
Route::get('/getMission', [App\Http\Controllers\MissionController::class, 'getFromDatabase'])->middleware('auth');
Route::get('/missions', [App\Http\Controllers\MissionController::class, 'index'])->middleware('auth')->name('missions');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/rank', [App\Http\Controllers\RankController::class, 'index'])->middleware('auth')->name('rank');
Route::get('/getUpdatedStatistics', [App\Http\Controllers\BaseStatsController::class, 'getUpdatedStatistics'])->middleware('auth');
