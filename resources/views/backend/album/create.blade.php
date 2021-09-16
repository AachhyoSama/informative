@extends('backend.layouts.app')
@push('styles')
    <style>
        .imgPreview img {
            padding: 8px;
            max-width: 150px;
        }
    </style>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create an Album <a href="{{ route('album.index') }}" class="btn btn-primary">View Albums</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Albums</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="col-sm-12">
                            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="col-sm-12">
                            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('album.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="album_cover">Album Cover:</label>
                                                    <input type="file" class="form-control" name="album_cover" id="album_cover" onchange="loadCover(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('album_cover') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="image_preview">Cover Preview:</label>
                                                <img id="album_cover_output" style="height: 100px;width: 180px;" src="{{ Storage::disk('uploads')->url('noimage.jpg') }}">
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Album Title">Album Title (In english):</label>
                                                    <input type="text" class="form-control" name="album_title[en]" placeholder="Enter Album Title">
                                                    <p class="text-danger">
                                                        {{ $errors->first('album_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Album Title">Album Title (In nepali):</label>
                                                    <input type="text" class="form-control" name="album_title[np]" placeholder="Enter Album Title">
                                                    <p class="text-danger">
                                                        {{ $errors->first('album_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="album_images">Select album images (Multiple images can be selected):</label>
                                                    <input type="file" class="form-control" name="album_images[]" id="images" multiple="multiple">
                                                    <p class="text-danger">
                                                        {{ $errors->first('album_images') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 user-image mb-3 text-center">
                                                <div class="imgPreview"> </div>
                                            </div>

                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
    <script>
        var loadCover = function(event) {
            var output = document.getElementById('album_cover_output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
        });
    </script>
@endpush
