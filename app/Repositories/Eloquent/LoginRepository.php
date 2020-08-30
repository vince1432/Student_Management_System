<?php

namespace App\Repositories\Eloquent;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contract\LoginRepositoryInterface;

class LoginRepository implements LoginRepositoryInterface
{
	public function tokenCreate($request)
	{
		$token = Auth::user()->createToken('authToken',['do_anything']);

		$token_data = [
			'access_token' => $token->accessToken,
			'scopes' => $token->token->scopes,
		];

		$token_data['expires_at'] = (isset($request->remember_me))
									? Carbon::parse(Carbon::now()->addWeeks(1))->toDateTimeString()
									: Carbon::now()->addDays(1)->toDateTimeString();

		return [
			'user' => Auth::user(),
			'token_data' => $token_data,
		];
	}

	public function validateCredential($request)
	{
		return $request->validate([
			'userable_id' => 'required|string',
			'password' => 'required|string',
		]);
	}

	public function logout($request)
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