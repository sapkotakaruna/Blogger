<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Trial\StoreTrialValidation;
use App\Http\Requests\Trial\UpdateTrialValidation;
use App\Models\Crud;
use App\Models\Trial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TrialController extends BaseController
{
    protected $panel= 'Trial';
    protected $view_path= 'admin.trial';
    protected $base_route= 'admin.trial';
    protected $folder= 'trial';
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
        return view($this->loadDataToView($this->view_path.'.index'),compact('data'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->loadDataToView($this->view_path.'.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrialValidation $request)
    {

        $validated= $request->validated();
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



        $trial = Trial::create($validated);

        $request->session()->flash($trial?'success_message':'error_message', $this->panel.' '.$request->title. ' added Successfully');

        return redirect()->route($this->base_route.'.index');
//        if($crud){
//            return redirect()->route('admin.trial.index')->with('success_message','Trial Added Successfully');
//        }
//        return redirect()->route('admin.trial.create')->with('error_message','Trial  Has Not Added ');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function show(Trial $trial)
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
        $this->resourceExist($trial);

        return view($this->loadDataToView($this->view_path.'.edit'),compact('trial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrialValidation $request, $id)
    {
        $validated = $request->validated();
        $trial = Trial::find($id);
        $this->resourceExist($trial);

        $validated['slug'] =Str::slug($validated['name']);
        $validated['status']=isset($request['status']) && $request['status'] == "on" ? 1:0 ;
        //upload file
        if($request->hasFile('main_photo')){
            $file = $validated['main_photo'];
//            dd($file);

            //public path to image
            $path =public_path('images/trial');
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

        $request->session()->flash($trial?'success_message':'error_message', $this->panel.' '.$request->title. ' added Successfully');

        return redirect()->route($this->base_route.'.index');

//        if($trial){
//            return redirect()->route('admin.trial.index')->with('success_message','Trial Update Successfully');
//        }
//        return redirect()->route('admin.trial.index')->with('error_message','Trial  Has Not Updated Now ');
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
        $this->resourceExist($trial);


        if ($trial) {
            //remove old photo
            if (file_exists(public_path('images/trial/' . $trial->photo))) {
                @unlink(public_path('images/trial/' . $trial->photo));
            }
            $trial->delete();

            return redirect()->route($this->base_route . '.index')->with('success_message', $this->panel . ' deleted Successfully');
        }
        }
    }
