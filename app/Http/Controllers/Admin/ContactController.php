<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Blog\StoreBlogValidation;
use App\Http\Requests\Blog\UpdateBlogValidation;
use App\Http\Requests\Contact\StoreContactValidation;
use App\Http\Requests\Contact\UpdateContactValidation;
use App\Models\Blog;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactController extends BaseController
{
    protected $panel = 'Contact';
    protected $view_path = 'admin.contact';
    protected $base_route = 'admin.contact';
    protected $folder = 'contact';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $device = new ZKTeco('192.168.1.89', 4370);
//        $device->connect();
//
//        if($device){
//            $users = $device->getAttendance();
//            dd($users);
//        }
        $data['rows'] = Contact::select('id', 'name', 'slug','email','subject', 'status', 'rank')->latest()->get();
        return view($this->loadDataToView($this->view_path . '.index'), compact('data'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->loadDataToView($this->view_path . '.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactValidation $request)
    {
        $validated = $request->validated();
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['status'] = isset($request['status']) && $request['status'] == "on" ? 1 : 0;

        //upload file
        if ($request->hasFile('main_photo')) {
            $file = $validated['main_photo'];

            //public path to image
            $path = public_path('images/contact');
            $file_name = $validated['slug'] . '.' . $file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/contact'))) {
                @mkdir(public_path('images/contact'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //update photo name in validated array
            $validated['photo'] = $file_name;
        }


        $contact = Contact::create($validated);

        $request->session()->flash($contact ? 'success_message' : 'error_message', $this->panel . ' ' . $request->title . ' added Successfully');

        return redirect()->route($this->base_route . '.index');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $contact = Contact::find($id);
        $this->resourceExist($contact);


        return view($this->loadDataToView($this->view_path . '.edit'), compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactValidation $request, $id)
    {
        $validated = $request->validated();
        $contact = Contact::find($id);
        $this->resourceExist($contact);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['status'] = isset($request['status']) && $request['status'] == "on" ? 1 : 0;
        //upload file
        if ($request->hasFile('main_photo')) {
            $file = $validated['main_photo'];

            //public path to image
            $path = public_path('images/contact');
            $file_name = $validated['slug'] . '.' . $file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/contact'))) {
                @mkdir(public_path('images/contact'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //remove old photo
            if (file_exists(public_path('images/contact/' . $contact->photo))) {
                @unlink(public_path('images/contact/' . $contact->photo));
            }
            //update photo name
            $validated['photo'] = $file_name;
        }


        $contact->update($validated);

        $request->session()->flash($contact ? 'success_message' : 'error_message', $this->panel . ' ' . $request->title . ' added Successfully');

        return redirect()->route($this->base_route . '.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $contact = Contact::find($id);
        $this->resourceExist($contact);


        if ($contact) {
            //remove old photo
            if (file_exists(public_path('images/contact/' . $contact->photo))) {
                @unlink(public_path('images/contact/' . $contact->photo));
            }
            $contact->delete();

            return redirect()->route($this->base_route.'.index')->with('success_message',$this->panel . ' ' . $request->title . ' Deleted Successfully');
        }
            return redirect()->route($this->base_route.'.index')->with('error_message',$this->panel . ' ' . $request->title .'Error Deleting  Now ');

        }

}
