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

		if(Auth::attempt($login, true))
		{
			$accessToken = Auth::user()->createToken('authToken')->accessToken;

			return response()->json(['user' => Auth::user(),'access_token' => $accessToken]);
		}

		else if(!Auth::attempt($login))
		{
			return response()->json('Invalid login credentials.');
		}
	}

	public function logout(Request  $request)
	{

		if(Auth::guard('api')->check())
		{
			return response()->json('logout unsuccessfully');
		}

		$request->user('api')->token()->revoke();

		return response()->json('logout successfully');
	}

	protected function guard()
	{
		return Auth::guard('api');
	}
}
