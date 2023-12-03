<?php

namespace App\Http\Controllers\Admin;

use App\Models\Food\Food;
use App\Models\Admin\Admin;
use App\Models\Food\Booking;
use Illuminate\Http\Request;
use App\Models\Food\Checkout;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function viewLogin(){
        return view("admins.login");
    }

    public function checkLogin(Request $request){
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);

        
    }

    public function index(){


        //food count
        $foodCount=Food::select()->count();
        $checkoutCount=Checkout::select()->count();
        $bookingCount=Booking::select()->count();
        $adminCount=Admin::select()->count();

        return view("admins.index",compact('foodCount','checkoutCount','bookingCount','adminCount'));
    }

    public function allAdmins(){

        $admins=Admin::select()->orderBy('id','desc')->get();
        return view('admins.alladmins',compact('admins'));
    }

    public function createAdmins(){
        return view('admins.createadmins');
    }

    public function storeAdmins(Request $request){

        Request()->validate([
            "email"=> "required|max:40",
            "name"=> "required|max:40",
            "password"=> "required|max:80",
            
        ]);


        $admins=Admin::create([
            "email"=>$request->email,
            "name"=>$request->name,
            "password"=>Hash::make($request->password),
            
        ]);

        if($admins){
         return redirect()->route('admins.all')->with("success","Admin added  Successfully");
        }
    }

    public function allOrders(){
        $orders=Checkout::select()->orderBy('id','desc')->get();
        return view('admins.allorders',compact('orders'));
    }

    public function editOrders($id){

        $order=Checkout::find($id);
        return view('admins.editorders',compact('order'));

    }

    public function updateOrders(Request $request, $id){
        $order=Checkout::find($id);
        $order->update($request->all());

        if($order){
            return redirect()->route('admins.all.orders')->with("success","order updated Successfully");
           }

    }


    public function deleteOrders($id){
        $order=Checkout::find($id);
        $order->delete();
        if($order){
            return redirect()->route('admins.all.orders')->with("delete","deleted  Successfully");
           }
    }

    public function allBooking(){
        $booking=Booking::select()->orderBy('id','desc')->get();
        return view('admins.allbooking',compact('booking'));
    }

    public function editBooking($id){

        $booking=Booking::find($id);
        return view('admins.editbookings',compact('booking'));

    }

    public function updateBooking(Request $request, $id){
        $booking=Booking::find($id);
        $booking->update($request->all());

        if($booking){
            return redirect()->route('admins.all.bookings')->with("success","booking updated Successfully");
           }

    }

    public function deleteBooking($id){
        $booking=Booking::find($id);
        $booking->delete();
        if($booking){
            return redirect()->route('admins.all.bookings')->with("delete","deleted  Successfully");
           }
    }


    public function allFood(){
        $food=Food::select()->orderBy('id','desc')->get();
        return view('admins.allfood',compact('food'));
    }

    public function createFood(){
        return view('admins.createfood');
    }


    public function storeFood(Request $request){

        Request()->validate([
            "name"=> "required|max:40",
            "price"=> "required",
            "descrption"=> "required|max:200",
            "category"=> "required",
            "image"=> "required",
            
        ]);
        $destinationPath = 'assets/img/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $foods=Food::create([
            "name"=>$request->name,
            "price"=>$request->price,
            "descrption"=>$request->descrption,
            "category"=>$request->category,
            "image"=>$myimage
            
            
        ]);

        if($foods){
         return redirect()->route('admins.all.foods')->with("success","food added  Successfully");
        }
    }

    public function deleteFood($id){
        $food=Food::find($id);
        if(File::exists(public_path('assets/img/' . $food->image))){
            File::delete(public_path('assets/img/' . $food->image));
        }else{
            //dd('File does not exists.');
        }

        $food->delete();
        if($food){
            return redirect()->route('admins.all.foods')->with("delete"," food deleted  Successfully");
           }
    }


}
