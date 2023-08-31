<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function create()
    {
        $data = Category::all();
        return view ('admin.product.create', compact('data'));
    }

    public function add(Request $request)
    {
        if ($request->file('image')) {
            $filename =  time() . "." . $request->file('image')->getClientOriginalExtension();
            $path = public_path() . '/uploads/product';
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $request->file('image')->move($path, $filename);
        } else {
            $filename = null;
        }

     $data = new Product; 
     $data->title = $request->title;
     $data->description = $request->description;
     $data->image = $filename;
     $data->price = $request->price;
     $data->category = $request->category_id;
     $data->status = $request->status;
     $data->save();
     session()->flash('message', 'Product successfully Created.');
     return redirect('/product/list');
    }

    public function list()
    {
      $data = Product::all();
     return view('admin.product.list', compact('data'));
    }

    public function delete($id)
    {
     
        $data = Product::find($id);
      
    if($data){
        $data = Product::where('id',  $id)->delete();
        session()->flash('message', 'Product successfully Deleted.');
        return redirect('/product/list');
    }
    }

    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.product.edit', compact('product', 'category'));
    }

    public function update(Request $request, $id)
    {
        if ($id) {
            // Fetch Data
            $data2 = Product::find($id);
            if ($request->file('image')) {
                $filename =  time() . "." . $request->file('image')->getClientOriginalExtension();
                $path = public_path() . '/uploads/product';
                $request->file('image')->move($path, $filename);
            } else {
                $filename = $data2->image;
            }
        } else {
            $data2 = new Product();
            if ($request->file('image')) {
                $filename =  time() . "." . $request->file('image')->getClientOriginalExtension();
                $path = public_path() . '/uploads/product';
                $request->file('image')->move($path, $filename);
            }
        }
        $insertData = [
            'title'     => $request->input('title'),
            'description'    => $request->input('description'),
            'image'    => $filename,
            'category'     => $request->input('category_id'),
            'price' => $request->input('price'),
            'status'         => $request->input('status'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];
       // dd($insertData);
        $affected = DB::table('products')->where('id', $id)->update($insertData);
        session()->flash('message', 'Product successfully updated.');
        return redirect('/product/list');
    }

    public function details($id)
    {
      $product = Product::find($id);
     return view('admin.product.details', compact('product'));
    }

    public function search(Request $request)
    {
        $search_text = $request->search;
       
        $data = Product::where('title','LIKE',"%$search_text%")
        ->orWhere('category','LIKE',"%$search_text%")->get(); 
     
        return view ('home.user',compact('data'));
    }

}
