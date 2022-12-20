<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blogger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<h1>CRUD INDEX</h1>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('crud.create')}}" class="btn btn-primary">
                Add Crud
            </a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Photo</th>
                            <th>Rank</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($data['rows']) && $data['rows']->count() > 0)
                            @foreach($data['rows'] as $key => $row)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $row->title }}</td>
                                <td>
                                    @if($row->photo)
                                        <img src="{{asset('images/crud/'.$row->photo)}}"
                                             alt="{{$row->title}}" height="100" width="100">
                                    @else
                                    No Image
                                    @endif
                                </td>
                                <td>{{$row->rank}}</td>
                                <td>
                                    <span class="btn btn-sm btn-{{$row->status? 'success':'danger'}}">
                                        {{$row->status? "Active" : "Inactive"}}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{route('crud.edit',$row->id)}}" class="btn btn-success">Edit</a>
                                    <a href="{{route('crud.delete',$row->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="6"> No Data To Display</td>
                        </tr>
                            @endif



                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
