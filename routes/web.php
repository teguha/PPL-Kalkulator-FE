<?php

use App\Http\Controllers\ProsesController;
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


Route::get('/',[ProsesController::class,'tampil']);

//backend api 
Route::post('/hitung/akar/api',[ProsesController::class,'postApi'])->name('hitung-akar-api');

//backend plsql
Route::post('/hitung/akar/plsql',[ProsesController::class,'postPLSQL'])->name('hitung-akar-plsql');