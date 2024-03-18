<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $products = Product::whereHas('category', function ($query) use ($userId) {
            $query->whereHas('user', function ($query) use ($userId) {
                $query->where('id', $userId);
            });
        })->orWhereDoesntHave('category')->paginate(8);

        $user = Auth::user();

        return view('admin.products.index', compact('products','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        $user = Auth::user();

        return view('admin.products.create', compact('categories','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'numeric|nullable',
            'price_bottle' => 'numeric|nullable',
            'price_goblet' => 'numeric|nullable',
            'quantity_cl' => 'numeric|nullable',
            'quantity_lt' => 'numeric|nullable',
        ], [
            'name.required' => 'Il nome è richiesto',
            'price.numeric' => 'il campo "prezzo" può contenere solo numeri',
            'price_bottle.numeric' => 'il campo "prezzo bottiglia" può contenere solo numeri',
            'price_goblet.numeric' => 'il campo "prezzo calice" può contenere solo numeri',
            'quantity_cl.numeric' => 'il campo "quantità cl" può contenere solo numeri',
            'quantity_lt.numeric' => 'il campo "quantità lt" può contenere solo numeri',
        ]);

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->name_eng = $request->name_eng;
            $product->description = $request->description;
            $product->description_eng = $request->description_eng;
            $product->manufacturer = $request->manufacturer;
            $product->price = $request->price;
            $product->price_goblet = $request->price_goblet;
            $product->price_bottle = $request->price_bottle;
            $product->quantity_cl = $request->quantity_cl;
            $product->quantity_lt = $request->quantity_lt;
            $product->category_id = $request->category_id;

            if (array_key_exists('url_img', $request->all())) {
                $url = Storage::put('/imgs_product', $request['url_img']);
                $product->url_img = $url;
            }

            $product->save();

            return redirect()->route('admin.products.index')->with('message', "$product->name creato con successo");;
        } catch (Exception $e) {

            return redirect()->route('admin.products.index')->with('message', 'Errore nella creazione');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $user = Auth::user();

        return view('admin.products.show', compact('product','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        if (Auth::id() !== optional($product->category)->user_id || Auth::id() == $product->category->user_id) {
            $categories = Category::where('user_id', Auth::id())->get();
            $user = Auth::user();

            return view('admin.products.edit', compact('product', 'categories','user'));
        } else {
            return abort(403, 'non sei autorizzato');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'numeric|nullable',
            'price_bottle' => 'numeric|nullable',
            'price_goblet' => 'numeric|nullable',
            'quantity_cl' => 'numeric|nullable',
            'quantity_lt' => 'numeric|nullable',
        ], [
            'name.required' => 'Il nome è richiesto',
            'price.numeric' => 'il campo "prezzo" può contenere solo numeri',
            'price_bottle.numeric' => 'il campo "prezzo bottiglia" può contenere solo numeri',
            'price_goblet.numeric' => 'il campo "prezzo calice" può contenere solo numeri',
            'quantity_cl.numeric' => 'il campo "quantità cl" può contenere solo numeri',
            'quantity_lt.numeric' => 'il campo "quantità lt" può contenere solo numeri',
        ]);

        try {

             //UPDATE DELL'IMMAGINE MA SE NON CARICO UN ALTRA IMMAGINE ELIMINA L'IMMAGINE ESISTENTE E METTE IL PLACEHOLDER
             if ($request->hasfile('url_img')) {

                if ($product->url_img == true) {
                    Storage::delete($product->url_img);
                }
                
                $url = Storage::put('/imgs_product', $request->file('url_img'));
                $product->url_img = $url;
            }

            $product->update([
                'name' => $request->name,
                'name_eng' => $request->name_eng,
                'description' => $request->description,
                'description_eng' => $request->description_eng,
                'manufacturer' => $request->manufacturer,
                'price' => $request->price,
                'price_goblet' => $request->price_goblet,
                'price_bottle' => $request->price_bottle,
                'quantity_cl' => $request->quantity_cl,
                'quantity_lt' => $request->quantity_lt,
                'category_id' => $request->category_id
            ]);

            return redirect()->route('admin.products.index')->with('message', "$product->name modificato con successo");
        } catch (Exception $e) {

            return redirect()->route('admin.products.index')->with('message', 'Errore nella modifica');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->url_img) {
            Storage::delete($product->url_img);
        }

        $product->delete();

        return back()->with('message', "$product->name eliminato con successo");
    }

    public function delete_img(Product $product)
    {
        if ($product->url_img) {
            Storage::delete($product->url_img);
             // Imposta il campo 'url_img' su null
             $product->url_img = null;
             // Salva le modifiche nel database
             $product->save();
        }

        return back();
    }
}
