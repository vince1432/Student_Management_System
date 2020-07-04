<?php

namespace App\Http\Controllers\Api;
use App\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function index()
	{
		$classrooms = Classroom::select('id','name')
					->paginate(5);

		return response()->json($classrooms, 200);
	}

	public function show(Classroom $classroom)
	{
		$classroom = $classroom->only('id','name');

		return response()->json($classroom, 200);
	}

	public function store()
	{
		$validatedData = request()->validate([
			'name' => 'required'
		]);

		$classroom = Classroom::create([
			'name' => $validatedData['name']
		]);

		return response()->json($classroom, 200);
	}

	public function update(Request $request, Classroom $classroom)
	{
		$validatedData = $request->validate([
			'name' => 'required'
		]);

		$classroom->update([
			'name' => $validatedData['name']
		]);

		return response()->json($classroom, 200);
	}

	public function destroy(Classroom $classroom)
	{
		$classroom->delete();
		return response()->json('Succesfully deleted.', 200);
	}
}
