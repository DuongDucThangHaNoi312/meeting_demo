<?php

use App\Http\Controllers\WhiteboardController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::group([
    'prefix' => 'meetings',
    // 'middleware' => 'check-login'
], function () {
    Route::get('/demo',[\App\Http\Controllers\ChimeController::class, 'index']);
    Route::post('/create-meeting', [\App\Http\Controllers\ChimeController::class, 'createMeeting']);
    Route::post('/delete-meeting/{id_meeting}', [\App\Http\Controllers\ChimeController::class, 'endMeeting']);
    Route::get('/wb',[WhiteboardController::class, 'index']);
});
