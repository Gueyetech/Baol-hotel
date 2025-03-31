<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $categories = Categorie::orderBy('id', 'asc')->paginate(6);
        return view('admin.categorie.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        return view('admin.categorie.form', [

            'categorie' => new Categorie()

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $categorie = Categorie::create($request->validate([
            'nom' => ['required','string']
        ]));
        return to_route('admin.categorie.index')->with('message', 'Le categorie a étè ajouté avec succes.');
    }
    public function recherche(Request $request)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $request->validate([
            'recherche' => ['required', 'min:1'],
        ]);

        $categories = Categorie::where('nom', 'like', "%$request->recherche%")->paginate(5);
        return view('admin.categorie.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        return view('admin.categorie.form', [
            'categorie' =>  $categorie
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }


        $categorie->update($request->validate([
            'nom' => ['required', 'string']
        ]));
        return to_route('admin.categorie.index')->with('message', 'Le categorie a étè modifié avec succes.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }

        $categorie->delete();
        return to_route('admin.categorie.index')->with('message','Le categorie a étè supprimé avec succes.');
    }
}
