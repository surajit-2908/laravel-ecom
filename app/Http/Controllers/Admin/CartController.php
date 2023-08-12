<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  
    public function add(Request $request, $id)
    {
        
        if(Auth::id()){

           $user = Auth::user();
           $product=Product::find($id);

           $cart =new Cart;
           $cart->name = $user->name;
           $cart->email = $user->email;
           $cart->phone = $user->phone;
           $cart->address = $user->address;
           $cart->user_id = $user->id;
           $cart->product_title = $product->title;
           $cart->price = $product->price * $request->quantity;
           $cart->image = $product->image;
           $cart->product_id = $product->id;
           $cart->quantity = $request->quantity;
           $cart->save();
           return redirect()->back(); 
        }

        else{

            return redirect ('login');
        }
    }

    public function view()
    {
    if(Auth::id())
    {
        $id = Auth::user()->id;
        $cart = Cart::where('user_id', '=' , $id)->get();
        return view ('home.cart', compact('cart'));
    }
    else{
       return redirect ('login');
    }

    }

    public function delete($id)
    {
   
        $data = Cart::find($id);
        //dd($id);
    if($data){
        $data = Cart::where('id',  $id)->delete();
        session()->flash('message', 'Product successfully Removed from Cart.');
        return redirect('/cart/view');
    }
    }
   
}
