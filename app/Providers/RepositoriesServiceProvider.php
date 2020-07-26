<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\StudentRepository;
use App\Repositories\Contract\StudentRepositoryInterface;
use App\Repositories\Eloquent\TeacherRepository;
use App\Repositories\Contract\TeacherRepositoryInterface;


class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(StudentRepositoryInterface::class,StudentRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class,TeacherRepository::class);
    }
}
