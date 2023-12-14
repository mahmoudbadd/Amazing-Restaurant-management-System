<?php

namespace App\Http\Controllers\Admin;

use App\Models\Food\Food;
use App\Models\Admin\Admin;

use App\Models\Food\Booking;
use Illuminate\Http\Request;
use App\Models\Food\Category;
use App\Models\Food\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Food\Subcatgory;
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
        $foods = Food::with('category','subcategory')->get();
       
        $food=Food::select()->orderBy('id','desc')->get();
        return view('admins.allfood',compact('food','foods'));
    }

    public function createFood(){
        $categories = Category::all();
        $subcategories = Subcatgory::all();
        return view('admins.createfood',compact('categories','subcategories'));
    }


    public function storeFood(Request $request){

        Request()->validate([
            "name"=> "required|max:40",
            "price"=> "required",
            "description"=> "required|max:200",
            "category_id"=> "required",
            "subcategory_id"=> "required",
            "image"=> "required",
            
        ]);
        $destinationPath = 'assets/img/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $foods=Food::create([
            "name"=>$request->name,
            "price"=>$request->price,
            "description"=>$request->description,
            "category_id"=>$request->category_id,
            "subcategory_id"=>$request->subcategory_id,
            "image"=>$myimage
            
            
        ]);

        if($foods){
         return redirect()->route('admins.all.foods')->with("success","food added  Successfully");
        }
    }

    public function edit($id){
        $categories = Category::all();
        $subcategories = Subcatgory::all();
        $food = Food::findOrFail($id);

    
    return view('admins.editfood', compact('food', 'categories','subcategories'));
    }

    public function update(Request $request ,$id){
        $food = Food::findOrFail($id);

        $destinationPath = 'assets/img/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);


        $food->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'description' => $request->input('description'),
            "image"=>$myimage
           
        ]);

        
        $food->save();

        return redirect()->route('admins.all.foods');
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

    public function allcategory(){
       
        $category=Category::select()->orderBy('id')->get();
        return view('admins.allcategory',compact('category'));
    }

    public function createCategory(){
        return view('admins.createcategory');
    }

    public function storeCategory(Request $request){

        $category=Category::create([
            "name"=>$request->name,
            
            
        ]);

        if($category){
            return redirect()->route('admins.all.category');
           }

        
    }

    public function deleteCategory($id){
        $category=Category::find($id);
        $category->delete();
        if($category){
            return redirect()->route('admins.all.category');
           }
    }
    public function editCategory($id)
{
    $category = Category::findOrFail($id);
    $subcategories = Subcatgory::all();

    return view('admins.editcategory', compact('category','subcategories'));
}

public function updateCategory(Request $request, $id)
{
    // Validation logic here

    $category = Category::findOrFail($id);

    $category->update([
        'name' => $request->input('name'),
        // Add other fields as needed
    ]);

    return redirect()->route('admins.all.category');
}


public function allsubcategory(){
       
    $subcategory=Subcatgory::select()->orderBy('id')->get();
    return view('admins.allsubcategory',compact('subcategory'));
}


public function createSubcategory(){
    $categories = Category::all();
    return view('admins.createsubcategory',compact('categories'));
}


public function storeSubcategory(Request $request){

    $subcategory=Subcatgory::create([
        "name"=>$request->name,
        "category_id"=>$request->category_id,
        
    ]);

    if($subcategory){
        return redirect()->route('admins.all.subcategory');
       }

    
}

public function deleteSubcategory($id){
    $subcategory=Subcatgory::find($id);
    $subcategory->delete();
    if($subcategory){
        return redirect()->route('admins.all.subcategory');
       }
}

public function editSubcategory($id){
    $categories = Category::all();
    $subcategory = Subcatgory::findOrFail($id);


return view('admins.editsubcategory', compact('subcategory', 'categories'));
}

public function updateSubcategory(Request $request, $id)
{
    // Validation logic here

    $subcategory = Subcatgory::findOrFail($id);

    $subcategory->update([
        'name' => $request->input('name'),
        'category_id' => $request->input('category_id'),
        // Add other fields as needed
    ]);

    return redirect()->route('admins.all.subcategory');
}

public function getSubcategories($category)
{
    $subcategories = Subcatgory::where('category_id', $category)->get();
    
    return response()->json($subcategories);
}

}
