<?php

namespace App\Http\Controllers\Api;

use App\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    public function index()
	{
		$grades = Grade::select('id', 'prelim', 'midterm', 'prefinals', 'finals', 'average')
					->paginate(5);

		return response()->json($grades, 200);
	}

	public function show(Grade $grade)
	{
		$grade = $grade->only('id', 'prelim', 'midterm', 'prefinals', 'finals', 'average');

		return response()->json($grade, 200);
	}

	public function store()
	{
		$validatedData = request()->validate([
			'prelim' => 'nullable',
			'midterm' => 'nullable',
			'prefinals' => 'nullable',
			'finals' => 'nullable',
			'average' => 'nullable'
		]);

		$grade = Grade::create([
			'prelim' => $validatedData['prelim'],
			'midterm' => $validatedData['midterm'],
			'prefinals' => $validatedData['prefinals'],
			'finals' => $validatedData['finals'],
			'average' => $validatedData['average'],
		]);

		return response()->json($grade, 200);
	}

	public function update(Grade $grade)
	{
		$validatedData = request()->validate([
			'prelim' => '',
			'midterm' => '',
			'prefinals' => '',
			'finals' => '',
			'average' => ''
		]);

		$grade->update([
			'prelim' => $validatedData['prelim'],
			'midterm' => $validatedData['midterm'],
			'prefinals' => $validatedData['prefinals'],
			'finals' => $validatedData['finals'],
			'average' => $validatedData['average']
		]);

		return response()->json($grade, 200);
	}

	public function destroy(Grade $grade)
	{
		$grade->delete();
		return response()->json('Succesfully deleted.', 200);
	}
}
