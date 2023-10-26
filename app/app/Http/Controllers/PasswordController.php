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

class PasswordController extends Controller
{
    public function editPassword(Request $request, $id): View
    {   
        return view('changepassword',[
            'password_id' => $id, 
            'status' => 'password not updated',
            'pass' => 'ok'
        ]);
    }

    public function editPasswordInDB(Request $request, $id): View
    {   

        // $passwords = DB::table('passwords')->where('user_id', Auth::user()->id)->get();

        $validated = Validator::make($request->all(), [
            'newpassword' => 'required|string',
        ]);

        if ($validated->fails()) {
            return view("changepassword",[
                'password_id' => $id,
                'status' => 'password not updated',
                // 'pass' => $passwords->where('id', $id)->first()
            ])
            ->withErrors($validated);
        }

        Password::where('id', $id)->first()->update(['password' => $request->newpassword]);


        return view('changepassword',[
            'password_id' => $id,
            'status' => 'password updated',
            // 'pass' => $passwords->where('id', $id)->first()
        ]);
    }
}