<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitor;

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
    public function index()
    {
        $counts = Visitor::orderBy('created_at',"DESC")->get();
        return view('home',compact('counts'));
    }
}
