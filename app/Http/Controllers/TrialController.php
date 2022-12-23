<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use App\Models\Trial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Rats\Zkteco\Lib\ZKTeco;

class TrialController extends Controller
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
        $data['rows'] = Trial::select('id','name','sub_title','photo','slug','rank','status')->latest()->get();
        return view('admin.trial.index',compact('data'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated= $request->validate([
           'name'          =>['required','max:150'],
           'sub_title'      =>[ 'nullable'],
           'rank'           =>['required','numeric','gt:0'],
           'main_photo'     =>['required','file','max:2048'],
           'description'    =>['required','min:10'],
           'status'         =>['nullable'],
        ]);
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['status']=isset($request['status']) && $request['status'] == "on" ? 1:0 ;

        //upload file
        if($request->hasFile('main_photo')){
            $file = $validated['main_photo'];

            //public path to image
            $path =public_path('images/trial');
            $file_name = $validated['slug']. '.' .$file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/trial'))){
                @mkdir(public_path('images/trial'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //update photo name
            $validated['photo'] = $file_name;
        }



        $crud = Trial::create($validated);
        if($crud){
            return redirect()->route('admin.trial.index')->with('success_message','Trial Added Successfully');
        }
        return redirect()->route('admin.trial.create')->with('error_message','Trial  Has Not Added ');


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
        $trial = Trial::find($id);

        return view('admin.trial.edit',compact('trial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'=>        ['required','max:150'],
            'sub_title'      =>[ 'nullable'],
            'rank'=>         ['required','numeric','gt:0'],
            'main_photo'=>   ['nullable','file','max:2048'],
            'description'=>  ['required','min:10'],
            'status'=>       ['nullable'],
        ]);
        $trial = Trial::find($id);
        $validated['slug'] =Str::slug($validated['name']);
        $validated['status']=isset($request['status']) && $request['status'] == "on" ? 1:0 ;
        //upload file
        if($request->hasFile('main_photo')){
            $file = $validated['main_photo'];

            //public path to image
            $path =public_path('images/crud');
             $file_name = $validated['slug']. '.' .$file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/trial'))){
                @mkdir(public_path('images/trial'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //remove old photo
            if (file_exists(public_path('images/trial/'.$trial->photo))){
                @unlink(public_path('images/trial/'.$trial->photo));
            }
            //update photo name
            $validated['photo'] = $file_name;
        }

        $trial -> update($validated);

        if($trial){
            return redirect()->route('admin.trial.index')->with('success_message','Trial Update Successfully');
        }
        return redirect()->route('admin.trial.index')->with('error_message','Trial  Has Not Updated Now ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $trial = Trial::find($id);

        if($trial) {
            //remove old photo
            if (file_exists(public_path('images/trial/' . $trial->photo))) {
                @unlink(public_path('images/trial/' . $trial->photo));
            }
            $trial->delete();

            return redirect()->route('admin.trial.index')->with('success_message', 'Trial Update Successfully');
        }
            return redirect()->route('admin.trial.index')->with('error_message','Trial  Has Not Updated Now ');

        }
}
