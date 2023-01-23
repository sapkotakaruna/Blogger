<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{

    public function resourceExist($resource)
    {
        if(!$resource)
            abort(404);
    }

    public function loadDataToView($view_path)
    {
        View::composer($view_path,function ($view){
           $view->with([
               'dashboard'=> route('home'),
               '_panel'   => $this->panel,
               '_view_path'=> $this->view_path,
               '_base_route'=> $this->base_route,
               '_folder'=> $this->folder,

           ]);
        });
        return $view_path;
    }
}
