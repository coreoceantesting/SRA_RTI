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
        $rtiCounts = Rti::count();
        $appealCount = FirstAppeal::count();
        return view('admin.dashboard')->with(['rtiCounts' => $rtiCounts, 'appealCount' => $appealCount]);
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
