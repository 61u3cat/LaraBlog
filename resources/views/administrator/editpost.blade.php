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
                                        <form action="{{ route('editor.update', $posts->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="exampleFormControlTextarea1"
                                                        class="form-label">Title</label>
                                                    <input class="form-control title" name="title" type="text"
                                                        placeholder="write Title" aria-label="default input example"
                                                        value="{{ $posts->title }}">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Slug</label>
                                                    <input class="form-control slug" name="slug" type="text"
                                                        placeholder="Slug" aria-label="default input example"
                                                        value="{{ $posts->slug }}">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="input-group-text" for="inputGroupFile01">Thumbnail</label>
                                                <input type="file" name="thumbnail" class="form-control"
                                                    id="inputGroupFile01" value="{{ $posts->thumbnail }}">
                                            </div>

                                            <div class="mb-3">
                                                <textarea name="editor" id="editor1"></textarea>
                                            </div>
                                            {{-- @php $cats = [] @endphp
                                            @foreach ($categories as $key => $category)
                                                @foreach ($posts->blogCategory as $blogCategory)
                                                    @if ($category->id == $blogCategory->category_id)
                                                        @php $bcat = $blogCategory->getCategoryName->category_name @endphp
                                                    @endif
                                                @endforeach

                                                @if (@$bcat != $category->category_name)
                                                    @php $cats[$key]['id'] = $category->id @endphp
                                                    @php $cats[$key]['category_name'] = $category->category_name @endphp
                                                @endif
                                            @endforeach

                                            
                                            @foreach ($posts->blogCategory as $ssd)
                                                <div class="mb-3 form-check">
                                                    <input class="form-check-input" checked name="category[]"
                                                        type="checkbox" value="{{ $ssd->category_id }}"
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{ $ssd->getCategoryName->category_name }}
                                                    </label>
                                                </div>
                                            @endforeach

                                            @foreach (array_values($cats) as $cat)
                                                <div class="mb-3 form-check">
                                                    <input class="form-check-input" name="category[]" type="checkbox"
                                                        value="{{ $cat['id'] }}" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{ $cat['category_name'] }}
                                                    </label>
                                                </div>
                                            @endforeach

                                          --}}

                                            @foreach ($categories as $key => $category)
                                                <div class="mb-3 form-check">
                                                    <input class="form-check-input" @if(in_array($category->id, $blogcategory)) checked @endif name="category[]"
                                                        type="checkbox" value="{{ $category->id }}"
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{ $category->category_name }}
                                                    </label>
                                                </div>
                                            @endforeach


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


@push('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>


    <script>
        CKEDITOR.replace('editor1', {
            versionCheck: false
        });



        $('.title').keyup(function() {
            var Text = $(this).val();

            var slug = Text.toLowerCase()
                .replace(/ /g, "-")
                .replace(/[^\w-]+/g, "");

            $('.slug').val(slug);
        });
    </script>
@endpush
