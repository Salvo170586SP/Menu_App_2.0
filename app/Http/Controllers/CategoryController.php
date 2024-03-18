<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $categories = Category::where('user_id', Auth::id())->orderBy('position', 'ASC')->paginate(8);

        return view('admin.categories.index', compact('categories','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        return view('admin.categories.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_category' => 'required|string',
        ], [
            'name_category.required' => 'Il nome è richiesto',
        ]);

        try {
            $category = new Category();
            $category->name_category = $request->name_category;
            $category->name_category_eng = $request->name_category_eng;
            $category->user_id = Auth::id();

            if (array_key_exists('url_img', $request->all())) {
                $url = Storage::put('/imgs_category', $request['url_img']);
                $category->url_img = $url;
            }

            $category->save();
            

            return redirect()->route('admin.categories.index')->with('message', "$category->name creato con successo");;
        } catch (Exception $e) {

            return redirect()->route('admin.categories.index')->with('message', 'Errore nella creazione');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if (Auth::id() == $category->user_id) {
            $user = Auth::user();
            return view('admin.categories.edit', compact('category','user'));
        } else {
            return abort(403, 'non sei autorizzato');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_category' => 'required|string'
        ], [
            'name_category.required' => 'Il nome è richiesto'
        ]);

        try {

               //UPDATE DELL'IMMAGINE MA SE NON CARICO UN ALTRA IMMAGINE ELIMINA L'IMMAGINE ESISTENTE E METTE IL PLACEHOLDER
               if ($request->hasfile('url_img')) {
                if ($category->url_img == true) {
                    Storage::delete($category->url_img);
                }

                $url = Storage::put('/imgs_category', $request->file('url_img'));
                $category->url_img = $url;
            }

            $category->update([
                'name_category' => $request->name_category,
                'name_category_eng' => $request->name_category_eng,
            ]);

            return redirect()->route('admin.categories.index')->with('message', "$category->name modificato con successo");
        } catch (Exception $e) {

            return redirect()->route('admin.categories.index')->with('message', 'Errore nella modifica');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->url_img) {
            Storage::delete($category->url_img);
        }

        $category->delete();

        return back()->with('message', "$category->name eliminato con successo");
    }

    public function changeCategoryPosition(Request $request, Category $category)
    {

        //prendo la osizione esistente
        $positionEsistente = $category->position;
        //prendo la osizione nuova dall'input
        $positionNuova =  intval($request->new_position);
        //prendo dove posizine ha la posizione nuova
        $categoryWithPosition2  = Category::where('position', $positionNuova)->first();

        //aggiorno la posizione con la posizione nuova
        $category->position = $positionNuova;
        $category->save();

        //aggiorno la posizione con la posizione eisistente
        $categoryWithPosition2->position = $positionEsistente;
        $categoryWithPosition2->save();

        //mando giù le categorie ordinate 
        $categories = Category::orderBy('position', 'ASC')->get();

        return redirect()->back()->with(['categories' => $categories])->with('message', "$category->name_category spostato nella posizione $category->position");
    }

    public function delete_img(Category $category)
    {
        if ($category->url_img) {
            Storage::delete($category->url_img);
            // Imposta il campo 'url_img' su null
            $category->url_img = null;
            // Salva le modifiche nel database
            $category->save();
        }

        return back();
    }
}
