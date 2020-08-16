<?php

namespace App\Repositories\Eloquent;

use App\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Contract\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function teachers()
    {
        return Teacher::select($this->Format())->paginate(5);
    }

    public Function teacher($teacher_id)
    {
        return Teacher::select($this->Format())
                ->where('teacher_id',$teacher_id)
                ->first();
    }

    public function insert($request)
    {
        $validatedData = $this->validate($request);

		$teacher_id = $this->GenerateId();
        $teacher = Teacher::create(
			array_merge(
				$this->ValidatedFormat($validatedData),
				['teacher_id' => $teacher_id]
			));

		$teacher->account()->create([
			'username' => $teacher->teacher_id,
			'role_id' => 2,
			'password' => Hash::make($teacher_id)
        ]);

        return $teacher;
    }

    public function update($request, $teacher_id)
    {
        $teacher = Teacher::where('teacher_id',$teacher_id)->first();

		if(!is_object($teacher))
			return response()->json('Teacher does not exist', 404);

		$validatedData = $this->validate($request);

		$teacher->update($this->ValidatedFormat($validatedData));

        return $teacher;
    }

    public function delete($teacher_id)
    {
        $teacher = Teacher::where('teacher_id',$teacher_id)->first();

		if(!is_object($teacher))
            return response()->json('Teacher does not exist', 404);

        $teacher->account->delete();
        $teacher->delete();

		return response()->json('Succesfully deleted.', 200);
    }

    private function Format()
	{
        return [
            'teacher_id', 'first_name', 'last_name',
            'birthday', 'gender', 'contact_number',
			'email','building','barangay','city','province',
			'other'
		];
    }

    private function ValidatedFormat($validatedData)
    {
        return [
			'first_name' => $validatedData['first_name'],
			'last_name' => $validatedData['last_name'],
			'birthday' => $validatedData['birthday'],
			'gender' => $validatedData['gender'],
			'building' => $validatedData['building'],
			'barangay' => $validatedData['barangay'],
			'city' => $validatedData['city'],
			'province' => $validatedData['province'],
			'other' => $validatedData['other'],
			'contact_number' => $validatedData['contact_number'],
			'email' => $validatedData['email'],
        ];
    }

    private function GenerateId()
    {
        $latestId = Teacher::select('teacher_id')->withTrashed()->latest()->first();
		list($year, $month, $id) = explode('-',$latestId['teacher_id']);

		$date_now = Carbon::now()->format('Y-m');
		$date_id = Carbon::createFromFormat('Y-m', $year.'-'.$month)->format('Y-m');

		if($date_now == $date_id)
			$teacher_id = $date_id.'-'.substr('00000',0,-strlen(intval($id) + 1)).strval(intval($id) + 1);
		else
            $teacher_id = $date_now.'-00001';

        return $teacher_id;
	}

	private function validate($request)
	{
		return $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'birthday' => 'required|date|date_format:Y-m-d',
			'gender' => 'required',
			'building' => 'required',
			'barangay' => 'required',
			'city' => 'required',
			'province' => 'required',
			'other' => '',
			'contact_number' => 'required',
			'email' => 'required|unique:teachers',
		]);
	}
}