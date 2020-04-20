<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Teacher;
use Faker\Generator as Faker;

$factory->define(Teacher::class, function (Faker $faker) {
    return [
        'teacher_id' => $faker->year . '-' . $faker->month . '-' . $faker->numberBetween($min = 999, $max = 10000),
        'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
		'address' => $faker->address,
		'contact_number' => $faker->phoneNumber,
		'email' => $faker->safeEmail,
    ];
});
