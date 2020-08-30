<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
		'user_id' => $faker->year . '-' . $faker->month . '-' . $faker->numberBetween($min = 999, $max = 10000),
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
		'address' => $faker->address,
		'contact_number' => $faker->phoneNumber,
		'course_id' => $faker->numberBetween($min = 1, $max = 5),
		'email' => $faker->safeEmail,
    ];
});
