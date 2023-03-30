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
        ];
        $this->validateRule = [
            'address' => 'required|string|bail',
            'talk'=>'required|string|numeric|bail',
            'sale_email'=>'required|email|bail',
        ];
        $this->middleware(['permission:Contact_list'], ['only' => ['index']]);
        $this->middleware(['permission:Contact_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Contact_show'], ['only' => ['show']]);
        $this->middleware(['permission:Contact_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Contact_delete'], ['only' => ['destroy']]);
    }
     /**
     * Display a listing of the resource.
     */
    public function index(){
        $contact = Contact::firstOrFail();
        return view('admin.contact.create',['contact'=>$contact]);
    }
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contact = Contact::firstOrFail();
        return view('admin.contact.create',['contact'=>$contact]);
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
            return redirect()->route('contact.index')->withToastSuccess('Thông tin liên hệ cập nhật thành công!');
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
