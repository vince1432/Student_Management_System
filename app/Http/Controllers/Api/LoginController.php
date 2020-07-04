<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
	{
		$login = $request->validate([
			'username' => 'required|string',
			'password' => 'required|string'
		]);

		if(!Auth::attempt($login))
		{
			return response()->json('Invalid login credentials.');
		}

		$accessToken = Auth::user()->createToken('authToken')->accessToken;

		return response()->json(['user' => Auth::user(),'access_token' => $accessToken]);
	}
}
