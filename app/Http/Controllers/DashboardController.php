<?php

namespace App\Http\Controllers;

use App\Models\LotInfo;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
    public function index()
    {
        $data = LotInfo::where('exp', '<=', date('Y-m-d'))->with('product')->get();
        // return  $data;
        return view('dashboard')->with('data', $data);
    }

    public function analytics()
    {
        $data = [];
        $day = DB::table('invoices')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereDay('created_at', Carbon::now()->day)
            ->sum('total');

        $data += ['day' => $day];

        $month = DB::table('invoices')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total');
        $data += ['month' => $month];

        $year = DB::table('invoices')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total');
        $data += ['year' => $year];

        return  $data;
    }
}
