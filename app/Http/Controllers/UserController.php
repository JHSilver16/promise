<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\employee;
use App\User;
use App\usertype;

class UserController extends Controller
{
    public function getemployees(){
    	$users = DB::connection('mysql2')->select('select * from tblemployee where work_status="active";');

    	foreach ($users as $user) {
    		$position = DB::connection('mysql2')->table('tblposition')->where('position_id', $user->position_id)->first();
    		//echo $position->position_id;
    		$employee = employee::where('staff_no', $user->emp_id)->first();
            $users = new User();
            
    		if($employee == null || count($employee) < 1){
    			$employee = new employee();	
                
    		}
            else {
                $users = User::where('employee_id', $employee->id)->first();
            }
    		
    		$employee->first_name = $user->fname;
    		$employee->last_name = $user->lname;
    		$employee->middle_name = $user->mname;
    		$employee->position = $position->post_description;
    		$employee->posabv = $position->position_id;
    		$employee->division = $user->division_id;
    		$employee->staff_no = $user->emp_id;
    		$employee->save();

            $users->name =  $user->fname.' '.$user->lname;
            $users->email = $user->fname[0].$user->mname[0].$user->lname.'@nro12';
            $users->password = bcrypt($user->fname[0].$user->mname[0].$user->lname[0].'123456');
            $users->employee_id = $employee->id;
            $users->usertype_id = 4;
            $users->save();

             
    	}
        return redirect(route('users'))->with('success', 'Users Updated Successfully');
    }

    public function users(){
        $employees = employee::all();
        $array = [];
        $usertypes = usertype::all();

        foreach ($employees as $em) {
            $user = User::join('usertypes', 'usertype_id', '=', 'usertypes.id')->where('employee_id', $em->id)->select('users.*', 'usertypes.name as type')->first();

            $array[] = array(
                'id' => $em->id,
                'fname' => $em->first_name,
                'mname' => $em->middle_name,
                'lname' => $em->last_name,
                'username'=> !empty($user) ? $user->email : '',
                'type' =>  !empty($user) != 0 ? $user->type : '',
                'position' => $em->posabv,
                'division' => $em->division,
                'user_id' => !empty($user) != 0 ? $user->id : ''
            );
        }
        return view('libraries.users')->with('employees', $array)->with('usertypes', $usertypes);
    }

    public function setuser(Request $data){
        //return $data->all();
        $user = User::where('id', $data['id'])->first();

        $user->usertype_id = $data['type'];
        $user->email = $data['username'];
        $user->password = bcrypt($data['password']);
        $user->save();

        return redirect(route('users'))->with('success', 'Users Updated Successfully');
    }
}
