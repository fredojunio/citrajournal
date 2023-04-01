<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->filter;
        if (!empty($filter)) {
            $contacts = Contact::where('umkm_id', Auth::user()->umkm->id)
                ->where('type', $filter)
                ->paginate(15);
        } else {
            $contacts = Contact::where('umkm_id', Auth::user()->umkm->id)->paginate(15);
        }

        return view('user.contact.contact', compact('contacts', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Contact::create([
                'name' => $request->name,
                'type' => $request->type,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'umkm_id' => Auth::user()->umkm->id,
            ]);

            return redirect()->route('umkm.contact.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.contact.index');
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        try {
            $contact->update([
                'name' => $request->name,
                'type' => $request->type,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            return redirect()->route('umkm.contact.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.contact.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('umkm.contact.index');
    }
}
