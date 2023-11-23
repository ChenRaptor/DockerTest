<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Password;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = Validator::make($request->all(), [
            'url' => 'required|string|url',
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
     
        if ($validated->fails()) {
            return redirect('/passwords')
                ->withErrors($validated)
                ->withInput();
        }


        Password::create([
            'site' => $request->url,
            'login' => $request->email,
            'password' => $request->password,
            'user_id' => Auth::user()->id
        ]);
     
        $jsonData = json_encode($request->post());
        $current_timestamp = Carbon::now()->timestamp;
        $filePath = "{$current_timestamp}.json";
        Storage::put($filePath, $jsonData);

        $passwords = Password::where('user_id', Auth::user()->id)->get();
        return redirect('/passwords')->with('passwords', $passwords);
    }

    public function show(Request $request): View
    {   
        
        $passwords = Password::where('user_id', Auth::user()->id)->get();
        return view('/passwords/page')->with('passwords', $passwords);
    }

}