<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

// Account
$factory->define(\App\Models\Account::class, function (Faker $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'role_id' => 1,
        'role_type' => \App\Models\Admin::class
    ];
});

// Admin
$factory->define(\App\Models\Admin::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
    ];
});

//Company
$factory->define(\App\Models\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'complement' => str_random(50),
        'cp' => str_random(5),
        'city' => str_random(50),
        'country' => str_random(50),
        'phone' => str_random(15),
    ];
});

//Customer
$factory->define(\App\Models\Customer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'company_name' => $faker->company,
        'address' => $faker->address,
        'complement' => str_random(50),
        'cp' => str_random(5),
        'city' => str_random(50),
        'country' => str_random(50),
        'phone' => str_random(15),
    ];
});

//Intervention
$factory->define(\App\Models\Intervention::class, function (Faker $faker) {
    return [
        'pac_id' => rand(1, 5),
        'technician_id' => rand(1, 5),
        'installation' => $faker->boolean,
    ];
});

//Maintenance
$factory->define(\App\Models\Maintenance::class, function (Faker $faker) {
    return [
        'pac_id' => rand(1, 5),
        'company_id' => rand(1, 3),
        'contract_number' => $faker->randomLetter,
    ];
});

//Pac
$factory->define(\App\Models\Pac::class, function (Faker $faker) {
    return [
        'serial_number' => $faker->uuid,
        'starting_at' => $faker->dateTime,
    ];
});

//Technician
$factory->define(\App\Models\Technician::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'company_id' => rand(1, 3),
    ];
});
