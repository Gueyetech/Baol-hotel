<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // if (Auth::user()->role->role != 'client') {
        //     return redirect()->back();
        // }

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    public function information(Request $request): RedirectResponse
    {
        $request->validate([
            'prenom' => ['required'],
            'nom' => ['required'],
            'genre' => ['required'],
        ]);

        $user = Auth::user();
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->genre = $request->genre;
        $user->update();
        // dd($user);

        return Redirect::route('profile.edit')->with('status', 'profile-information');
    }


    public function contact(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255',],
            'tel' => ['required'],
        ]);

        $user = Auth::user();
        $user->email = $request->email;
        $user->tel = $request->tel;
        $user->update();
        return Redirect::route('profile.edit')->with('status', 'profile-contact');
    }

    public function changerImage(Request $request): RedirectResponse
    {

        $user = Auth::user();
        File::delete(public_path($user->image));
        $dossier = $user->client == null ? 'bh/personnel/' : 'bh/client/';
        $path = public_path($dossier);
        !is_dir($path) && mkdir($path, 0755, true);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = ($user->client == null ? 'P' : 'C') . time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $imageName);
            $imageUrl = $dossier . $imageName;
            $user->image = $imageUrl;
                  $user->update();
        }
        return Redirect::route('profile.edit');
    }

    public function adresse(Request $request): RedirectResponse
    {

        $request->validate([
            'adresse' => ['required'],
            'ville' => ['required'],
            'pays' => ['required'],
        ]);
        $user = Auth::user();
        $user->adresse = $request->adresse;
        if ($user->client != null) {
            $user->client->ville = $request->ville;
            $user->client->pays = $request->pays;
            $user->client->update();
        }
        $user->update();
        return Redirect::route('profile.edit')->with('status', 'profile-adresse');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // if (Auth::user()->role->role != 'client') {
        //     return redirect()->back();
        // }
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     // if (Auth::user()->role->role != 'client') {
    //     //     return redirect()->back();
    //     // }
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     // $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
