<?php

namespace App\Http\Controllers\Registered;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Apartment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $apartments_array = Apartment::all();
        $contacts_array = Contact::all();
        $display = [];

        foreach($apartments_array as $apartment){
            if($apartment->user_id == $user_id){
                foreach($contacts_array as $contact){
                    if($contact->apartment_id == $apartment->id){
                        array_push($display, $contact);
                    }
                }
            }
        }
        //ddd($display);
        return view('registered.contacts.index',compact('display'));
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('registered.contacts.show', compact('contact'));
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('registered.contacts.index')->with('message', "hai eliminato un messaggio ricevuto da n.{$contact->email} è stata eliminato");
    }
}
