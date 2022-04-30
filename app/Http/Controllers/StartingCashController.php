<?php

namespace App\Http\Controllers;

use App\Models\StartingCash;
use App\Models\Invoice;
use App\Models\CashInOut;
use App\Models\SupplierInvoice;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StartingCashController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function prestore()
    {
        $yesterday = StartingCash::latest()->first();

        $day = Invoice::where('is_paid', 1)
            ->where('paid_at', '<=', Carbon::now())
            ->where('paid_at', '>=', $yesterday['created_at'])
            ->sum('total');
        // return $day;
        $cashIn = CashInOut::where('type', 'cashin')
            ->where('created_at', '<=', Carbon::now())
            ->where('created_at', '>=', $yesterday['created_at'])
            ->sum('amount');

        $cashOut = CashInOut::where('type', 'cashout')
            ->where('created_at', '<=', Carbon::now())
            ->where('created_at', '>=', $yesterday['created_at'])
            ->sum('amount');

        $supplierInvoice = SupplierInvoice::where('is_paid', 1)
            ->where('updated_at', '<=', Carbon::now())
            ->where('updated_at', '>=', $yesterday['created_at'])
            ->sum('total');

        $total = ($yesterday['start_of_day'] + $day + $cashIn) - ($cashOut + $supplierInvoice);

        $yesterday->end_of_day = $total;
        $yesterday->note = $yesterday->note . '/End of day not validated';
        // $yesterday->save();
        return $total;
    }

    public function endstore(Request $request)
    {
        $startingCash = StartingCash::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereDay('created_at', Carbon::now()->day)->latest()->first();


        $day = Invoice::where('is_paid', 1)
            ->where('paid_at', '<=', Carbon::now())
            ->where('paid_at', '>=', $startingCash['created_at'])
            ->sum('total');

        $cashIn = CashInOut::where('type', 'cashin')
            ->where('created_at', '<=', Carbon::now())
            ->where('created_at', '>=', $startingCash['created_at'])
            ->sum('amount');

        $cashOut = CashInOut::where('type', 'cashout')
            ->where('created_at', '<=', Carbon::now())
            ->where('created_at', '>=', $startingCash['created_at'])
            ->sum('amount');

        $supplierInvoice = SupplierInvoice::where('is_paid', 1)
            ->where('updated_at', '<=', Carbon::now())
            ->where('updated_at', '>=', $startingCash['created_at'])
            ->sum('total');

        $total = ($startingCash['start_of_day'] + $day + $cashIn) - ($cashOut + $supplierInvoice);

        // return $total;

        if ($request->amount < 0) {
            return view('endofday')->with('err', 'Amount is invalid');
        }
        $StartingCash = StartingCash::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereDay('created_at', Carbon::now()->day)->latest()->first();
        $StartingCash->end_of_day = $request->amount;
        $StartingCash->note = $StartingCash->note . '/End of day validated';

        if ($total == $request->amount) {
            $StartingCash->save();
            return  redirect('/');
        } elseif ($total > $request->amount) {
            $a = $total - $request->amount;
            return view('endofday')->with('err', 'Amount is invalid (+' . $a . ')');
        } else {
            $a = $request->amount - $total;
            return view('endofday')->with('err', 'Amount is invalid (-' . $a . ')');
        }
    }

    public function end()
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
        if ($today->end_of_day == -1.00) {
            return view('endofday');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = StartingCash::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereDay('created_at', Carbon::now()->day)->latest()->first();
        if ($today === null) {
            return view('startofday');
        } elseif ($today->end_of_day == -1.00) {
            return  redirect('/dashboard');
        }
        return view('startofday');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->amount < 0) {
            return view('startofday')->with('err', 'Amount is invalid');
        }
        $StartingCash = new StartingCash;
        $StartingCash->start_of_day = $request->amount;
        $StartingCash->note = 'Start of day validated';

        $yesterday = StartingCash::latest()->first();
        if ($yesterday === null) {
            $StartingCash->save();
            return  redirect('/dashboard');
        }



        if ($yesterday->end_of_day == -1.00) {
            $day = Invoice::where('is_paid', 1)
                ->where('paid_at', '<=', Carbon::now())
                ->where('paid_at', '>=', $yesterday['created_at'])
                ->sum('total');
            // return $day;
            $cashIn = CashInOut::where('type', 'cashin')
                ->where('created_at', '<=', Carbon::now())
                ->where('created_at', '>=', $yesterday['created_at'])
                ->sum('amount');

            $cashOut = CashInOut::where('type', 'cashout')
                ->where('created_at', '<=', Carbon::now())
                ->where('created_at', '>=', $yesterday['created_at'])
                ->sum('amount');

            $supplierInvoice = SupplierInvoice::where('is_paid', 1)
                ->where('updated_at', '<=', Carbon::now())
                ->where('updated_at', '>=', $yesterday['created_at'])
                ->sum('total');


            $total = ($yesterday['start_of_day'] + $day + $cashIn) - ($cashOut + $supplierInvoice);

            $yesterday->end_of_day = $total;
            $yesterday->note = $yesterday->note . '/End of day not validated';
            $yesterday->save();
        }



        if ($yesterday->end_of_day == $request->amount) {
            $StartingCash->save();
            return  redirect('/dashboard');
        } elseif ($yesterday->end_of_day > $request->amount) {
            $a = $yesterday->end_of_day - $request->amount;
            return view('startofday')->with('err', 'Amount is invalid (+' . $a . ')');
        } else {
            $a = $request->amount - $yesterday->end_of_day;
            return view('startofday')->with('err', 'Amount is invalid (-' . $a . ')');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StartingCash  $startingCash
     * @return \Illuminate\Http\Response
     */
    public function show(StartingCash $startingCash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StartingCash  $startingCash
     * @return \Illuminate\Http\Response
     */
    public function edit(StartingCash $startingCash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StartingCash  $startingCash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StartingCash $startingCash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StartingCash  $startingCash
     * @return \Illuminate\Http\Response
     */
    public function destroy(StartingCash $startingCash)
    {
        //
    }
}
