<?php

namespace App\Repositories\Contract;

interface StudentRepositoryInterface
{
    public function students();

    public function student($user_id);

    public function insert($request);

    public function update($request, $user_id);

    public function delete($user_id);
}