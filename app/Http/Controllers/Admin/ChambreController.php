<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Chambre;
use App\Models\Etat;
use App\Models\Reservable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\returnSelf;

class ChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }

        $chambres = Chambre::orderBy('created_at', 'desc')->paginate(5);

        return view('admin.chambre.index', [
            'chambres' => $chambres
        ]);
    }

    public function recherche(Request $request)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $request->validate([
            'recherche' => ['required', 'min:1'],
        ]);
        $chambres = Chambre::whereHas('reservable', function ($query) use ($request) {
            $query->where('numero', 'like', "%$request->recherche%")
                ->orwhere('description', 'like', "%$request->recherche%");
        })->orwhereHas('reservable.categorie', function ($query) use ($request) {
            $query->where('nom', 'like', "%$request->recherche%");
        })->orwhereHas('reservable.etat', function ($query) use ($request) {
            $query->where('etat', 'like', "%$request->recherche%");
        })->paginate(5);

        return view('admin.chambre.index', [
            'chambres' => $chambres
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

        return view('admin.chambre.create', [
            'chambre' => new Chambre(),
            'categories' => Categorie::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // if (Auth::user()->role->role != 'admin') {
        //     return redirect()->back();
        // }
        if ( Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $request->validate([
            'image' => ['required'],
            'numero' => ['required'],
            'etage' => ['required'],
            'capacite' => ['required'],
            'tarif' => ['required'],
            'description' => ['required'],
            'categorie' => ['required'],
        ]);

        $dossier = 'bh/chambre/';
        $path = public_path($dossier);
        !is_dir($path) && mkdir($path, 0755, true);
        $imageName = 'C' . time() . '.' . $request->image->extension();
        $request->image->move($path, $imageName);
        $imageUrl = $dossier . '' . $imageName;


        // dd($imageUrl);

        $reservable = new Reservable();
        $reservable->image = $imageUrl;
        $reservable->numero = $request->numero;
        $reservable->etage = $request->etage;
        $reservable->capacite = $request->capacite;
        $reservable->tarif = $request->tarif;
        $reservable->etat_id = 1;
        $reservable->description = $request->description;
        $reservable->categorie_id = $request->categorie;
        $reservable->save();

        $chambre = new Chambre();
        $chambre->reservable_id = $reservable->id;
        $chambre->save();

        return to_route('admin.chambre.index')->with('message', 'Le chambre a étè ajouté avec succes.');
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
    public function edit(Chambre $chambre)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        return view('admin.chambre.edit', [
            'chambre' =>  $chambre,
            'categories' => Categorie::all(),
            'etats' => Etat::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chambre $chambre)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        if (Auth::user()->role->role != 'receptionniste') {
            $request->validate([
                'numero' => ['required'],
                'etage' => ['required'],
                'capacite' => ['required'],
                'tarif' => ['required'],
                'description' => ['required'],
                'categorie' => ['required'],
                'etat' => ['required'],
            ]);
        }


        $reservable = $chambre->reservable;
        if (Auth::user()->role->role != 'receptionniste') {

            if ($request->image != null) {
                File::delete($reservable->image);
                $dossier = 'bh/chambre/';
                $path = public_path($dossier);
                !is_dir($path) && mkdir($path, 0777, true);
                $imageName = 'C' . time() . '.' . $request->image->extension();
                $request->image->move($path, $imageName);
                $imageUrl = $dossier . '' . $imageName;
                $reservable->image = $imageUrl;
            }



            $reservable->numero = $request->numero;
            $reservable->etage = $request->etage;
            $reservable->capacite = $request->capacite;
            $reservable->tarif = $request->tarif;
            $reservable->description = $request->description;
            $reservable->categorie_id = $request->categorie;
        }

        $reservable->etat_id = $request->etat;
        $reservable->update();

        return to_route('admin.chambre.index')->with('message', 'Le chambre a étè modifié avec succes.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chambre $chambre)
    {
         // if (Auth::user()->role->role != 'admin') {
        //     return redirect()->back();
        // }
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $chambre->delete();
        return to_route('admin.chambre.index')->with('message', 'Le chambre a étè supprimé avec succes.');
    }
}
