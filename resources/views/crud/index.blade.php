@extends('admin.common.layout')
@section('title')
    CRUD INDEX
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
                            <li class="breadcrumb-item active">Crud List</li>
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
                <!-- Small boxes (Stat box) -->
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
