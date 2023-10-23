<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('web.index');
});*/


Route::get('/', [FullCalenderController::class, 'calendar']) -> name('calendar');
Route::get('/calendar/event/create', [FullCalenderController::class, 'createEvent']) -> name('event.create');
Route::post('/calendar/event/store', [FullCalenderController::class, 'storeEvent']) -> name('event.store');
Route::get('/calendar/event/api', [FullCalenderController::class, 'apiEvents']) -> name('event.api');
