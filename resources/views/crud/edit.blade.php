<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<h1>CRUD EDIT</h1>

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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
