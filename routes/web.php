<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CreateStudent;
use App\Livewire\UpdateStudent;

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

Route::get('/', function () {
    return view('welcome');
});
Route::view('addStudent','addStudent');
Route::get('addStudent',CreateStudent::class)->name('addStudent');
Route::get('update/{id}',UpdateStudent::class)->name('updateStudent');
