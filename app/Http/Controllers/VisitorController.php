<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resArr = [];
        if($request->branch!=''){
            $resArr = Visitor::where('branch',$request->branch)->whereDate('created_at', Carbon::today())->get();
        }

        if($resArr->count()>0){
            $data =[
                    'branch' =>$request->branch,
                    'count' =>$request->count,
                ];

            $data = Visitor::findorfail($resArr[0]->id);

            $count = $data->count + 1;

            $data->branch =$request->branch;
            $data->count = $count;

            $data = $data->save();

            $resupdate = Visitor::findorfail($resArr[0]->id);
  
            if($resupdate){
                $response = [
                    'success' => true,
                    'message' => "Customer count update",
                    'data'=>$resupdate->toArray()
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => "Error update customer count status",
                ];
                return response()->json($response, 404);
            } 
        }else{
            $data =[
                    'branch' =>$request->branch,
                    'count' =>$request->count,
                ];
            $res = Visitor::create($data);

            if($res){
                $response = [
                    'success' => true,
                    'message' => "Customer count save",
                    'data'  => $res->toArray()
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => "Error save customer count status",
                ];
                return response()->json($response, 404);
            } 
        }


       

    }

     public function decrease(Request $request)
    {
        $resArr = [];
        if($request->branch!=''){
            $resArr = Visitor::where('branch',$request->branch)->whereDate('created_at', Carbon::today())->get();
        }

        if($resArr->count()>0){
            $data =[
                    'branch' =>$request->branch,
                    'count' =>$request->count,
                ];

            $data = Visitor::findorfail($resArr[0]->id);

            $count = $data->count - 1;

            $data->branch =$request->branch;
            $data->count = $count;

            $data = $data->save();

            $resupdate = Visitor::findorfail($resArr[0]->id);
  
            if($resupdate){
                $response = [
                    'success' => true,
                    'message' => "Customer count update",
                    'data'=>$resupdate->toArray()
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => "Error update customer count status",
                ];
                return response()->json($response, 404);
            } 
        }else{
            $data =[
                    'branch' =>$request->branch,
                    'count' =>$request->count,
                ];
            $res = Visitor::create($data);

            if($res){
                $response = [
                    'success' => true,
                    'message' => "Customer count save",
                    'data'  => $res->toArray()
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => "Error save customer count status",
                ];
                return response()->json($response, 404);
            } 
        }


       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visitor =Visitor::where('branch',$id)->whereDate('created_at', Carbon::today())->get();
        if($visitor){
            $response = [
                'success' => true,
                'message' => "Customer data retrieve success",
                'data'=>$visitor->toArray()
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'success' => false,
                'message' => "Error in  customer count read",
            ];
            return response()->json($response, 404);
        } 
    }

    public function summary(Request $request)
    {
        $date = date('Y-m-d', strtotime($request->date));
        if($request->date!=''){
            $todayho =Visitor::where('branch','=',1)->whereDate('created_at', $date)->sum('count');
           

            $todayl1 =Visitor::where('branch','=',2)->whereDate('created_at', $date)->sum('count');
           

            $todayl2 =Visitor::where('branch','=',3)->whereDate('created_at', $date)->sum('count');
            

            $todaytotal = $todayho + $todayl1 + $todayl2;
        }else{
            $todayho =Visitor::where('branch','=',1)->whereDate('created_at', Carbon::today())->sum('count');
           

            $todayl1 =Visitor::where('branch','=',2)->whereDate('created_at', Carbon::today())->sum('count');
           

            $todayl2 =Visitor::where('branch','=',3)->whereDate('created_at', Carbon::today())->sum('count');
            

            $todaytotal = $todayho + $todayl1 + $todayl2;
        }



        $min_date = Visitor::select(DB::raw('MIN(created_at) as min_date'))->orderBy('created_at','asc')->get(['created_at'])->unique('created_at');

        $hototal = Visitor::where('branch','=',1)->sum('count');
        $l1total = Visitor::where('branch','=',2)->sum('count');
        $l2total = Visitor::where('branch','=',3)->sum('count');
        $summarytotal = Visitor::sum('count');


        $dataArr = [
            'todayho'=>$todayho,
            'todayl1'=>$todayl1,
            'todayl2'=>$todayl2,
            'todaytotal'=>$todaytotal,
            'hototal'=>$hototal,
            'l1total'=>$l1total,
            'l2total'=>$l2total,
            'summarytotal'=>$summarytotal

        ];


        $response = [
            'success' => true,
            'message' => "Customer data retrieve success",
            'data'=>$dataArr
        ];
        return response()->json($response, 200);
         
    }

    

    
}
