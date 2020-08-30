<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contract\TeacherRepositoryInterface;

class TeacherController extends Controller
{
	private $teacher_repository;

	public function __construct(TeacherRepositoryInterface $teacher_repository)
	{
		$this->teacher_repository = $teacher_repository;
	}

    public function index()
	{
		$teachers =  $this->teacher_repository->teachers();

		return response()->json($teachers, 200);
	}

	public function show($user_id)
	{
		$teacher =  $this->teacher_repository->teacher($user_id);

		if(!is_object($teacher))
			return response()->json('Teacher does not exist', 404);

		return response()->json($teacher, 200);
	}

	public function store(Request $request)
	{
		$teacher = $this->teacher_repository->insert($request);

		return response()->json($teacher, 200);
	}

	public function update(Request $request, $user_id)
	{
		$teacher = $this->teacher_repository->update($request, $user_id);

		return response()->json($teacher, 200);
	}

	public function destroy($user_id)
	{
		return $this->teacher_repository->delete($user_id);
	}
}
