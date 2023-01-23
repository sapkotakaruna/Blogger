<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AboutUs\StoreAboutUsValidation;
use App\Http\Requests\AboutUs\UpdateAboutUsValidation;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutUsController extends BaseController
{
    protected $panel= 'AboutUs';
    protected $view_path= 'admin.aboutUs';
    protected $base_route= 'admin.aboutUs';
    protected $folder= 'aboutUs';
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
        $data['rows'] = AboutUs::select('id','name','photo','slug','status','email','rank')->latest()->get();
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
    public function store(StoreAboutUsValidation $request)
    {

        $validated= $request->validated();
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        $validated['status']=isset($request['status']) && $request['status'] == "on" ? 1:0 ;

        //upload file
        if($request->hasFile('main_photo')){
            $file = $validated['main_photo'];

            //public path to image
            $path =public_path('images/aboutUs');
            $file_name =$validated['slug']. '.' .$file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/aboutUs'))){
                @mkdir(public_path('images/aboutUs'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //update photo name in validated array
            $validated['photo'] = $file_name;
        }



        $aboutUs = AboutUs::create($validated);

        $request->session()->flash($aboutUs?'success_message':'error_message', $this->panel.' '.$request->name. ' added Successfully');

        return redirect()->route($this->base_route.'.index');


//        if($aboutUs){
//            return redirect()->route($this->base_route.'.index')->with('success_message','AboutUs Added Successfully');
//        }
//        return redirect()->route($this->base_route.'.create')->with('error_message','AboutUs  Has Not Added ');
//

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id )
    {
        $aboutUs = AboutUs::find($id);
        $this->resourceExist($aboutUs);


        return view($this->loadDataToView($this->view_path.'.edit'),compact('aboutUs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAboutUsValidation $request, $id)
    {
        $validated = $request->validated();
        $aboutUs = AboutUs::find($id);
        $this->resourceExist($aboutUs);

        $validated['slug'] =Str::slug($validated['name']);
        $validated['status']=isset($request['status']) && $request['status'] == "on" ? 1:0 ;
        //upload file
        if($request->hasFile('main_photo')){
            $file = $validated['main_photo'];

            //public path to image
            $path =public_path('images/aboutUs');
            $file_name =$validated['slug']. '.' .$file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/aboutUs'))){
                @mkdir(public_path('images/aboutUs'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //remove old photo
            if (file_exists(public_path('images/aboutUs/'.$aboutUs->photo))){
                @unlink(public_path('images/aboutUs/'.$aboutUs->photo));
            }
            //update photo name
            $validated['photo'] = $file_name;
        }



        $aboutUs -> update($validated);

        $request->session()->flash($aboutUs?'success_message':'error_message', $this->panel.' '.$request->name. ' added Successfully');

        return redirect()->route($this->base_route.'.index');

//        if($aboutUs){
//            return redirect()->route($this->base_route.'.index')->with('success_message','AboutUs Update Successfully');
//        }
//        return redirect()->route($this->base_route.'.index')->with('error_message','AboutUs  Has Not Updated Now ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $aboutUs = AboutUs::find($id);
        $this->resourceExist($aboutUs);


        if($aboutUs) {
            //remove old photo
            if (file_exists(public_path('images/aboutUs/' . $aboutUs->photo))) {
                @unlink(public_path('images/aboutUs/' . $aboutUs->photo));
            }
            $aboutUs->delete();

            return redirect()->route($this->base_route.'.index')->with('success_message', 'AboutUs Deleted Successfully');
        }
            return redirect()->route($this->base_route.'.index')->with('error_message','Error Deleting  Now ');

        }
}
