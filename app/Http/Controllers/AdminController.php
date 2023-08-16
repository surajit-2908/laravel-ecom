<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use PDF;

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

}
