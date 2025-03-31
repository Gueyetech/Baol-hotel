<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\NewClient;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $clients = Client::orderBy('id', 'asc')->paginate(5);

        return view('admin.client.index', [
            'clients' => $clients
        ]);
    }

    public function recherche(Request $request)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $request->validate([
            'recherche' => ['required', 'min:3'],
        ]);

        $clients = Client::whereHas('user', function ($query) use ($request) {
            $query->where('email', 'like', "%$request->recherche%")
                ->orwhere('prenom', 'like', "%$request->recherche%")
                ->orwhere('nom', 'like', "%$request->recherche%")
                ->orwhere('tel', 'like', "%$request->recherche%")
                ->orwhere('genre', 'like', "%$request->recherche%")
                ->orwhere('adresse', 'like', "%$request->recherche%")
                ->orwhere('ville', 'like', "%$request->recherche%")
                ->orwhere('pays', 'like', "%$request->recherche%");
        })->paginate(5);
        return view('admin.client.index', [
            'clients' => $clients
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        return view('admin.client.create', [
            'client' => new Client(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $request->validate([
            'prenom' => ['required'],
            'nom' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'adresse' => ['required'],
            'tel' => ['required'],
            'ville' => ['required'],
            'pays' => ['required'],
            'genre' => ['required'],
            'ville' => ['required'],
            'pays' => ['required']
        ]);
        $user = new User();

        if ($request->has('image')) {

            $dossier = 'bh/client/';
            $path = public_path($dossier);
            !is_dir($path) && mkdir($path, 0755, true);
            $imageName = 'Client' . time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
            $imageUrl = $dossier . $imageName;
            $user->image = $imageUrl;
        } else {
            $user->image = 'bh/user.jpeg';
        }
        $password = bin2hex(random_bytes(5));
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->adresse = $request->adresse;
        $user->tel = $request->tel;
        $user->role_id = 3;
        $user->genre = $request->genre;

        $user->save();

        $client = new Client();
        $client->ville = $request->ville;
        $client->pays = $request->pays;
        $client->active = 'active';
        $client->user_id = $user->id;
        $client->save();

        Mail::send(new NewClient($client, $password));
        return to_route('admin.client.index')->with('message', 'Le client a étè ajouté avec succes.');
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
    public function edit(Client  $client)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        return view('admin.client.edit', [
            'client' =>  $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client  $client)
    {
        if (Auth::user()->role->role != 'receptionniste' && Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $request->validate([
            'prenom' => ['required'],
            'nom' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'adresse' => ['required'],
            'tel' => ['required'],
            'ville' => ['required'],
            'genre' => ['required'],
            'pays' => ['required'],
        ]);
        $user = $client->user;

        if ($request->image != null) {

            $dossier = 'bh/client/';
            $path = public_path($dossier);
            !is_dir($path) && mkdir($path, 0755, true);
            $imageName = 'Client' . time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
            $imageUrl = $dossier . '' . $imageName;
            $user->image = $imageUrl;
        }

        // dd($user->image);
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->adresse = $request->adresse;
        $user->tel = $request->tel;
        $user->genre = $request->genre;
        $user->role_id = 3;
        $user->update();

        $client = new Client();
        $client->ville = $request->ville;
        $client->pays = $request->pays;
        $client->active = 'active';
        $client->update();

        return to_route('admin.client.index')->with('message', 'Le client a étè modifié avec succes.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client  $client)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }

        if ($client->active == 'active') {
            $client->active = 'inactive';
            $message = 'Le compte du client a étè desactivé avec succes.';
        } else {
            $client->active = 'active';
            $message = 'Le compte du client a étè activé avec succes.';
        }
        $client->update();
        return to_route('admin.client.index')->with('message', $message);
    }
}
