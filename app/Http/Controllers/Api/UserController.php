<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /*   $user = User::find($id); */

        /*  $user_products = Category::where('user_id', $user->id)->with('products')->get(); */
        /*  $user_products = Category::where('user_id', $user->id)
        ->with('products')
        ->with(['user' => function ($query) {
            $query->with('style'); // Seleziona le colonne desiderate dalla tabella dei colori
        }])
        ->get(); */


        $user_products = User::find($id)->with('style')->with('categories.products')->get();

        if (!$user_products) return response('Product Not Found', 404);
        return response()->json($user_products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
