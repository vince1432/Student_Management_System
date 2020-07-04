<?php

namespace App\Http\Controllers\Api;

use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function index()
	{
		$subjects = Subject::select('id','name', 'unit')
					->paginate(5);

		return response()->json($subjects, 200);
	}

	public function show(Subject $subject)
	{
		$subject = $subject->only('id','name', 'unit');

		return response()->json($subject, 200);
	}

	public function store()
	{
		$validatedData = request()->validate([
			'name' => 'required',
			'unit' => 'required'
		]);

		$subject = Subject::create([
			'name' => $validatedData['name'],
			'unit' => $validatedData['unit']
		]);

		return response()->json($subject, 200);
	}

	public function update(Request $request, Subject $subject)
	{
		$validatedData = $request->validate([
			'name' => 'required',
			'unit' => 'required'
		]);

		$subject->update([
			'name' => $validatedData['name'],
			'unit' => $validatedData['unit']
		]);

		return response()->json($subject, 200);
	}

	public function destroy(Subject $subject)
	{
		$subject->delete();
		return response()->json('Succesfully deleted.', 200);
	}
}
