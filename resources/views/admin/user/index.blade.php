@extends('admin.common.layout')
@section('title')
    {{ $_panel }}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$_panel}} </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ $dashboard }}">Home</a></li>
                            <li class="breadcrumb-item active">{{$_panel}} List</li>
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
                            <a href="{{route($_base_route.'.create')}}" class="btn btn-primary">
                                Add {{$_panel}}
                            </a>
                        </div>
                    </div><br>
                    @include('admin.common.alert')
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>photo</th>
                                        <th>Description</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($data['rows']) && $data['rows']->count() > 0)
                                        @foreach($data['rows'] as $key => $row)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>
                                                    @if($row->photo)
                                                        <img src="{{asset('images/user/'.$row->photo)}}"
                                                             alt="{{$row->title}}" height="100" width="100">
                                                    @else
                                                        No Image
                                                    @endif
                                                </td>
                                                <td>{{$row->description}}</td>
                                                <td>
{{--                                    <span class="btn btn-sm btn-{{$row->status? 'success':'danger'}}">--}}
{{--                                        {{$row->status? "Active" : "Inactive"}}--}}
{{--                                    </span>--}}
                                                </td>
                                                <td>
                                                    <a href="{{route($_base_route.'.edit',$row->id)}}" class="btn btn-success">Edit</a>
                                                    <a href="javascript:void(0)" onclick="var c = confirm('{{ "Are you sure?" }}');
                                                    if(c){document.getElementById('delete-{{$row->id}}').submit();
                                                    }" class="btn btn-sm swalDefaultQuestion btn-danger">
                                                        Delete
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="delete-{{$row->id}}" action="{{ route($_base_route.'.destroy',$row->id) }}" method="POST"  style="display: none;">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
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





