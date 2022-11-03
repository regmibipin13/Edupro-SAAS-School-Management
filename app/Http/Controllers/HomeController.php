<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminIndex()
    {
        $attendances = Attendance::whereDate('created_at', Carbon::now())->get()->groupBy('classroom_id');
        return view('admin.dashboard', compact('attendances'));
    }

    public function userIndex()
    {
        $attendances = Attendance::whereDate('created_at', Carbon::now())->get()->groupBy('classroom_id');
        return view('user.dashboard', compact('attendances'));
    }
}
