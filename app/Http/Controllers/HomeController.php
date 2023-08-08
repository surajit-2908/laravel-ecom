<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;

class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if($usertype=='1'){
            return view ('admin.home');
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
}
