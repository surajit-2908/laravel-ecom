<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if($usertype=='1')
        {
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();

            $order = Order::all();
            $total_revenue = 0;
            foreach($order as $order)
            {
                $total_revenue = $total_revenue + $order->price;
            }

            $total_delivered = Order::where('delivery_status','=','delivered')->get()->count();
            $total_processing = Order::where('delivery_status','=','Processing')->get()->count();

            return view ('admin.home',compact('total_product','total_order','total_user',
            'total_revenue','total_delivered','total_processing'));
        }
        else{
            $data = Product::all();
            return view ('home.user', compact('data'));
        }
    }

    public function index()
    {
        $data = Product::all();
        //dd($data);
        return view ('home.user', compact('data'));
    }

    public function cash_order(){
        $user= Auth::user();
        $userid=$user->id;
       
        $data= Cart::where('user_id', '=', $userid)->get();
        
        foreach($data as $data){
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'Cash on Delivery';
            $order->delivery_status = 'Processing';
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'We have Recieved your Order. 
        We will contact with you soon...');
    }

    public function stripe($totalprice){

        return view ('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for Payment." 
        ]);
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }

    public function orderUser()
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $order = Order::where('user_id','=',$userid)->get();
          
            return view ('home.order',compact('order'));
        }
        else
        {
            return redirect ('login');
        }
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);
        $order->delivery_status = "You canceled this order.";
        $order->save();
        return redirect()->back();
    }
}
