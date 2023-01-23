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
                        <h1 class="m-0">{{ $_panel }} </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ $dashboard }}">Home</a></li>
                            <li class="breadcrumb-item ">{{ $_panel }} List</li>
                            <li class="breadcrumb-item active">{{ $_panel }} Create</li>
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
                            <a href="{{route($_base_route.'.index')}}" class="btn btn-primary">
                                List {{ $_panel }}
                            </a>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Create {{ $_panel }}
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{route($_base_route.'.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @include($_view_path.'.common.form')
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





