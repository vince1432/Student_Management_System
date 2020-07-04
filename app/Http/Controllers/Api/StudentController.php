<?php

namespace App\Http\Controllers\Api;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
	public function index()
	{
		$students =  Student::paginate(5);

		return StudentResource::collection($students);
	}

	public function show($student_id)
	{
		$student = Student::where('student_id',$student_id)->first();

		if(!is_object($student))
			return response()->json('Student does not exist', 404);

			return response()->json($student, 200);
	}

	public function store()
	{
		$validatedData = request()->validate([
			'student_id' => 'required|unique:students',
			'first_name' => 'required',
			'last_name' => 'required',
			'birthday' => 'required|date|date_format:Y-m-d',
			'address' => 'required',
			'contact_number' => 'required',
			'course_id' => 'required',
			'email' => 'required|unique:students',
		]);

		$student = Student::create([
			'student_id' => $validatedData['student_id'],
			'first_name' => $validatedData['first_name'],
			'last_name' => $validatedData['last_name'],
			'birthday' => $validatedData['birthday'],
			'address' => $validatedData['address'],
			'contact_number' => $validatedData['contact_number'],
			'course_id' => $validatedData['course_id'],
			'email' => $validatedData['email']
		]);

		return response()->json($student, 201);
	}

	public function update($student_id)
	{
		$student = Student::where('student_id',$student_id)->first();

		if(!is_object($student))
			return response()->json('Student does not exist', 404);

		$validatedData = request()->validate([
			'student_id' => 'required|unique:students,student_id,' .$student->id,
			'first_name' => 'required',
			'last_name' => 'required',
			'birthday' => 'required|date|date_format:Y-m-d',
			'address' => 'required',
			'contact_number' => 'required',
			'course_id' => 'required',
			'email' => 'required|unique:students,email,' .$student->id,
		]);

		$student->update([
			'student_id' => $validatedData['student_id'],
			'first_name' => $validatedData['first_name'],
			'last_name' => $validatedData['last_name'],
			'birthday' => $validatedData['birthday'],
			'address' => $validatedData['address'],
			'contact_number' => $validatedData['contact_number'],
			'course_id' => $validatedData['course_id'],
			'email' => $validatedData['email']
		]);

		return response()->json($student, 201);
	}

	public function destroy($student_id)
	{
		$student = Student::where('student_id',$student_id)->first();

		if(!is_object($student))
			return response()->json('Student does not exist', 404);

		$student->delete();
		return response()->json('Succesfully deleted.', 200);
	}
}
