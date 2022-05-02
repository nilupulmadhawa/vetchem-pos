<?php

namespace App\Http\Controllers;

use App\Models\LotInfo;
use App\Models\StartingCash;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

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

    public function download()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = StartingCash::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereDay('created_at', Carbon::now()->day)->latest()->first();
        if ($today === null) {
            return  redirect('/startofday');
        }
        if ($today->end_of_day >= 0) {
            return  redirect('/startofday');
        }
        $data = LotInfo::where('exp', '<=', date('Y-m-d'))->with('product')->get();
        // return  $data;
        return view('dashboard')->with('data', $data);
    }

    public function analytics()
    {
        $data = [];
        $day = DB::table('invoices')
            ->whereYear('paid_at', Carbon::now()->year)
            ->whereMonth('paid_at', Carbon::now()->month)
            ->whereDay('paid_at', Carbon::now()->day)
            ->sum('total');

        $data += ['day' => $day];

        $month = DB::table('invoices')
            ->whereYear('paid_at', Carbon::now()->year)
            ->whereMonth('paid_at', Carbon::now()->month)
            ->sum('total');
        $data += ['month' => $month];

        $year = DB::table('invoices')
            ->whereYear('paid_at', Carbon::now()->year)
            ->sum('total');
        $data += ['year' => $year];

        return  $data;
    }
}
