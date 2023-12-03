<?php

namespace App\Http\Controllers;

use App\Models\Food\Food;
use App\Models\Food\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /*  public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $breakFastFoods=Food::select()->take(4)
        ->where('category','breakfast')->orderBy('id','desc')->get();

        $launchFoods=Food::select()->take(4)
        ->where('category','Launch')->orderBy('id','desc')->get();

        $DinnerFoods=Food::select()->take(4)
        ->where('category','Dinner')->orderBy('id','desc')->get();

        $reviews=Review::select()->take(4)
        ->orderBy('id','desc')->get();

        return view('home',compact('breakFastFoods','launchFoods','DinnerFoods','reviews'));
    
        //return view('home');
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        return view('pages.services');
    }


    public function contact(){
        return view('pages.contact');
    }
    

    
}
