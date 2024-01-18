<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PwdController;
use App\Http\Controllers\TeamsController;

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
})->name('welcome');

// page affichage des mots de passes
Route::get('/dashboard' ,
    [PwdController::class, 'show']
)->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Page d'ajout d'un mot de passe
Route::get('/addpassword', function () {
    return view('addpassword');
})->name('addpassword');

// Request pour ajout de mot de passe
Route::post('/addpasswordreq', [
    PwdController::class, 'addPasswordRequest'
])->name('addpasswordreq');

// Page modifier mot de passe : 
Route::get('/editpassword/{id}', [PwdController::class, 'getPasswordToEdit'])->name('editpassword.getpwd');

Route::post('/editpasswordreq/{id}', [PwdController::class, 'editPassword'])->name('editpassword.updatepwd');

// afficher les teams
Route::get('/teams', 
    [TeamsController::class, 'show']
)->name('teams.view');
// creer une team
Route::post('/teams', [
    TeamsController::class, 'createTeam'
])->name('teams.createTeam');

// Page pour ajouter un membre
Route::get('/addmember/{id}', [TeamsController::class, 'addMemberView'])->name('addmember.getusers');
Route::post('/addmemberreq/{id}', [TeamsController::class, 'addMember'])->name('addmember.add');
// lier une team
Route::post('/linkpwdteam/{id}', [TeamsController::class, 'linkPwdWithTeam'])->name('linkpwdteam.add');

// download of password
Route::get('/password/download', [PwdController::class, 'download'])->name('password.download');



require __DIR__.'/auth.php';