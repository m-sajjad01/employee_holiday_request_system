<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeHolidayDetail;

use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class EmployeeController extends Controller
{
    public function login(){

        return view('employees.form');

    } // END of login function

    public function login_validate(Request $request){

        $this->validate($request, [

            'email'   => 'required|email',
            'password' => 'required|min:3'
        ]);
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))){
            $employee =  new Employee();
            $emp = $employee->getEmployeeData($request->email);
            $employeesholidaysDetails =  new EmployeeHolidayDetail();
            if ($emp->emp_type == "manager") {
                $requests_for_approval = $employeesholidaysDetails->getWaitingEmployeesApprovals();
                return view('employees.manager_dashboard',['requests'=>$requests_for_approval]);
            }
            else {
                $emp_approval_requests = $employeesholidaysDetails->getEmployeesApprovalRequests($emp->id);
                return view('employees.employee_dashboard',['emp_id'=>$emp->id,'emp_name'=>$emp->name,'emp_email'=>$emp->email,'emp_approval_requests'=>$emp_approval_requests ]);
            }
        }
        return redirect()->route('emp.login')->with('flash_error', 'Email or Password is incorrect or Account does not exists');

    } // END of login_validate function

    public function send_approval_request ($id){

        return view('employees.request_form', ['emp_id' => $id]);
    }
    public function send_approval_request_processing (Request $request){
        $this->validate($request, [
            'date_from' => 'required',
            'date_to'   => 'required'
        ]);

       /* $date1=date_create($request->date_from);
        $date2=date_create();
        $diff=date_diff($date1,$date2);
        //$diff =  date_diff($$request->date_torequest->requested_from,$request->requested_upto);
        //$days =  $diff->format("%R%a days");
        $days =  $diff->format("%a");*/

        $days = $this->getWorkdays($request->date_from,$request->date_to );

        $employeesholidaysDetails =  new EmployeeHolidayDetail();
        $employeesholidaysDetails->insertEmployeeApprovalRequest($request->emp_id,$request->date_from,$request->date_to,$days );
        $employee =  new Employee();
        $emp = $employee->getEmployeeDataById($request->emp_id);
        $emp_approval_requests = $employeesholidaysDetails->getEmployeesApprovalRequests($request->emp_id);
        return view('employees.employee_dashboard',['emp_approval_requests'=> $emp_approval_requests, 'emp_id' =>$emp->id, 'emp_name' =>$emp->name, 'emp_email' =>$emp->email]);
    }

    public function holidays_approval_request($emp_id) {

        $employeesholidaysDetails =  new EmployeeHolidayDetail();
        $employeesholidaysDetails->reqApproval($emp_id);
        $requests_for_approval = $employeesholidaysDetails->getWaitingEmployeesApprovals();
        return view('employees.manager_dashboard',['requests'=>$requests_for_approval]);
    }

    public function holidays_cancel_request($emp_id) {

        $employeesholidaysDetails =  new EmployeeHolidayDetail();
        $employeesholidaysDetails->reqCancel($emp_id);
        $requests_for_approval = $employeesholidaysDetails->getWaitingEmployeesApprovals();
        return view('employees.manager_dashboard',['requests'=>$requests_for_approval]);
    }

    function getWorkdays($date1, $date2, $workSat = FALSE, $patron = NULL) {
        if (!defined('SATURDAY')) define('SATURDAY', 6);
        if (!defined('SUNDAY')) define('SUNDAY', 0);

        // Array of all public festivities
        $publicHolidays = array('01-01', '01-06', '04-25', '05-01', '06-02', '08-15', '11-01', '12-08', '12-25', '12-26');
        // The Patron day (if any) is added to public festivities
        if ($patron) {
            $publicHolidays[] = $patron;
        }

        /*
         * Array of all Easter Mondays in the given interval
         */
        $yearStart = date('Y', strtotime($date1));
        $yearEnd   = date('Y', strtotime($date2));

        for ($i = $yearStart; $i <= $yearEnd; $i++) {
            $easter = date('Y-m-d', easter_date($i));
            list($y, $m, $g) = explode("-", $easter);
            $monday = mktime(0,0,0, date($m), date($g)+1, date($y));
            $easterMondays[] = $monday;
        }

        $start = strtotime($date1);
        $end   = strtotime($date2);
        $workdays = 0;
        for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
            $day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
            $mmgg = date('m-d', $i);
            if ($day != SUNDAY &&
                !in_array($mmgg, $publicHolidays) &&
                !in_array($i, $easterMondays) &&
                !($day == SATURDAY && $workSat == FALSE)) {
                $workdays++;
            }
        }

        return intval($workdays);
    }

} // END of EmployeeController class
