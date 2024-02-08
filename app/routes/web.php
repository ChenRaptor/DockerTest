<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\TeamController;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/passwords', [PasswordController::class, 'getAllUserPasswords'])->name("password.show");
    Route::get('/passwords/{id}/update', [PasswordController::class, 'getUserPassword'])->name("password.get");
    Route::get('/passwords/download', [PasswordController::class, 'download'])->name("password.download");

    Route::post('/passwords/store', [PasswordController::class, 'storeUserPassword'])->name("password.stores");
    Route::post('/passwords/{id}/update/password', [PasswordController::class, 'updatePassword'])->name("password.updatePassword");
    Route::post('/passwords/{id}/update/team', [PasswordController::class, 'updateTeam'])->name("password.updateTeam");

    Route::get('/teams', [TeamController::class, 'show'])->name("teams.show");
    Route::get('/teams/{id}/get', [TeamController::class, 'invitation'])->name("teams.get");
    
    Route::post('/teams/store', [TeamController::class, 'createNewTeam'])->name("team.store");
    Route::post('/teams/{id}/update', [TeamController::class, 'addUsersToTeam'])->name("team.invite");
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [PageController::class, 'home'])->name("home");
Route::get('/dashboard', [PageController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
