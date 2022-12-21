@extends('admin.common.layout')
@section('title')
    CRUD EDIT
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Crud </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item ">Crud List</li>
                            <li class="breadcrumb-item active">Crud Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{route('crud.index')}}" class="btn btn-primary">
                                List Crud
                            </a>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Edit CRUD
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('crud.update',$crud->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" value="{{ $crud->title }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Photo</label>
                                            <input type="file" class="form-control" name="main_photo"  id="main_photo" aria-describedby="main_photolHelp">
                                            <label for="">Existing Image</label>
                                            @if($crud->photo)
                                                <img src="{{asset('images/crud/'.$crud->photo)}}"
                                                     alt="{{$crud->title}}" height="200" width="200">
                                            @else
                                                No Existing Image
                                            @endif
                                            @error('main_photo')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Rank</label>
                                            <input type="number" class="form-control" name="rank" value="{{ $crud->rank }}" id="rank"  aria-describedby="ranklHelp">
                                            @error('rank')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Description</label>
                                            <textarea class="form-control" name="description"  id="description"  rows="5" aria-describedby="ranklHelp">
                            {{ $crud->description }}
                            </textarea>
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" name="status" {{ $crud->status ? "checked" :"" }} id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Active</label>
                                            @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>                <!-- Small boxes (Stat box) -->
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection



