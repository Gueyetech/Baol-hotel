<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\NewPersonnel;
use App\Models\Personnel;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\returnSelf;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $personnels = Personnel::orderBy('id', 'desc')->paginate(5);

        return view('admin.personnel.index', [
            'personnels' => $personnels,
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
        $personnels = Personnel::whereHas('user', function ($query) use ($request) {
            $query->where('email', 'like', "%$request->recherche%")
                ->orwhere('prenom', 'like', "%$request->recherche%")
                ->orwhere('nom', 'like', "%$request->recherche%")
                ->orwhere('genre', 'like', "%$request->recherche%")
                ->orwhere('tel', 'like', "%$request->recherche%")
                ->orwhere('adresse', 'like', "%$request->recherche%");
        })->paginate(5);

        return view('admin.personnel.index', [
            'personnels' => $personnels,
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
        $roles = Role::where('role', '!=', 'admin')->where('role', '!=', 'client')->get();
        return view('admin.personnel.create', [
            'personnel' => new Personnel(),
            'user' => new User(),
            'roles' => $roles

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
        $request->validate([
            'prenom' => ['required'],
            'nom' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'adresse' => ['required'],
            'tel' => ['required'],
            'role' => ['required'],
            'service' => ['required'],
            // 'image' => ['required']
        ]);

        $user = new User();
        if ($request->has('image')) {
            $dossier = 'bh/personnel/';
            $path = public_path($dossier);
            !is_dir($path) && mkdir($path, 0755, true);
            $imageName = 'P' . time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
            $imageUrl = $dossier . '' . $imageName;
            $user->image = $imageUrl;
        } else {
            $user->image = 'bh/user.jpeg';
        }


        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->adresse = $request->adresse;
        $user->role_id = $request->role;
        $user->tel = $request->tel;
        $user->genre = $request->genre;
        $password = bin2hex(random_bytes(5));
        $user->password = Hash::make($password);
        $user->save();
        $personnel = new Personnel();
        $personnel->service = $request->service;
        $personnel->user_id = $user->id;
        $personnel->save();
        Mail::send(new NewPersonnel($personnel, $password));

        return to_route('admin.personnel.index')->with('message', 'Le personnel  a étè ajouté avec succes.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personnel $personnel)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $roles = Role::all();

        return view('admin.personnel.edit', [
            'personnel' =>  $personnel,
            'roles' =>  $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personnel $personnel)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $request->validate([
            'prenom' => ['required'],
            'nom' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'adresse' => ['required'],
            'tel' => ['required'],
            'role' => ['required'],
            'service' => ['required']
        ]);

        $user = $personnel->user;

        if ($request->image != null) {
            File::delete($user->image);
            $dossier = 'bh/personnel/';
            $path = public_path($dossier);
            !is_dir($path) && mkdir($path, 0755, true);
            $imageName = 'P' . time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
            $imageUrl = $dossier . '' . $imageName;
            $user->image = $imageUrl;
        }
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->adresse = $request->adresse;
        $user->genre = $request->genre;
        $user->role_id = $request->role;
        $user->tel = $request->tel;
        $user->update();


        $personnel->service = $request->service;
        $personnel->update();

        return to_route('admin.personnel.index')->with('message', 'Le personnel  a étè modifié avec succes.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personnel $personnel)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        if ($personnel->active == 'active') {
            $personnel->active = 'inactive';
            $message = 'Le compte du personnel a étè desactivé avec succes.';
        } else {
            $personnel->active = 'active';
            $message = 'Le compte du personnel a étè activé avec succes.';
        }
        $personnel->update();

        return to_route('admin.personnel.index')->with('message', $message);
    }
}
