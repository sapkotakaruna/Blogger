<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Blog\StoreBlogValidation;
use App\Http\Requests\Blog\UpdateBlogValidation;
use App\Http\Requests\Contact\StoreContactValidation;
use App\Http\Requests\Contact\UpdateContactValidation;
use App\Http\Requests\User\StoreUserValidation;
use App\Http\Requests\User\UpdateUserValidation;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends BaseController
{
    protected $panel = 'User';
    protected $view_path = 'admin.user';
    protected $base_route = 'admin.user';
    protected $folder = 'user';

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
        $data['rows'] = User::select('id', 'name','email','photo', 'description')->latest()->get();
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
    public function store(StoreUserValidation $request)
    {
        $validated = $request->validated();
//        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
//        $validated['status'] = isset($request['status']) && $request['status'] == "on" ? 1 : 0;

        //upload file
        if ($request->hasFile('main_photo')) {
            $file = $validated['main_photo'];

            //public path to image
            $path = public_path('images/user');
            $file_name = $validated['name'] . '.' . $file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/user'))) {
                @mkdir(public_path('images/user'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //update photo name in validated array
            $validated['photo'] = $file_name;
        }


        $user = User::create($validated);

        $request->session()->flash($user ? 'success_message' : 'error_message', $this->panel . ' ' . $request->title . ' added Successfully');

        return redirect()->route($this->base_route . '.index');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
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
        $user = User::find($id);
        $this->resourceExist($user);


        return view($this->loadDataToView($this->view_path . '.edit'), compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserValidation $request, $id)
    {
        $validated = $request->validated();
        $user = User::find($id);
        $this->resourceExist($user);

//        $validated['slug'] = Str::slug($validated['name']);
//        $validated['status'] = isset($request['status']) && $request['status'] == "on" ? 1 : 0;
        //upload file
        if ($request->hasFile('main_photo')) {
            $file = $validated['main_photo'];

            //public path to image
            $path = public_path('images/user');
            $file_name = $validated['name'] . '.' . $file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/user'))) {
                @mkdir(public_path('images/user'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //remove old photo
            if (file_exists(public_path('images/user/' . $user->photo))) {
                @unlink(public_path('images/user/' . $user->photo));
            }
            //update photo name
            $validated['photo'] = $file_name;
        }


        $user->update($validated);

        $request->session()->flash($user ? 'success_message' : 'error_message', $this->panel . ' ' . $request->title . ' added Successfully');

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
        $user = User::find($id);
        $this->resourceExist($user);


        if ($user) {
            //remove old photo
            if (file_exists(public_path('images/user/' . $user->photo))) {
                @unlink(public_path('images/user/' . $user->photo));
            }
            $user->delete();

            return redirect()->route($this->base_route.'.index')->with('success_message',$this->panel . ' ' . $request->title . ' Deleted Successfully');
        }
            return redirect()->route($this->base_route.'.index')->with('error_message',$this->panel . ' ' . $request->title .'Error Deleting  Now ');

        }

}
