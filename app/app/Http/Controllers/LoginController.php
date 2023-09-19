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
            return redirect('/form')
                ->withErrors($validated)
                ->withInput();
        }


        Password::create([
            'site' => $request->url,
            'login' => $request->email,
            'password' => Hash::make($request->password),
            'user_id' => Auth::user()->id
        ]);

        // $table->id();
        // $table->string('site', 255);
        // $table->string('login', 255);
        // $table->longText('password');
        // $table->bigInteger('user_id');
        // $table->timestampsTz()->nullable();
     
        $jsonData = json_encode($request->post());
        $current_timestamp = Carbon::now()->timestamp;
        $filePath = "{$current_timestamp}.json";
        Storage::put($filePath, $jsonData);
        
        return redirect('/form');
    }

    public function show(Request $request): RedirectResponse
    {

        $users = DB::table('passwords')->where('user_id', Auth::user()->id)->get();
 
        return redirect('/showpassword')->with('status', 'Profile updated!');
    }
}