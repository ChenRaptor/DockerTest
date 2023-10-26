<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

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

Route::get('/form', function () {
    return view('form');
});

Route::get('/showpassword', [LoginController::class, 'show']);
Route::post('/logincontroller', [LoginController::class, 'store']);
Route::get('/changepassword/{id}', [PasswordController::class, 'editPassword']);
Route::post('/changepassword/{id}', [PasswordController::class, 'editPasswordInDB']);
Route::post('/changepassword/{id}', [PasswordController::class, 'editPasswordInDB']);


Route::get('/teams', [TeamController::class, 'show']);
Route::post('/teams/add', [TeamController::class, 'create']);
Route::get('/teams/{id}', [TeamController::class, 'team']);
Route::post('/teams/{id_team}/add-member/{id_member_added}', [TeamController::class, 'addMember']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
