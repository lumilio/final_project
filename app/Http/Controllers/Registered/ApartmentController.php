<?php

namespace App\Http\Controllers\Registered;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Auth::user()->apartments()->orderByDesc('id')->paginate(5);

        return view('registered.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        // ddd($services);
        return view('registered.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'address' => 'required|unique:apartments',
            'title' => 'required',
            'image' => 'nullable|image|max:500',
            'description' => 'nullable',
            'n_rooms' => 'nullable|numeric',
            'n_bathroom' => 'nullable|numeric',
            'n_bed' => 'nullable|numeric',
            'square_meters' => 'nullable|numeric',
            'visibility' => 'boolean',
            'latitude' => 'required',
            'longitude' => 'required',

        ]);

        if ($request->file('image')) {
            $image = Storage::put('apartments_images', $request->file('image'));

            $validate['image'] = $image;
        }

        $validate['slug'] = Str::slug($validate['address']);

        $validate['user_id'] = Auth::id();

        $apartment = Apartment::create($validate);

        if ($request->has('services')) {
            $request->validate([
                'services' => 'nullable|exists:services,id'
            ]);
            $apartment->services()->attach($request->services);
            //ddd($request->services);
        };
        return redirect()->route('registered.apartments.index')->with('message', "Hai inserito un nouvo appartamento con successo.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $choose_services_array = $apartment->services;
        return view('guest.apartments.show', compact('apartment','choose_services_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        if (Auth::id() === $apartment->user_id) {
            return view('registered.apartments.edit', compact('apartment', 'services'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            $validate = $request->validate([
                'address' => [
                    'required',
                    Rule::unique('apartments')->ignore($apartment->id)
                ],
                'title' => 'required',
                'image' => 'nullable|image|max:500',
                'description' => 'nullable',
                'n_rooms' => 'nullable|numeric',
                'n_bathroom' => 'nullable|numeric',
                'n_bed' => 'nullable|numeric',
                'square_meters' => 'nullable|numeric',
                'visibility' => 'boolean'
            ]);

            if ($request->file('image')) {
                Storage::delete($apartment->image);
                $image = Storage::put('apartments_images', $request->file('image'));

                $validate['image'] = $image;
            }

            $validate['slug'] = Str::slug($validate['address']);

            $apartment->update($validate);
            $apartment->services()->sync($request->services);

            return redirect()->route('registered.apartments.index')->with('message', "Hai modificato l'appartamento $apartment->address con successo.");
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            Storage::delete($apartment->image);
            $apartment->delete();

            return redirect()->route('registered.apartments.index')->with('message', "Hai eliminato l'appartamento $apartment->address con successo.");
        } else {
            abort(403);
        }
    }
}