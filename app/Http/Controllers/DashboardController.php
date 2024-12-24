<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardData(){
        $today = Carbon::now()->format('Y-m-d H:i:s');
        $total_company = Company::count();
        $total_employee = Employee::count();
        $total_user = User::count();
        $recent_companies = Company::latest()->take(5)->get();
        $recent_employees = Employee::latest()->take(5)->get();
        return view('dashboard',compact('today','total_company','total_employee','total_user','recent_companies','recent_employees'));
    }
}
