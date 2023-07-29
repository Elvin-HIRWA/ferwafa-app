<!DOCTYPE html>
<html lang="en">


<!-- forms-editor.html  21 Nov 2019 03:55:08 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link href="./static/img/federation/ferwafa.png" rel="shortcut icon" />
    <!-- General CSS Files -->
    <link rel="stylesheet" href="./assets/css/app.min.css">
    <link rel="stylesheet" href="./assets/bundles/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="./assets/bundles/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="./assets/bundles/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="./assets/bundles/jquery-selectric/selectric.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/components.css">
</head>

<body>
    @include('admin.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="POST" action="{{ route('sending.key') }}">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="section-title">Email</div>
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" required>
                                        @error('email')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="section-title">Select Permission</div>
                                    <div class="form-group">
                                        <select name="key" class="form-control select2">
                                            @foreach($keys as $key)
                                            <option value="{{$key->id}}">{{$key->permissionName}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button name="login" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <script src="./assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="./assets/bundles/summernote/summernote-bs4.js"></script>
    <script src="./assets/bundles/codemirror/lib/codemirror.js"></script>
    <script src="./assets/bundles/codemirror/mode/javascript/javascript.js"></script>
    <script src="./assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="./assets/bundles/ckeditor/ckeditor.js"></script>
    <!-- Page Specific JS File -->
    <script src="./assets/js/page/ckeditor.js"></script>
    <!-- Template JS File -->
    <script src="./assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="./assets/js/custom.js"></script>
</body>