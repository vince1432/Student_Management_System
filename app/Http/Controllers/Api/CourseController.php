<?php

namespace App\Http\Controllers\Api;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    public function index()
	{
		$courses = Course::select('id','name')
					->paginate(5);

		return response()->json($courses, 200);
	}

	public function show(Course $course)
	{
		$course = $course->only('id','name');

		return response()->json($course, 200);
	}

	public function store()
	{
		$validatedData = request()->validate([
			'name' => 'required'
		]);

		$course = Course::create([
			'name' => $validatedData['name']
		]);

		return response()->json($course, 200);
	}

	public function update(Request $request, Course $course)
	{
		$validatedData = $request->validate([
			'name' => 'required'
		]);

		$course->update([
			'name' => $validatedData['name']
		]);

		return response()->json($course, 200);
	}

	public function destroy(Course $course)
	{
		$course->delete();
		return response()->json('Succesfully deleted.', 200);
	}

}
