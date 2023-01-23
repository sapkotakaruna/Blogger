<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Work\StoreWorkValidation;
use App\Http\Requests\Work\UpdateWorkValidation;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkController extends BaseController
{
    protected $panel = 'Work';
    protected $view_path = 'admin.work';
    protected $base_route = 'admin.work';
    protected $folder = 'work';

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
        $data['rows'] = Work::select('id', 'title', 'photo', 'slug', 'status', 'rank')->latest()->get();
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
    public function store(StoreWorkValidation $request)
    {
        $validated = $request->validated();
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['status'] = isset($request['status']) && $request['status'] == "on" ? 1 : 0;

        //upload file
        if ($request->hasFile('main_photo')) {
            $file = $validated['main_photo'];

            //public path to image
            $path = public_path('images/work');
            $file_name = $validated['slug'] . '.' . $file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/work'))) {
                @mkdir(public_path('images/work'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //update photo name in validated array
            $validated['photo'] = $file_name;
        }


        $work = Work::create($validated);

        $request->session()->flash($work ? 'success_message' : 'error_message', $this->panel . ' ' . $request->title . ' added Successfully');

        return redirect()->route($this->base_route . '.index');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $work = Work::find($id);
        $this->resourceExist($work);


        return view($this->loadDataToView($this->view_path . '.edit'), compact('work'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkValidation $request, $id)
    {
        $validated = $request->validated();
        $work = Work::find($id);
        $this->resourceExist($work);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['status'] = isset($request['status']) && $request['status'] == "on" ? 1 : 0;
        //upload file
        if ($request->hasFile('main_photo')) {
            $file = $validated['main_photo'];

            //public path to image
            $path = public_path('images/work');
            $file_name = $validated['slug'] . '.' . $file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/work'))) {
                @mkdir(public_path('images/work'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //remove old photo
            if (file_exists(public_path('images/work/' . $work->photo))) {
                @unlink(public_path('images/work/' . $work->photo));
            }
            //update photo name
            $validated['photo'] = $file_name;
        }


        $work->update($validated);

        $request->session()->flash($work ? 'success_message' : 'error_message', $this->panel . ' ' . $request->title . ' added Successfully');

        return redirect()->route($this->base_route . '.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $work = Work::find($id);
        $this->resourceExist($work);


        if ($work) {
            //remove old photo
            if (file_exists(public_path('images/work/' . $work->photo))) {
                @unlink(public_path('images/work/' . $work->photo));
            }
            $work->delete();

            return redirect()->route($this->base_route.'.index')->with('success_message',$this->panel . ' ' . $request->title .  ' Deleted Successfully');
        }
            return redirect()->route($this->base_route.'.index')->with('error_message',$this->panel . ' ' . $request->title . 'Error Deleting  Now ');

        }

}
