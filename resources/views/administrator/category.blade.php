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

    @if(Auth::check())
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

                        @if(session('success'))
                        <div class="alert alert-success">
                            <h5>{{session('success')}}</h5>
                        </div>
                        @endif
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="container">
                                <form action="{{route('category.save')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Category</label>
                                        <input class="form-control name" name="category_name" type="text" placeholder="write Title" aria-label="default input example">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Category_slug</label>
                                        <input class="form-control slug" name="category_slug" type="text" placeholder="write Title" aria-label="default input example">
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


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="container">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Slug</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category as $value)
                                        <tr>
                                            <td>{{$value->category_name}}</td>
                                            <td>{{$value->category_slug}}</td>
                                            <td><a href="{{route('category.edit',$value->id)}}" class="btn btn-warning btn-sm">Update</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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


@push('scripts')

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('editor1', {
        versionCheck: false
    });



    $('.name').keyup(function() {
        var Text = $(this).val();

        var slug = Text.toLowerCase()
            .replace(/ /g, "-")
            .replace(/[^\w-]+/g, "");

        $('.slug').val(slug);
    });
</script>
@endpush