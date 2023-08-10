<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link href="./static/img/federation/ferwafa.png" rel="shortcut icon" />
    <title>Ferwafa</title>
</head>


<body>
    @include('admin.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if (session()->has('message'))
                        <div class="badge badge-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <div class="card-header">
                            <h4>Available Photos</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <a href="{{ route('post.photo.view') }}" class="btn btn-primary">
                                            <i class="far fa-user"> &nbsp;</i>Add Photo
                                        </a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control" placeholder="Search" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Created Date</th>
                                        <th colspan="2">Action</th>

                                    </tr>
                                    @foreach($galleries as $item)
                                    <tr>
                                        <td class="text-truncate">
                                            <ul class="list-unstyled order-list m-b-0 m-b-0">
                                                <li class="team-member team-member-sm">
                                                    <img class="rounded-circle" src="{{ route('gallery.doc', $item['url']) }}" alt="user" data-toggle="tooltip" title="" data-original-title="Wildan Ahdian" />
                                                </li>
                                            </ul>
                                        </td>
                                        <td>{{$item['name']}} </td>
                                        <td>{{ date('jS M Y', strtotime($item['created_at'])) }}</td>
                                        <td>
                                            <a href="{{ route('edit.gallery', $item['id']) }}" class="btn btn-outline-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('delete.photo', $item['id']) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="module" src="/src/main.js"></script>
    <script src="./assets/js/app.min.js"></script>
    <script src="./assets/js/custom.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/custom.js"></script>

</body>