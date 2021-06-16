<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([

            'id' => 1,
            'name' => 'Deepak',
            'email' => 'deepak@company.com',
            'emp_type'  => 'manager',
            'password' => bcrypt('123456'),

        ]);
        Employee::create([

            'id' => 2,
            'name' => 'Louise',
            'email' => 'louise@company.com',
            'emp_type'  => 'manager',
            'password' => bcrypt('123456'),

        ]);

        Employee::create([

            'id' => 3 ,
            'name' => 'John',
            'email' => 'john@company.com',
            'emp_type' => 'employee',
            'password' => bcrypt('123456'),

        ]);

        Employee::create([

            'id' => 4,
            'name' => 'Lee',
            'email' => 'lee@company.com',
            'emp_type' => 'employee',
            'password' => bcrypt('123456'),
        ]);
    }
}
