<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
class ContactController extends Controller
{
    public function __construct()
    {
        $this->setModel(Contact::class);
        $this->resourceName = 'contact';
        $this->modelName='Contact';
        $this->views = [
            'index' => 'admin.contact.index',
            'create' => 'admin.contact.create',
        ];
        $this->validateRule = [
            'address' => 'required|string|bail',
            'talk'=>'required|string|bail',
            'sale_email'=>'required|email|bail',
        ];

    }
     /**
     * Display a listing of the resource.
     */
    public function index(){
        $contact = Contact::latest()->first();
       return view('admin.contact.index',['contact'=>$contact]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('admin.contact.edit',['contact'=>$contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $validator = $request->validate($this->validateRule);
        if($validator){
            $contact->update([
                'address'=>$request->address,
                'talk'=>$request->talk,
                'sale_email'=>$request->sale_email,
            ]);
            return redirect()->route('contact.index')->withToastSuccess('Contact Updated Successfully!');
        }
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
        return redirect()->route('contact.index')->withToastSuccess('Contact Deleted Successfully!');
    }
}
