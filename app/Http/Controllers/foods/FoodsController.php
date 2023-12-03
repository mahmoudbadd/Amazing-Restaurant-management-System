<?php

namespace App\Http\Controllers\Foods;

use App\Models\Food\Cart;
use App\Models\Food\Food;
use App\Models\Food\Booking;
use Illuminate\Http\Request;
use App\Models\Food\Checkout;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;








class FoodsController extends Controller
{
    public function foodDetails($id){


        $foodItem= Food::find($id);

        //verifing if user added item to cart
        if(auth()->user()){
            $cartVerifing=Cart::where('food_id',$id)
            ->where('user_id',Auth::user()->id)->count();

            return view('foods.food-details',compact('foodItem','cartVerifing'));
        }else{
            return view('foods.food-details',compact('foodItem'));

        }
        
    }

    public function cart(Request $request, $id){

        $cart=Cart::create([
            "user_id"=>$request->user_id,
            "food_id"=>$request->food_id,
            "name"=>$request->name,
            "image"=>$request->image,
            "price"=>$request->price,
        ]);

        if($cart){
         return redirect()->route('food.details',$id)->with("success","Item added to cart Successfully");
        }

       /*  echo "item added to cart sucess"; */
        //return view("foods.food-details",compact("foodItem"));
    }

    public function displayCartItems(){


        if(auth()->user()){
            //display cart items
        $cartItems=Cart::where('user_id',Auth::user()->id)->get();

        //display price
        $price=Cart::where('user_id',Auth::user()->id)->sum('price');
 
         return view('foods.cart',compact('cartItems','price'));

        } else{
            abort('404');
        }

      

    }
    public function deleteCartItems($id){

        $deleteItem=Cart::where('user_id',Auth::user()->id)->
        where('food_id',$id);

        $deleteItem->delete();


        if($deleteItem){
            return redirect()->route('food.display.cart')->with("delete","Item deleted from cart Successfully");
           }
    }

    public  function preparecheckout(Request $request){  


        $value=$request->price;

        $price= Session::put('price',$value);
        
        $newPrice=Session::get('price');

        if($newPrice>0){

            if(Session::get('price')==0){
                abort('403');
            }else{
                return redirect()->route('foods.checkout');
            }
            
        }


    }
    public  function checkout(){  


        if(Session::get('price')==0){
            abort('403');
        }else{
            return view('foods.checkout');
        }
            
    }


    public function storeCheckout(Request $request){

        $checkout=Checkout::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "town"=>$request->town,
            "country"=>$request->country,
            "zipcode"=>$request->zipcode,
            "phone_number"=>$request->phone_number,
            "address"=>$request->address,
            "user_id"=>Auth::user()->id,
            "price"=>$request->price,
            "status"=>$request->status,

            
        ]);

        /* echo"go to paypal"; */
        


        if($checkout){
            if(Session::get('price')==0){
                abort('403');
            }else{
                return redirect()->route('foods.pay');
            }
        
        }
  
    }

    public  function pay(){  

        if(Session::get('price')==0){
            abort('403');
        }else{
            return view('foods.pay');
        }
        

       
}

public  function success(){  

    $deleteItem=Cart::where('user_id',Auth::user()->id);
   

    $deleteItem->delete();

    


    if($deleteItem){
        if(Session::get('price')==0){
            abort('403');
        }else{
            Session::forget('price');
        return view('foods.success')->with("success1","you paid for the products Successfully");
       }
    }

}

public function bookingTables(Request $request){

    Request()->validate([
        "name"=> "required|max:40",
        "email"=> "required|max:40",
        "date"=> "required",
        "num_people"=> "required",
        "req"=> "required",
    ]);

   $currentDate= date('m/d/y h:i:sa');
   if($request->date== $currentDate OR $request->date<$currentDate){
    return redirect()->route('home')->with(['error'=>'you can not book with the current date or with a date in the past']);

   }else{
    $bookingTables=Booking::create([
        "user_id"=>Auth::user()->id,
        "name"=>$request->name,
        "email"=>$request->email,
        "date"=>$request->date,
        "num_people"=>$request->num_people,
        "req"=>$request->req,
    ]);
    if($bookingTables){
        
        return redirect()->route('home')->with(['booked'=>'you booked a table successefully']);

       }
   }
   

}

public function menu(){

    $breakFastFoods=Food::select()->take(4)
        ->where('category','breakfast')->orderBy('id','desc')->get();

        $launchFoods=Food::select()->take(4)
        ->where('category','Launch')->orderBy('id','desc')->get();

        $DinnerFoods=Food::select()->take(4)
        ->where('category','Dinner')->orderBy('id','desc')->get();


        return view('foods.menu',compact('breakFastFoods','launchFoods','DinnerFoods'));

}

    
}
