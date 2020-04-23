<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitor;
use Carbon\Carbon;
use DB;

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
    public function index(Request $request)
    {
        $todaycount = Visitor::whereDate('created_at', Carbon::today())->orderBy('branch','asc')->get();

        $data = new Visitor();

        $date = date('Y-m-d', strtotime($request->date));

        if($request->branch_id!=''){
            $data = $data->where('branch',$request->branch_id);
        }
        if($request->date!=''){
            $data = $data->whereDate('created_at',$date);
        }

        // if($request->branch_id=='' && $request->date==''){
        //    $counts = $counts->whereDate('created_at', Carbon::today());
        // }

        $counts =$data->orderBy('branch','asc')->paginate(5);
        $totalcount = $data->get();

        $min_date = Visitor::select(DB::raw('MIN(created_at) as min_date'))->orderBy('created_at','asc')->get(['created_at'])->unique('created_at');

        $hototal = Visitor::where('branch','=',1)->sum('count');
        $l1total = Visitor::where('branch','=',2)->sum('count');
        $l2total = Visitor::where('branch','=',3)->sum('count');
        $summarytotal = Visitor::sum('count');

        return view('home',compact('counts','todaycount','totalcount', 'min_date','hototal','l1total','l2total','summarytotal'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
}
