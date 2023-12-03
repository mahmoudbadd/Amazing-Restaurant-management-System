<?php

namespace App\Http\Controllers\Users;

use App\Models\Food\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Food\Checkout;
use App\Models\Food\Review;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getBooking(){
        $allBookings=Booking::where('user_id',Auth::user()->id)->get();
        return view('users.bookings',compact('allBookings'));
    }
    public function getOrders(){
        $allOrders=Checkout::where('user_id',Auth::user()->id)->get();
        return view('users.orders',compact('allOrders'));
    }

    public function viewReview(){
        
        return view('users.WriteReview');
    }

    public function submitReview(Request $request){

        Request()->validate([
            "name"=> "required|max:40",
            "review"=> "required",
            
        ]);

        $submitReview=Review::create([
            
            "name"=>$request->name,
            "review"=>$request->review,
            
        ]);
        if($submitReview){
            return redirect()->route('users.review.create')->with(['success'=>'review submitted successefully']);

        }
        
    }
    
}
