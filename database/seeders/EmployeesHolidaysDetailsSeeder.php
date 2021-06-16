<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeHolidayDetail;
class EmployeesHolidaysDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeHolidayDetail::create([
        'id' => 1,
        'employee_id' => 3,
        'requested_from' => '2021-02-01',
        'requested_upto'  => '2021-02-04',
        'no_of_days' => 7,
        'limit' => 25,
        'approved' => 0,
        'request_sent' => 1,
        ]);

        EmployeeHolidayDetail::create([
        'id' => 2,
        'employee_id' => 4,
        'requested_from' => '2021-03-01',
        'requested_upto'  => '2021-03-05',
        'no_of_days' => 2,
        'limit' => 25,
        'approved' => 0,
        'request_sent' => 1,
        ]);

        EmployeeHolidayDetail::create([
            'id' => 3,
            'employee_id' => 3,
            'requested_from' => '2021-03-01',
            'requested_upto'  => '2021-03-05',
            'no_of_days' => 2,
            'limit' => 25,
            'approved' => 1,
            'request_sent' => 0,
        ]);
    }
}
