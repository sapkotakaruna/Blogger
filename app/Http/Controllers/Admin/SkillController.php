<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Skill\StoreSkillValidation;
use App\Http\Requests\Skill\UpdateSkillValidation;
use App\Http\Requests\Work\StoreWorkValidation;
use App\Http\Requests\Work\UpdateWorkValidation;
use App\Models\Skill;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillController extends BaseController
{
    protected $panel = 'Skill';
    protected $view_path = 'admin.skill';
    protected $base_route = 'admin.skill';
    protected $folder = 'skill';

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
        $data['rows'] = Skill::select('id', 'title','percent', 'slug', 'status', 'rank')->latest()->get();
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
    public function store(StoreSkillValidation $request)
    {
        $validated = $request->validated();
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['status'] = isset($request['status']) && $request['status'] == "on" ? 1 : 0;

        //upload file
        if ($request->hasFile('main_photo')) {
            $file = $validated['main_photo'];

            //public path to image
            $path = public_path('images/skill');
            $file_name = $validated['slug'] . '.' . $file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/skill'))) {
                @mkdir(public_path('images/skill'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //update photo name in validated array
            $validated['photo'] = $file_name;
        }


        $skill = Skill::create($validated);

        $request->session()->flash($skill ? 'success_message' : 'error_message', $this->panel . ' ' . $request->title . ' added Successfully');

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
        $skill = Skill::find($id);
        $this->resourceExist($skill);


        return view($this->loadDataToView($this->view_path . '.edit'), compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkillValidation $request, $id)
    {
        $validated = $request->validated();
        $skill = Skill::find($id);
        $this->resourceExist($skill);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['status'] = isset($request['status']) && $request['status'] == "on" ? 1 : 0;
        //upload file
        if ($request->hasFile('main_photo')) {
            $file = $validated['main_photo'];

            //public path to image
            $path = public_path('images/skill');
            $file_name = $validated['slug'] . '.' . $file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/skill'))) {
                @mkdir(public_path('images/skill'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //remove old photo
            if (file_exists(public_path('images/work/' . $skill->photo))) {
                @unlink(public_path('images/work/' . $skill->photo));
            }
            //update photo name
            $validated['photo'] = $file_name;
        }


        $skill->update($validated);

        $request->session()->flash($skill ? 'success_message' : 'error_message', $this->panel . ' ' . $request->title . ' added Successfully');

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
        $skill = Skill::find($id);
        $this->resourceExist($skill);


        if ($skill) {
            //remove old photo
            if (file_exists(public_path('images/work/' . $skill->photo))) {
                @unlink(public_path('images/work/' . $skill->photo));
            }
            $skill->delete();

            return redirect()->route($this->base_route.'.index')->with('success_message',$this->panel . ' ' . $request->title .  ' Deleted Successfully');
        }
            return redirect()->route($this->base_route.'.index')->with('error_message',$this->panel . ' ' . $request->title . 'Error Deleting  Now ');

        }

}
