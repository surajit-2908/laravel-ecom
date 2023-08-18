<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
  public function add(Request $request)
  {
   $data = new Category; 
   $data->name = $request->category;
   $data->save();
   session()->flash('message', 'Category successfully Created.');
   return redirect('/category/list');
  }

    public function list()
    {
      $data = Category::all();
     return view('admin.category.list', compact('data'));
    }

    public function delete($id)
    {
     
        $data = Category::find($id);
      
    if($data){
        $data = Category::where('id',  $id)->delete();
        session()->flash('message', 'Category successfully Deleted.');
        return redirect('/category/list');
    }
    }

    public function orderList()
    {
      $data = Order::all();
     return view('admin.order.list', compact('data'));
    }

    public function delivered($id)
    {
      $order = Order::find($id);
      $order->delivery_status = "Delivered";
      $order->payment_status = "Paid";
      $order->save();
      return redirect()->back();
    }

    public function print_pdf($id)
   {
      $order = Order::find($id);
      $pdf = PDF::loadview('admin.pdf', compact('order'));
      return $pdf->download('order_details.pdf');
   }

   public function send_email($id)
   {
    $order = Order::find($id);
    return view ('admin.email_info', compact('order'));
   }

   public function send_user_email($id, Request $request)
   {
    $order = Order::find($id);
    $details = [
        'greeting' => $request->greeting,
        'firstline' => $request->firstline,
        'body' => $request->body,
        'url' => $request->url,
        'button' => $request->button,
        'lastline' => $request->lastline,
    ];

    Notification::send($order, new SendEmailNotification($details));
    return redirect()->back();
    
   }

}
