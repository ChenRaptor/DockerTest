<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    // Obtient tous les mots de passe de l'utilisateur actuel
    public function getAllUserPasswords()
    {
        return view('passwords.page', ['datas' => Password::where('user_id', Auth::id())->get()]);
    }

    // Obtient un mot de passe spécifique de l'utilisateur actuel
    public function getUserPassword(int $id)
    {
        $userId = Auth::id();

        // Récupère le mot de passe spécifique pour l'utilisateur actuel
        $password = Password::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Récupère les équipes partagées avec ce mot de passe
        $userTeams = User::findOrFail($userId)->teams;
        $teamsWithPasswordLinked = [];

        foreach ($userTeams as $team) {
            $teamPassword = $team->passwords()->where('id', $id)->first();
            $team->isChecked = !is_null($teamPassword);
            $teamsWithPasswordLinked[] = $team;
        }

        return view('passwords.update.index', [
            'datas' => $password,
            'teams' => $teamsWithPasswordLinked
        ]);
    }

    // Enregistre un nouveau mot de passe pour l'utilisateur actuel
    public function storeUserPassword(Request $request)
    {
        $request->validate([
            'url' => 'required|string|url',
            'login' => 'required|string',
            'pwd' => 'required|string'
        ]);

        $userId = Auth::id();

        Password::create([
            'site' => $request->url,
            'login' => $request->login,
            'password' => $request->pwd,
            'user_id' => $userId,
        ]);

        return redirect()->route('password.show');
    }

    // Met à jour le mot de passe spécifié par l'utilisateur actuel
    public function updatePassword(Request $request, int $id)
    {
        $request->validate([
            'newpassword' => 'required|string'
        ]);

        $password = Password::findOrFail($id);
        $password->password = $request->newpassword;
        $password->save();

        return redirect()->route('password.show');
    }

    // Met à jour les équipes avec lesquelles le mot de passe est partagé
    public function updateTeam(Request $request, int $id)
    {
        $request->validate([
            'team' => 'array'
        ]);

        $user = Auth::user();
        $password = Password::findOrFail($id);

        $teamPassword = $password->teams();
        if ($request->has('team')) {
            $teamPassword->sync(
                array_map('intval', $request->team)
            );
        } else {
            $teamPassword->detach();
        }

        return redirect()->route('password.show');
    }

    // Télécharge les mots de passe de l'utilisateur actuel au format CSV
    public function download()
    {
        $userId = Auth::id();

        $passwords = Password::where('user_id', $userId)->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="passwords.csv"',
        ];

        $callback = function () use ($passwords) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Site Web', 'Identifiant', 'Mot de passe', 'Dernière date de modification', 'Equipe']);

            foreach ($passwords as $password) {
                fputcsv($file, [
                    $password->site,
                    $password->login,
                    $password->password,
                    $password->updated_at,
                    $password->teams->implode('name', ' - ')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
