<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Password;
use App\Models\Team;
use App\Models\User;
use App\Notifications\TeamNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function show(Request $request): View
    {   
        $userId = Auth::user()->id;
        if ($userId) {
            $user = User::find($userId);
            $datas = $user->teams;

            return view('/teams', ['datas' => $datas, 'message' => `_`]);
        }
        return view('/teams', ['datas' => null, 'message' => `_`]);
    }

    public function create(Request $request): RedirectResponse
    {   
        $userId = Auth::user()->id;
        
        $user = User::find( $userId );
        $datas = $user->teams;
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validated->fails()) {
            return redirect('/teams')
                ->with('message', `__`)
                ->with('datas', $datas)
                ->withErrors($validated)
                ->withInput();
        }

        $team = Team::create([
            'name' => $request->name
        ]);

        // $user = User::where('id', Auth::user()->id)->first();
        
        $user->teams()->syncWithoutDetaching([$team->id]);

        $addedUserName = 'Arthur';
        $addedByUserName = 'Valérie';
        $addedDateTime = now()->toDateTimeString();

        $notification = new TeamNotification($addedUserName, $addedByUserName, $addedDateTime);

        $user->notify($notification);


        return redirect('/teams')->with('message', `L'équipe $request->name à été crée!`)
        ->with('datas', $datas);
    }

    public function team(Request $request, $id): View | RedirectResponse
    {
        if(Auth::user()) {
            $team = Team::find($id);

            // Récupérer tous les utilisateurs qui ne sont pas dans l'équipe
            $usersNotInTeam = User::whereDoesntHave('teams', function ($query) use ($team) {
                $query->where('team_id', $team->id);
            })->get();
        
            return view('team', [
                'members' => $team->users,
                'team' => $team,
                'usersNotInTeam' => $usersNotInTeam,
                'message' => '_'
            ]);
        }
        return redirect('/');
    }

    public function addMember(Request $request, $id_team, $id_member_added): RedirectResponse
    {
        $userId = Auth::user()->id;
        $userMe = User::find( $userId );

        $user = User::find( $id_member_added );
        $user->teams()->syncWithoutDetaching([$id_team]);

        $team = Team::find($id_team);

        $usersInTeam = $team->users;
        $addedDateTime = now()->toDateTimeString();

        $notification = new TeamNotification($user->name, $userMe->name, $addedDateTime);

        foreach ($usersInTeam as $key => $userInTeam) {
            $userInTeam->notify($notification);
        }
    
        return redirect("/teams/{$id_team}");
    }
}

// $userId = Auth::user()->id;
        
// if ($userId) {
//     $user = User::find( $userId );
//     $datas = $user->teams;

//     return view('teams', ['datas' => $datas]);
// } else return redirect('/login');