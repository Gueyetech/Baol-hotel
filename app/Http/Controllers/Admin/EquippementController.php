<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Equippement;
use App\Models\Reservable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquippementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $equippements = Equippement::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.equippement.index', [
            'equippements' => $equippements
        ]);
    }

    public function recherche(Request $request)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }

        $request->validate([
            'recherche' => ['required', 'min:3'],
        ]);

        $equippements = Equippement::where('nom', 'like', "%$request->recherche%")
        ->paginate(8);
        return view('admin.equippement.index', [
            'equippements' => $equippements
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
        return view('admin.equippement.form', [
            'equippement' => new Equippement(),
            'reservables' =>Reservable::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        Equippement::create($request->validate([
            'nom' => ['required'],
            'ref' => ['required'],
            'reservable_id' => ['required'],
        ]));
        return to_route('admin.equippement.index')->with('message', "Equippement  a étè ajouté avec succes.");

    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equippement $equippement)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        return view('admin.equippement.form', [
            'equippement' =>  $equippement,
            'reservables' => Reservable::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equippement $equippement)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $equippement->update($request->validate([
            'nom' => ['required'],
            'ref' => ['required'],
            'reservable_id' => ['required'],
        ]));
        return to_route('admin.equippement.index')->with('message', "Equippement  a étè modifié avec succes.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equippement $equippement)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $equippement->delete();
        return to_route('admin.equippement.index')->with('message', "Equippement  a étè supprimé avec succes.");
    }
}
