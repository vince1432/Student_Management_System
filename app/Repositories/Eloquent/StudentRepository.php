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

    public Function student($student_id)
    {
        return Student::select($this->Format())
                ->where('student_id',$student_id)
                ->first();
    }

    public function insert($request)
    {
        $validatedData = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'birthday' => 'required|date|date_format:Y-m-d',
			'address' => 'required',
			'contact_number' => 'required',
			'course_id' => 'required',
			'email' => 'required|unique:students',
		]);

		$student_id = $this->GenerateId();
        $student = Student::create(array_merge($this->ValidatedFormat($validatedData), ['student_id' => $student_id]));

		$student->account()->create([
			'username' => $student->student_id,
			'role_id' => 1,
			'password' => Hash::make($student_id)
        ]);
        
        return $student;
    }

    public function update($request, $student_id)
    {
        $student = Student::where('student_id',$student_id)->first();

		if(!is_object($student))
			return response()->json('Student does not exist', 404);

		$validatedData = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'birthday' => 'required|date|date_format:Y-m-d',
			'address' => 'required',
			'contact_number' => 'required',
            'course_id' => 'required',
            'email'  => 'required',
		]);

		$student->update($this->ValidatedFormat($validatedData));
        
        return $student;
    }

    public function delete($student_id)
    {
        $student = Student::where('student_id',$student_id)->first();

		if(!is_object($student))
            return response()->json('Student does not exist', 404);
            
        $student->account->delete();
        $student->delete();
        
		return response()->json('Succesfully deleted.', 200);
    }

    private function Format()
	{
        return [
            'student_id', 'first_name', 'last_name', 
            'birthday', 'address', 'contact_number', 
            'course_id', 'email',
		];
    }
    
    private function ValidatedFormat($validatedData)
    {
        return [
			'first_name' => $validatedData['first_name'],
			'last_name' => $validatedData['last_name'],
			'birthday' => $validatedData['birthday'],
			'address' => $validatedData['address'],
			'contact_number' => $validatedData['contact_number'],
			'course_id' => $validatedData['course_id'],
			'email' => $validatedData['email'],
        ];
    }

    private function GenerateId()
    {
        $latestId = Student::select('student_id')->withTrashed()->latest()->first();
		list($year, $month, $id) = explode('-',$latestId['student_id']);

		$date_now = Carbon::now()->format('Y-m');
		$date_id = Carbon::createFromFormat('Y-m', $year.'-'.$month)->format('Y-m');

		if($date_now == $date_id)
			$student_id = $date_id.'-'.substr('00000',0,-strlen(intval($id) + 1)).strval(intval($id) + 1);
		else
            $student_id = $date_now.'-00001';
            
        return $student_id;
    }
}