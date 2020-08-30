<?php

namespace App\Repositories\Contract;

interface LoginRepositoryInterface
{
	public function tokenCreate($request);

	public function validateCredential($request);

	public function logout($request);
}