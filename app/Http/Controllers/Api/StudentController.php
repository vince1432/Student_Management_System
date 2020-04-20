<?php

namespace App\Http\Controllers\Api;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
	public function index()
	{
	 $students = Student::all();

		return response()->json($students, 200);
	}

	public function show(Student $student)
	{
		return response()->json($student, 200);
	}

	public function store(Request $request)
	{
	 $validatedData = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'birthdate' => 'required'
		]);

		$student = new Student();
		$student->first_name = $validatedData['first_name'];
		$student->last_name = $validatedData['last_name'];
		$student->birthdate = $validatedData['birthdate'];
		$student->save();

		return response()->json($student, 200);
	}

	public function update(Request $request,Student $student)
	{
	 $validatedData = $request->validate([
		 'first_name' => 'required',
		 'last_name' => 'required',
		 'birthdate' => 'required'
		]);

		$student->first_name = $validatedData['first_name'];
		$student->last_name = $validatedData['last_name'];
		$student->birthdate = $validatedData['birthdate'];
		$student->update();

		return response()->json($student, 200);
	}

	public function destroy(Student $student)
	{
		$student->delete();
		return response()->json('Succesfully deleted.', 200);
	}
}
