<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactFormRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactFormRequest $request)
    {
        $data = $request->validated();
        $contact = new Contact();

        $contact->address = $data['address'];
        $contact->email = $data['email'];
        $contact->tel_1 = $data['tel_1'];
        $contact->tel_2 = $data['tel_2'];
        $contact->latitude = $data['latitude'];
        $contact->longitude = $data['longitude'];
        
        $contact->save();
        return redirect('admin/contacts')->with('message',"Contact has been created successfully!");

    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('admin.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactFormRequest $request, Contact $contact)
    {
        $data = $request->validated();

        $contact->address = $data['address'];
        $contact->email = $data['email'];
        $contact->tel_1 = $data['tel_1'];
        $contact->tel_2 = $data['tel_2'];
        $contact->latitude = $data['latitude'];
        $contact->longitude = $data['longitude'];

        $contact->update();
        return redirect('admin/contacts')->with('message',"Contact has been updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        if($contact){
            $contact->delete();
            return redirect('admin/contacts')->with('message',"Contact has been deleted successfully!");
        }else {
            return redirect('admin/contacts')->with('message',"No contact id founded!");
        }
    }
}
