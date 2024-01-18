<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Team;
use App\Models\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Notifications\TeamNotifications;

class TeamsController extends Controller
{
    public function createTeam(Request $request)
    {
        
        $validated = $request->validate([
            'team' => 'required|string|unique:teams,name',
        ]);
        
        $team = Team::create([
            'name' => $request->team,
        ]);
        $userId = Auth::user()->id;

        $user = User::find($userId);

        // Lier l'équipe à l'utilisateur actuel
        $user->teams()->syncWithoutDetaching($team->id);

        return redirect(route('teams.view'));
        
    }

    public function show()
    {
        if (!Auth::user()) {
            return redirect(route('welcome'));
        }
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $allteams = $user->teams;
        
        $passwordOfUser = array();

        foreach ($allteams as $team) {
            if($team->passwords) $passwordOfUser[$team->id] = $team->passwords;
        }

        return view('teams', ['teams' => $allteams, 'passwords' => $passwordOfUser]);
    }

    public function addMemberView(Request $request, int $id)
    {
        $users = User::all();
        $usersCanInvite = array();
        $team = Team::find(
            $id
        );

        foreach ($users as $user) {
            if (!$team->users->contains($user)) {
                $usersCanInvite[] = $user;
            }
        }




        return view('addmember', ['users' => $usersCanInvite, 'id' => $id]);
    }

    public function addMember(Request $request, int $id)
    {
        $validated = $request->validate([
            'users' => 'required',
        ]);

        // user qui ajoute
        $userId = Auth::user()->id;
        $userWhoAdd = User::find($userId);



        // user qui est ajouté
        $userChoiced = $request->users;
        $user = User::find($userChoiced);

        // la team
        $team = Team::find(
            $id
        );
        
        // Lier l'équipe à l'utilisateur ajouté
        $user->teams()->syncWithoutDetaching($team->id);

        $members = $team->users;

        $notification = new TeamNotifications(
            $user->name,
            $userWhoAdd->name,
            now()->toDateTimeString(),
            $team->name,
            "$team->name"
        );

        // Envoyer la notification à chaque membre de l'équipe
        foreach ($members as $member) $member->notify($notification);
        



        return redirect(route('teams.view'));
    }

    public function linkPwdWithTeam(Request $request, int $id) {

        $validated = $request->validate([
            'teams' => 'required|array',
        ]);

        $password = Password::find(
            $id
        );

        foreach ($request->teams as $key => $value) {
            $team = Team::find(
                $value
            );
            if($team) $password->teams()->syncWithoutDetaching($team->id);
        }
        
        return redirect('/dashboard');


        
    }
    
}