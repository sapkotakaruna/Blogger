@extends('admin.common.layout')
@section('title')
    TEIAL CREATE
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
                            <li class="breadcrumb-item active">Trial Create</li>
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
                                        Create Trial
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('admin.trial.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Sub Title</label>
                                            <input type="text" class="form-control" name="sub_title" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            @error('sub_title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Photo</label>
                                            <input type="file" class="form-control" name="main_photo" id="main_photo" aria-describedby="main_photolHelp">
                                            @error('main_photo')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Rank</label>
                                            <input type="number" class="form-control" name="rank" id="rank"  aria-describedby="ranklHelp">
                                            @error('rank')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="description" rows="5" aria-describedby="ranklHelp">

                            {{--                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
                            </textarea>
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" name="status" id="exampleCheck1">
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
                <!-- Small boxes (Stat box) -->
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection




<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blogger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<h1>TRIAL CREATE</h1>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>