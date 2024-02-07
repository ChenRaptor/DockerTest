<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TeamNotification;

class TeamController extends Controller {
    
    // Affiche la page des équipes pour l'utilisateur authentifié.
    public function show() 
    {
        return view('teams.page', ['datas' => Auth::user()->teams]);
    }

    // Affiche la page d'invitation à une équipe.
    public function invitation(int $id) 
    {
        $user = Auth::user();
        if (!$user->teams->contains($id)) {
            return redirect()->route('login');
        }

        $team = Team::findOrFail($id);
        $usersToInvite = User::whereNotIn('id', $team->users->pluck('id'))->get();
        return view('teams.update.index', [
            'datas' => $team,
            'id' => $team->id,
            "passwords" => $team->passwords,
            'peoples' => $usersToInvite
        ]);
    }

    // Crée une nouvelle équipe.
    public function createNewTeam(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|unique:teams',
        ]);

        $team = Team::create([
            'name' => $request->name,
        ]);

        Auth::user()->teams()->attach($team->id);

        return redirect()->route('teams.show');
    }

    // Ajoute des utilisateurs à une équipe.
    public function addUsersToTeam(Request $request, int $id) 
    {
        $request->validate([
            'person-to-invite' => 'required|int|exists:users,id'
        ]); 

        $user = User::findOrFail($request->input('person-to-invite'));
        $user->teams()->attach($id);
        $team = Team::findOrFail($id);

        $notification = new TeamNotification(
            $user->name, 
            Auth::user()->name, 
            $team->name, 
            route("teams.get", $id),
            now()->toDateTimeString()
        );

        foreach ($team->users as $member) {
            $member->notify($notification);
        }

        return redirect()->route('teams.get', ['id' => $id]);
    }   
}
