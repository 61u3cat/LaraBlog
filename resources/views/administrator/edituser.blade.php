@extends('administrator.layouts.app')
@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        @if (Auth::check())
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">DataTable with default features</h3>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        <h5>{{ session('success') }}</h5>
                                    </div>
                                @endif
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="container">
                                        <form action="{{ route('user.edit.save' , $user->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="exampleFormControlTextarea1"
                                                        class="form-label">Name</label>
                                                    <input class="form-control title" name="name" type="text"
                                                        placeholder="edit name" aria-label="default input example" value="{{ $user->name }}">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="exampleFormControlTextarea1" class="form-label">email</label>
                                                    <input class="form-control slug" name="email" type="email"
                                                        placeholder="" aria-label="default input example" value="{{ $user->email }}">
                                                </div>
                                            </div>

                                            <div>
                                                <div class="row">

                                                    <div class="mb-3 col-md-6">
                                                        <label for="" class="form-label">Password</label>
                                                        <input type="password" class="form-control" name="password"
                                                            id="" placeholder="" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="" class="form-label">Confirm_Password</label>
                                                        <input type="password" class="form-control" name="confirm_password"
                                                            id="" placeholder="" />
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="mb-3">
                                                <button class="btn btn-primary col-12" type="submit">Post</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        @else
            <div class="alert alert-danger">
                You must be logged in to view this page.
            </div>
        @endif
    </div>
    <!-- /.content-wrapper -->
@endsection


