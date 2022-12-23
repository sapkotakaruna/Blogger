<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCrudValidation;
use App\Http\Requests\UpdateCrudValidation;
use App\Models\Crud;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Rats\Zkteco\Lib\ZKTeco;

class CrudController extends Controller
{
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
        $data['rows'] = Crud::select('id','title','photo','slug','rank','status')->latest()->get();
        return view('admin.crud.index',compact('data'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCrudValidation $request)
    {

        $validated= $request->validated();
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['status']=isset($request['status']) && $request['status'] == "on" ? 1:0 ;

        //upload file
        if($request->hasFile('main_photo')){
            $file = $validated['main_photo'];

            //public path to image
            $path =public_path('images/crud');
            $file_name =$validated['slug']. '.' .$file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/crud'))){
                @mkdir(public_path('images/crud'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //update photo name in validated array
            $validated['photo'] = $file_name;
        }



        $crud = Crud::create($validated);
        if($crud){
            return redirect()->route('admin.crud.index')->with('success_message','Crud Added Successfully');
        }
        return redirect()->route('admin.crud.create')->with('error_message','Crud  Has Not Added ');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function show(Crud $crud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id )
    {
        $crud = Crud::find($id);

        return view('admin.crud.edit',compact('crud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCrudValidation $request, $id)
    {
        $validated = $request->validated();
        $crud = Crud::find($id);
        $validated['slug'] =Str::slug($validated['title']);
        $validated['status']=isset($request['status']) && $request['status'] == "on" ? 1:0 ;
        //upload file
        if($request->hasFile('main_photo')){
            $file = $validated['main_photo'];

            //public path to image
            $path =public_path('images/crud');
            $file_name =$validated['slug']. '.' .$file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/crud'))){
                @mkdir(public_path('images/crud'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //remove old photo
            if (file_exists(public_path('images/crud/'.$crud->photo))){
                @unlink(public_path('images/crud/'.$crud->photo));
            }
            //update photo name
            $validated['photo'] = $file_name;
        }



        $crud -> update($validated);

        if($crud){
            return redirect()->route('admin.crud.index')->with('success_message','Crud Update Successfully');
        }
        return redirect()->route('admin.crud.index')->with('error_message','Crud  Has Not Updated Now ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $crud = Crud::find($id);

        if($crud) {
            //remove old photo
            if (file_exists(public_path('images/crud/' . $crud->photo))) {
                @unlink(public_path('images/crud/' . $crud->photo));
            }
            $crud->delete();

            return redirect()->route('admin.crud.index')->with('success_message', 'Crud Update Successfully');
        }
            return redirect()->route('admin.crud.index')->with('error_message','Crud  Has Not Updated Now ');

        }
}
