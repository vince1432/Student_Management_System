<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\Contract\LoginRepositoryInterface;

class LoginController extends Controller
{
	private $login_repository;

	public function __construct(LoginRepositoryInterface $login_repository)
	{
		$this->login_repository = $login_repository;
	}

    public function login(Request $request)
	{
		$credentials = $this->login_repository->validateCredential($request);

		if(Auth::attempt($credentials, true))
		{
			$response = $this->login_repository->tokenCreate($request);

			return response()->json($response, 200);
		}
		else if(!Auth::attempt($credentials))
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
