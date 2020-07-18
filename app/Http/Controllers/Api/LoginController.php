<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
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
			'password' => 'required|string',
		]);

		if(Auth::attempt($login, true))
		{
			$token = Auth::user()->createToken('authToken',['do_anything']);

			$token_data = [
				'access_token' => $token->accessToken,
				'scopes' => $token->token->scopes,
			];

			$token_data['expires_at'] = (isset($request->remember_me))
										? Carbon::parse(Carbon::now()->addWeeks(1))->toDateTimeString()
										: Carbon::now()->addDays(1)->toDateTimeString();

			$response = [
				'user' => Auth::user(),
				'token_data' => $token_data,
			];

			return response()->json($response, 200);
		}
		else if(!Auth::attempt($login))
		{
			return response()->json('Invalid login credentials.',500);
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
