<!DOCTYPE html>
<html lang="en">


<!-- forms-editor.html  21 Nov 2019 03:55:08 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Ferwafa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <link href="{{ asset('static/img/federation/ferwafa.png')}}" rel="shortcut icon" />
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/codemirror/lib/codemirror.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/codemirror/theme/duotone-dark.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css')}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">
</head>

<body>
    @include('admin.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update News</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-body">

                                            <form method="POST" action="{{ route('news.page.update',$result->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                @if (session()->has('message'))
                                                <div style="color: red;">
                                                    {{ session()->get('message') }}
                                                </div>
                                                @endif
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="title" value="{{$result->title }}" class="form-control">
                                                        @error('title')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Caption</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="caption" value="{{$result->caption }}" class="form-control">
                                                        @error('caption')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">status</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <select name="statusID" class="form-control selectric">
                                                            @foreach($statuses as $status)
                                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Is Top News</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <select name="is_top" class="form-control selectric">
                                                            <option value="0">False</option>
                                                            <option value="1">True</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Image</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="file" id="imageInput" name="image" class="form-control">
                                                        @error('image')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <textarea name="description" class="summernote-simple">{{ $result->description}}</textarea>
                                                        @error('description')
                                                        <div style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <button class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <script src="{{ asset('assets/js/app.min.js')}}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('assets/bundles/summernote/summernote-bs4.js')}}"></script>
    <script src="{{ asset('assets/bundles/codemirror/lib/codemirror.js')}}"></script>
    <script src="{{ asset('assets/bundles/codemirror/mode/javascript/javascript.js')}}"></script>
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js')}}"></script>
    <script src="{{ asset('assets/bundles/ckeditor/ckeditor.js')}}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/ckeditor.js')}}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js')}}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js')}}"></script>
</body>