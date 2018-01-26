<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Account::class)->create([
            'email'     => 'admin@amzair.local',
            'password'  => \Illuminate\Support\Facades\Hash::make('test'),
            'role_type' => \App\Models\Admin::class,
        ]);

        factory(\App\Models\Account::class)->create([
            'email'     => 'technician@amzair.local',
            'password'  => \Illuminate\Support\Facades\Hash::make('test2'),
            'role_type' => \App\Models\Technician::class,
        ]);

        factory(\App\Models\Account::class, 5)->create([
            'password'  => \Illuminate\Support\Facades\Hash::make('test2'),
            'role_type' => \App\Models\Technician::class,
        ]);

        factory(\App\Models\Account::class)->create([
            'email'     => 'customer@amzair.local',
            'password'  => \Illuminate\Support\Facades\Hash::make('test3'),
            'role_type' => \App\Models\Customer::class,
        ]);

        factory(\App\Models\Account::class, 15)->create([
            'password'  => \Illuminate\Support\Facades\Hash::make('test3'),
            'role_type' => \App\Models\Customer::class,
        ]);

        factory(\App\Models\Account::class)->create([
            'email'     => 'sta@amzair.local',
            'password'  => \Illuminate\Support\Facades\Hash::make('test4'),
            'role_type' => \App\Models\Company::class,
        ]);

        $accounts = \App\Models\Account::all();
        $customers = \App\Models\Customer::all();
        $technicians = \App\Models\Technician::all();
        $companies = \App\Models\Company::all();
        $admins = \App\Models\Admin::all();

        foreach ($accounts as $account) {
            switch($account->role_type) {
                case 'App\\Models\\Customer':
                    $account->role_id = $customers[rand(0, $customers->count()-1)]->id;
                    break;

                case 'App\\Models\\Technician':
                    $account->role_id = $technicians[rand(0, $technicians->count()-1)]->id;
                    break;

                case 'App\\Models\\Company':
                    $account->role_id = $companies[rand(1, $companies->count()-1)]->id;
                    break;

                case 'App\\Models\\Admin':
                    $account->role_id = $admins[rand(0, $admins->count()-1)]->id;
                    break;
            }
            $account->save();
        }
    }
}
