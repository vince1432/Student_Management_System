<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contract\StudentRepositoryInterface;

class StudentController extends Controller
{
	private $student_repository;
	
	public function __construct(StudentRepositoryInterface $student_repository)
	{
		$this->student_repository = $student_repository;
	}

	public function index()
	{
		$students =  $this->student_repository->students();

		return response()->json($students, 200);
	}

	public function show($student_id)
	{
		$student =  $this->student_repository->student($student_id);

		if(!is_object($student))
			return response()->json('Student does not exist', 404);

		return response()->json($student, 200);
	}

	public function store(Request $request)
	{
		$student = $this->student_repository->insert($request);

		return response()->json($student, 200);
	}

	public function update(Request $request,  $student_id)
	{
		$student = $this->student_repository->update($request, $student_id);

		return response()->json($student, 200);
	}

	public function destroy($student_id)
	{
		return $this->student_repository->delete($student_id);
	}
}
