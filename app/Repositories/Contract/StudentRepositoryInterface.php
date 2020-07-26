<?php

namespace App\Repositories\Contract;

interface StudentRepositoryInterface
{
    public function students();

    public function student($student_id);

    public function insert($request);

    public function update($request, $student_id);

    public function delete($student_id);
}