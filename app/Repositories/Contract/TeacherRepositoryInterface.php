<?php

namespace App\Repositories\Contract;

interface TeacherRepositoryInterface
{
    public function teachers();

    public function teacher($user_id);

    public function insert($request);

    public function update($request, $user_id);

    public function delete($user_id);
}