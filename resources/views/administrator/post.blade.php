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
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>PostID</th>
                                                <th>PostTitle</th>
                                                <th>Content</th>
                                                <th>Category</th>
                                                <th>Thumbnail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($posts as $post)
                                                <tr>
                                                    <td>{{ $post->id }}</td>
                                                    <td>{{ $post->title }}</td>
                                                    <td>{{ Str::limit($post->editor, 50) }}</td>

                                                    <td>
                                                        @foreach ($post->blogCategory as $category)
                                                            {{ $category->getCategoryName->category_name}}<br>
                                                        @endforeach

                                                    </td>
                                                    <td>
                                                        <img src="{{ ('uploads/' . $post->thumbnail) }}"
                                                            alt="Thumbnail" width="50">
                                                    </td>
                                                    <td><a href="{{ route('editpost', $post->id) }}"
                                                            class="btn btn-warning btn-sm">Update</a>
                                                        <form action="{{ route('post.delete', $post->id) }}" method="post"
                                                            style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
