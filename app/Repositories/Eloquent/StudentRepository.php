<?php

namespace App\Repositories\Eloquent;

use App\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Contract\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{
    public function students()
    {
        return Student::select($this->Format())->paginate(5);
    }

    public Function student($user_id)
    {
        return Student::select($this->Format())
			->where('user_id',$user_id)
			->first();
    }

    public function insert($request)
    {
        $validatedData = $this->validate($request,-1);

		$user_id = $this->GenerateId();
        $student = Student::create(
			array_merge(
				$this->ValidatedFormat($validatedData),
				['user_id' => $user_id]
			));

		// $student->account()->create([
		// 	'userable_id' => $student->user_id,
		// 	'role_id' => 1,
		// 	'password' => Hash::make($user_id)
        // ]);

        return $student;
    }

    public function update($request, $user_id)
    {
        $student = Student::where('user_id',$user_id)->first();

		if(!is_object($student))
			return response()->json('Student does not exist', 404);

		$validatedData = $this->validate($request,$student->id);

		$student->update($this->ValidatedFormat($validatedData));

        return $student;
    }

    public function delete($user_id)
    {
        $student = Student::where('user_id',$user_id)->first();

		if(!is_object($student))
            return response()->json('Student does not exist', 404);

        $student->account->delete();
        $student->delete();

		return response()->json('Succesfully deleted.', 200);
    }

    private function Format()
	{
        return [
            'user_id', 'first_name', 'last_name',
            'birthday', 'gender', 'contact_number',
			'course_id', 'email',
			'building','barangay','city','province', 'other'
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
			'course_id' => $validatedData['course_id'],
			'email' => $validatedData['email'],
        ];
    }

    private function GenerateId()
    {
        $latestId = Student::select('user_id')->withTrashed()->latest()->first();
		list($year, $month, $id) = explode('-',$latestId['user_id']);

		$date_now = Carbon::now()->format('Y-m');
		$date_id = Carbon::createFromFormat('Y-m', $year.'-'.$month)->format('Y-m');

		if($date_now == $date_id)
			$user_id = $date_id.'-'.substr('00000',0,-strlen(intval($id) + 1)).strval(intval($id) + 1);
		else
            $user_id = $date_now.'-00001';

        return $user_id;
	}

	private function validate($request,$id)
	{
		$rule = [
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
			'course_id' => 'required',
			'email' => 'required|unique:students',
		];
		$email = ($id >= 0)
			? ['email' => 'required|email|unique:students,email,'.$id]
			: ['email' => 'required|email|unique:students,email'];

		return $request->validate(array_merge($rule,$email));
	}
}