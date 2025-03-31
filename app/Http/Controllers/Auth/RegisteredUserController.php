<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'tel' => ['required'],
            'genre' => ['required'],
            'adresse' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'pays' => ['required'],
            'password_confirmation' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $role = Role::where('role', '=', 'client')->get();

        $imageUrl = 'bh/user.jpeg';
        if ($request->has('image')) {
            $dossier = 'bh/client/';
            $path = public_path($dossier);
            !is_dir($path) && mkdir($path, 0755, true);
            $imageName = 'Client' . time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
            $imageUrl = $dossier . '' . $imageName;
        }

        $user = User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'tel' => $request->tel,
            'adresse' => $request->adresse,
            'genre' => $request->genre,
            'role_id' => $role[0]->id,
            'image' => $imageUrl,
            'password' => Hash::make($request->password),
        ]);
        $user->prenom = $request->prenom;
        $user->update();
        $client = new Client();
        $client->ville = $request->ville;
        $client->pays = $request->pays;
        $client->user_id = $user->id;
        $client->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
