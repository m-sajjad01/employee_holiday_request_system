<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\DB;

class Employee extends Authenticatable
{

    protected $guarded = [];
    protected $guard = 'web';
    public $timestamps = false;

    public function getEmpType($email)
    {
        return $emp_type = DB::table('employees')->where('email',$email)->value('emp_type');

    }
    public function getEmployeeData($email)
    {
        return $employee = DB::table('employees')->where('email',$email)->first();

    }

    public function getEmployeeDataById($emp_id){
        return $emp = DB::table('employees')->where('id',$emp_id)->first();
    }
}
