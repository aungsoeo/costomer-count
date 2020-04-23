<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function summary()
    {
        $visitor =Visitor::whereDate('created_at', Carbon::today())->orderBy('branch','asc')->get();

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

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}
