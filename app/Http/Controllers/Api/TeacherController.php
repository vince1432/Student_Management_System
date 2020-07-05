<?php

namespace App\Http\Controllers\Api;

use App\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherResource;

class TeacherController extends Controller
{
    public function index()
	{
		$teachers =  Teacher::paginate(5);

		return TeacherResource::collection($teachers);
	}

	public function show($teacher_id)
	{
		$teacher = Teacher::where('teacher_id',$teacher_id)->first();

		if(!is_object($teacher))
			return response()->json('Teacher does not exist', 404);

		return new TeacherResource($teacher	);
	}

	public function store()
	{
		$validatedData = request()->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'birthday' => 'required|date|date_format:Y-m-d',
			'address' => 'required',
			'contact_number' => 'required',
			'email' => 'required|email',
		]);

		$latestId = Teacher::select('teacher_id')->withTrashed()->latest()->first();
		list($year, $month, $id) = explode('-',$latestId['teacher_id']);

		$date_now = Carbon::now()->format('Y-m');
		$date_id = Carbon::createFromFormat('Y-m', $year.'-'.$month)->format('Y-m');

		if($date_now == $date_id)
			$teacher_id = $date_id.'-'.substr('00000',0,-strlen(intval($id) + 1)).strval(intval($id) + 1);
		else
			$teacher_id = $date_now.'-00001';

		$teacher = Teacher::create([
			'teacher_id' => $teacher_id,
			'first_name' => $validatedData['first_name'],
			'last_name' => $validatedData['last_name'],
			'birthday' => $validatedData['birthday'],
			'address' => $validatedData['address'],
			'contact_number' => $validatedData['contact_number'],
			// 'email' => $validatedData['email']
		]);

		$teacher->account()->create([
			'username' => $teacher->teacher_id,
			'role_id' => 2,
			'email' => $validatedData['email'],
			'password' => Hash::make($teacher_id)
		]);

		return response()->json($teacher, 200);
	}

	public function update($teacher_id)
	{
		$teacher = Teacher::where('teacher_id',$teacher_id)->first();

		if(!is_object($teacher))
			return response()->json('Teacher does not exist', 404);

		$validatedData = request()->validate([
			'teacher_id' => 'required|unique:teachers,teacher_id,' .$teacher->id,
			'first_name' => 'required',
			'last_name' => 'required',
			'birthday' => 'required|date|date_format:Y-m-d',
			'address' => 'required',
			'contact_number' => 'required',
			'course_id' => 'required',
			// 'email' => 'required|unique:teachers,email,' .$teacher->id,
		]);

		$teacher->update([
			'teacher_id' => $validatedData['teacher_id'],
			'first_name' => $validatedData['first_name'],
			'last_name' => $validatedData['last_name'],
			'birthday' => $validatedData['birthday'],
			'address' => $validatedData['address'],
			'contact_number' => $validatedData['contact_number'],
			'course_id' => $validatedData['course_id'],
			// 'email' => $validatedData['email']
		]);

		return response()->json($teacher, 201);
	}

	public function destroy($teacher_id)
	{
		$teacher = Teacher::where('teacher_id',$teacher_id)->first();

		if(!is_object($teacher))
			return response()->json('Teacher does not exist', 404);

		$teacher->delete();
		return response()->json('Succesfully deleted.', 200);
	}
}
