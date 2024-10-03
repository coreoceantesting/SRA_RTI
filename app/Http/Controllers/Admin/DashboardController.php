<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\Rti;
use App\Models\FirstAppeal;

class DashboardController extends Controller
{

    public function index()
    {
        if(auth()->user()->roles->pluck('name')[0] === "Department")
        {
            $rtiCounts = Rti::where('concerned_department', auth()->user()->department)->count();
            $appealCount = FirstAppeal::where('concerned_department', auth()->user()->department)->count();
            $approveRtiCount = Rti::where('concerned_department', auth()->user()->department)->where('approval_status', 'Approved')->count();
            $rtilists = Rti::where('concerned_department', auth()->user()->department)->latest()->get()->take(5);
        }else{
            $rtiCounts = Rti::count();
            $appealCount = FirstAppeal::count();
            $approveRtiCount = Rti::where('approval_status', 'Approved')->count();
            $rtilists = Rti::latest()->get()->take(5);
        }
        return view('admin.dashboard')->with(['rtiCounts' => $rtiCounts, 'appealCount' => $appealCount, 'approveRtiCount' => $approveRtiCount, 'rtilists' => $rtilists]);
    }

    public function changeThemeMode()
    {
        $mode = request()->cookie('theme-mode');

        if($mode == 'dark')
            Cookie::queue('theme-mode', 'light', 43800);
        else
            Cookie::queue('theme-mode', 'dark', 43800);

        return true;
    }
}
