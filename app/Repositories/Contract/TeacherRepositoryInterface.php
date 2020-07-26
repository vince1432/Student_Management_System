<?php

namespace App\Repositories\Contract;

interface TeacherRepositoryInterface
{
    public function teachers();

    public function teacher($student_id);

    public function insert($request);

    public function update($request, $student_id);

    public function delete($student_id);
}