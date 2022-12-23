@extends('admin.common.layout')
@section('title')
    TRIAL EDIT
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Trial </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item ">Trial List</li>
                            <li class="breadcrumb-item active">Trial Edit</li>
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
                            <a href="{{route('admin.trial.index')}}" class="btn btn-primary">
                                List Trial
                            </a>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Edit Trial
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('admin.trial.update',$trial->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $trial->name }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Sub Title</label>
                                            <input type="text" class="form-control" name="sub_title" value="{{ $trial->sub_title }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            @error('sub_title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Photo</label>
                                            <input type="file" class="form-control" name="main_photo"  id="main_photo" aria-describedby="main_photolHelp">
                                            <label for="">Existing Image</label>
                                            @if($trial->photo)
                                                <img src="{{asset('images/trial/'.$trial->photo)}}"
                                                     alt="{{$trial->title}}" height="200" width="200">
                                            @else
                                                No Existing Image
                                            @endif
                                            @error('main_photo')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Rank</label>
                                            <input type="number" class="form-control" name="rank" value="{{ $trial->rank }}" id="rank"  aria-describedby="ranklHelp">
                                            @error('rank')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Description</label>
                                            <textarea class="form-control" name="description"  id="description"  rows="5" aria-describedby="ranklHelp">
                            {{ $trial->description }}
                            </textarea>
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" name="status" {{ $trial->status ? "checked" :"" }} id="exampleCheck1">
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
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection




