<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Blog\StoreBlogValidation;
use App\Http\Requests\Blog\UpdateBlogValidation;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends BaseController
{
    protected $panel = 'Blog';
    protected $view_path = 'admin.blog';
    protected $base_route = 'admin.blog';
    protected $folder = 'blog';

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
        $data['rows'] = Blog::select('id', 'title', 'photo', 'slug', 'status', 'rank')->latest()->get();
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
    public function store(StoreBlogValidation $request)
    {
        $validated = $request->validated();
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['status'] = isset($request['status']) && $request['status'] == "on" ? 1 : 0;

        //upload file
        if ($request->hasFile('main_photo')) {
            $file = $validated['main_photo'];

            //public path to image
            $path = public_path('images/blog');
            $file_name = $validated['slug'] . '.' . $file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/blog'))) {
                @mkdir(public_path('images/blog'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //update photo name in validated array
            $validated['photo'] = $file_name;
        }


        $work = Blog::create($validated);

        $request->session()->flash($work ? 'success_message' : 'error_message', $this->panel . ' ' . $request->title . ' added Successfully');

        return redirect()->route($this->base_route . '.index');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $blog = Blog::find($id);
        $this->resourceExist($blog);


        return view($this->loadDataToView($this->view_path . '.edit'), compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogValidation $request, $id)
    {
        $validated = $request->validated();
        $blog = Blog::find($id);
        $this->resourceExist($blog);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['status'] = isset($request['status']) && $request['status'] == "on" ? 1 : 0;
        //upload file
        if ($request->hasFile('main_photo')) {
            $file = $validated['main_photo'];

            //public path to image
            $path = public_path('images/blog');
            $file_name = $validated['slug'] . '.' . $file->getclientOriginalExtension();

            //check and create folder image
            if (!file_exists(public_path('images/blog'))) {
                @mkdir(public_path('images/blog'));
            }
            //move uploaded file to given path with given filename
            $file->move($path, $file_name);
            //remove old photo
            if (file_exists(public_path('images/blog/' . $blog->photo))) {
                @unlink(public_path('images/blog/' . $blog->photo));
            }
            //update photo name
            $validated['photo'] = $file_name;
        }


        $blog->update($validated);

        $request->session()->flash($blog ? 'success_message' : 'error_message', $this->panel . ' ' . $request->title . ' added Successfully');

        return redirect()->route($this->base_route . '.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $blog = Blog::find($id);
        $this->resourceExist($blog);


        if ($blog) {
            //remove old photo
            if (file_exists(public_path('images/blog/' . $blog->photo))) {
                @unlink(public_path('images/blog/' . $blog->photo));
            }
            $blog->delete();

            return redirect()->route($this->base_route.'.index')->with('success_message',$this->panel . ' ' . $request->title . ' Deleted Successfully');
        }
            return redirect()->route($this->base_route.'.index')->with('error_message',$this->panel . ' ' . $request->title .'Error Deleting  Now ');

        }

}
