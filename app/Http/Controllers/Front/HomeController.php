<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\Services;
use App\Models\Skill;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['about'] = AboutUs::where('status',1)->latest()->first();
        $data['skills'] = Skill::where('status',1)->orderBy('rank')->limit(4)->get();
        $data['services'] = Services::where('status',1)->orderBy('rank')->limit(6)->get();
        $data['works'] = Work::where('status',1)->orderBy('rank')->limit(6)->get();
        $data['blogs'] = Blog::where('status',1)->orderBy('rank')->limit(3)->get();
        $data['users'] = User::latest()->limit(3)->get();

//        dd($data);
        return view('front.home.index',compact('data'));

    }

    public function contactStore(Request $request)
    {

    }

    public function blog($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        if(! $blog)
            abort(404);
        return view('front.home.blog',compact('blog'));
    }
}
