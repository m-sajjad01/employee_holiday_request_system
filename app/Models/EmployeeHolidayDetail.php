<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class EmployeeHolidayDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'employees_holidays_details';
    public function getWaitingEmployeesApprovals()
    {
        return $requests_for_approval = DB::table('employees_holidays_details')
            ->where('request_sent', '=', 1)
            ->get();
    }
    public function getEmployeesApprovalRequests($id)
    {
        return $emp_approval_requests = DB::table('employees_holidays_details')
            ->where('employee_id', '=', $id)
            ->get();
    }

    public function insertEmployeeApprovalRequest($emp_id,$date_from, $date_to, $days)
    {
        DB::table('employees_holidays_details')->insert([
            'employee_id' => $emp_id,
            'requested_from' => $date_from,
            'requested_upto' => $date_to,
            'no_of_days' => $days,
            'limit' => 25,
            'approved' => 0,
            'request_sent' => 1,

        ]);
    }

    public function reqApproval($emp_id)
    {
        return $affected = DB::table('employees_holidays_details')
            ->where('employee_id', $emp_id)
            ->update(['approved' => 1]);
    }

    public function reqCancel($emp_id)
    {
        return $affected = DB::table('employees_holidays_details')
            ->where('employee_id', $emp_id)
            ->update(['request_sent' => 0]);
    }
}









