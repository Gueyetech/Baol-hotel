<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $services = Service::orderBy('created_at', 'desc')->paginate(5);

        return view('admin.service.index', [
            'services' => $services
        ]);
    }
    public function recherche(Request $request)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $request->validate([
            'recherche' => ['required', 'min:1'],
        ]);

        $services = Service::where('nom', 'like', "%$request->recherche%")
        ->orwhere('description', 'like', "%$request->recherche%")
        ->paginate(5);
        return view('admin.service.index', [
            'services' => $services
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
        return view('admin.service.form', [
            'service' => new Service()
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
        Service::create($request->validate([
            'nom' => ['required'],
            'prix' => ['required'],
            'description' => ['required'],
        ]));

        return to_route('admin.service.index')->with('message', 'Le service  a étè ajouté avec succes.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        return view('admin.service.form', [
            'service' =>  $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $service->update($request->validate([
            'nom' => ['required'],
            'prix' => ['required'],
            'description' => ['required'],

        ]));
        return to_route('admin.service.index')->with('message', 'Le service  a étè modifié avec succes.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if (Auth::user()->role->role != 'admin') {
            return redirect()->back();
        }
        $service->delete();
        return to_route('admin.service.index')->with('message', 'Le service  a étè supprimé avec succes.');
    }
}
