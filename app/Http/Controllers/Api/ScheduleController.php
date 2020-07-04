<?php

namespace App\Http\Controllers\Api;

use App\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function index()
	{
		$schedules = Schedule::select('id', 'room_id', 'day', 'start_time', 'finish_time')
					->paginate(5);

		return response()->json($schedules, 200);
	}

	public function show(Schedule $schedule)
	{
		$schedule = $schedule->only('id', 'room_id', 'day', 'start_time', 'finish_time');

		return response()->json($schedule, 200);
	}

	public function store()
	{
		$validatedData = request()->validate([
			'room_id' => 'required|integer',
			'day' => 'required',
			'start_time' => 'required',
			'finish_time' => 'required'
		]);

		$schedule = Schedule::create([
			'room_id' => $validatedData['room_id'],
			'day' => $validatedData['day'],
			'start_time' => $validatedData['start_time'],
			'finish_time' => $validatedData['finish_time']
		]);

		return response()->json($schedule, 200);
	}

	public function update(Schedule $schedule)
	{
		$validatedData = request()->validate([
			'room_id' => 'required|integer',
			'day' => 'required',
			'start_time' => 'required',
			'finish_time' => 'required'
		]);

		$schedule->update([
			'room_id' => $validatedData['room_id'],
			'day' => $validatedData['day'],
			'start_time' => $validatedData['start_time'],
			'finish_time' => $validatedData['finish_time']
		]);

		return response()->json($schedule, 200);
	}

	public function destroy(Schedule $schedule)
	{
		$schedule->delete();
		return response()->json('Succesfully deleted.', 200);
	}
}
