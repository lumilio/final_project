<?php

namespace App\Http\Controllers\Registered;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
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
        return view('registered.apartments.create');
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
            'visibility' => 'boolean'
        ]);

        if ($request->file('image')) {
            $image = Storage::put('apartments_images', $request->file('image'));

            $validate['image'] = $image;
        }

        $validate['slug'] = Str::slug($validate['address']);

        $validate['user_id'] = Auth::id();

        Apartment::create($validate);

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
        return view('registered.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            return view('registered.apartments.edit', compact('apartment'));
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
