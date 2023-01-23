<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Services\StoreServicesValidation;
use App\Http\Requests\Services\UpdateServicesValidation;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicesController extends BaseController
{
    protected $panel= 'Services';
    protected $view_path= 'admin.services';
    protected $base_route= 'admin.services';
    protected $folder= 'services';
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
        $data['rows'] = Services::select('id','title','photo','slug','status','rank')->latest()->get();
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
    public function store(StoreServicesValidation $request)
    {
        $validated= $request->validated();
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['status']=isset($request['status']) && $request['status'] == "on" ? 1:0 ;

        //upload file
        if($request->hasFile('main_photo')){
            $file = $validated['main_photo'];

            //public path to image
            $path =public_path('images/services');
            $file_name =$validated['slug']. '.' .$file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/services'))){
                @mkdir(public_path('images/services'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //update photo name in validated array
            $validated['photo'] = $file_name;
        }



        $services = Services::create($validated);

        $request->session()->flash($services?'success_message':'error_message', $this->panel.' '.$request->name. ' added Successfully');

        return redirect()->route($this->base_route.'.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id )
    {
        $services = Services::find($id);
        $this->resourceExist($services);


        return view($this->loadDataToView($this->view_path.'.edit'),compact('services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServicesValidation $request, $id)
    {
        $validated = $request->validated();
        $services = Services::find($id);
        $this->resourceExist($services);

        $validated['slug'] =Str::slug($validated['title']);
        $validated['status']=isset($request['status']) && $request['status'] == "on" ? 1:0 ;
        //upload file
        if($request->hasFile('main_photo')){
            $file = $validated['main_photo'];

            //public path to image
            $path =public_path('images/services');
            $file_name =$validated['slug']. '.' .$file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/services'))){
                @mkdir(public_path('images/services'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //remove old photo
            if (file_exists(public_path('images/services/'.$services->photo))){
                @unlink(public_path('images/services/'.$services->photo));
            }
            //update photo name
            $validated['photo'] = $file_name;
        }



        $services -> update($validated);

        $request->session()->flash($services?'success_message':'error_message', $this->panel.' '.$request->title. ' added Successfully');

        return redirect()->route($this->base_route.'.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $services = Services::find($id);
        $this->resourceExist($services);


        if($services) {
            //remove old photo
            if (file_exists(public_path('images/services/' . $services->photo))) {
                @unlink(public_path('images/services/' . $services->photo));
            }
            $services->delete();

            return redirect()->route($this->base_route.'.index')->with('success_message', 'AboutUs Deleted Successfully');
        }
            return redirect()->route($this->base_route.'.index')->with('error_message','Error Deleting  Now ');

        }
}
