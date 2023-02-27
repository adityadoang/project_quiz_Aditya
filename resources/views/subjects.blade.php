<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Project_Quiz</title>
    <style>
        body {
            background-color: rgb(0, 85, 255) !important;
        }

    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center">Project Quiz - <a >Aditya</a></h4>
                <div class="card border-0 shadow-sm rounded-md mt-4">
                    <div class="card-body">

                        <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">TAMBAH</a>
                        <a href="/teachers" class="btn btn-success mb-2" id="btn-Teachers">Teachers</a>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Subject</th>
                                    <th>Hours</th>
                                    <th>Action</th>
                                
                                </tr>
                            </thead>
                                @foreach($subjects as $subject)
                                <tr id="index_{{ $subject->id }}">
                                    <td>{{ $subject->id }}</td>
                                    <td>{{ $subject->subjects }}</td>
                                    <td>{{ $subject->hours }}</td>
                                
                                    <td class="text-center">
                                        <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $subject->id }}" class="btn btn-primary btn-sm">EDIT</a>
                                        <a href="javascript:void(0)" id="btn-delete-post" data-id="{{ $subject->id }}" class="btn btn-danger btn-sm">DELETE</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.modal-create-subjects')
    @include('components.modal-edit-subjects')
    @include('components.modal-delete-subjects')
</body>
</html>