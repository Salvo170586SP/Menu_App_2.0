<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        $products = Product::whereHas('category', function ($query) use ($userId) {
            $query->whereHas('user', function ($query) use ($userId) {
                $query->where('id', $userId);
            });
        })->orWhereDoesntHave('category')->get();
       
        $categories = Category::where('user_id', Auth::id())->get();
 
        $user = Auth::user();
        return view('admin.home', compact('products','categories','user'));
    }
}
