<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

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
        //dd($data);
        session()->flash('message', 'Category successfully Deleted.');
        return redirect('/category/list');
    }
    }
}
