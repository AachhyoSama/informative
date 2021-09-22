@extends('backend.layouts.app')
@push('styles')
    <style>
        .imgPreview img
        {
            padding: 8px;
            max-width: 150px;
        }

        .wrapp
        {
            position: relative;
            padding: 3px;
        }

        .absolutebtn
        {
            position: absolute;
            top: 0;
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
                    <h1 class="m-0">Update Album => {{ $album->album_title['en'] }} <a href="{{ route('album.index') }}" class="btn btn-primary">View Albums</a></h1>
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
                                    <form action="{{ route('album.update', $album->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
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
                                                <img id="album_cover_output" style="height: 100px;width: 180px;" src="{{ Storage::disk('uploads')->url($album->album_cover) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Album Title">Album Title (In english):</label>
                                                    <input type="text" class="form-control" name="album_title[en]" placeholder="Enter Album Title" value="{{ $album->album_title['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('album_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Album Title">Album Title (In nepali):</label>
                                                    <input type="text" class="form-control" name="album_title[np]" placeholder="Enter Album Title" value="{{ $album->album_title['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('album_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Meta Information</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_title">Meta Title(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_title" placeholder="Meta Title for SEO" value="{{ $album->meta_title }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_keywords">Meta Keywords(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_keywords" placeholder="Meta Keywords for SEO" value="{{ $album->meta_keywords }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_keywords') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta-description">Meta Description (optional):</label>
                                                    <textarea name="meta_description" cols="30" rows="5" class="form-control" placeholder="Meta description..">{{ $album->meta_description }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="og_image">OG Image (1200 X 600): </label>
                                                    <input type="file" class="form-control" name="og_image" onchange="loadOg(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('og_image') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="">Current Og:</label> <br>
                                                <img id="current_og" style="height: 100px;" src="{{ Storage::disk('uploads')->url($album->og_image ? $album->og_image : 'noimage.jpg') }}">
                                            </div>

                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success" name="updateAlbum">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header text-center">
                                    <h3>Album Images</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mt-5 mb-5">
                                            @if (count($album_images) > 0)
                                                <div class="row">
                                                    @foreach ($album_images as $image)
                                                        <div class="col-md-3 wrapp">
                                                            <img src="{{ Storage::disk('uploads')->url($image->album_images) }}" alt="{{ $album->album_title['en'] }}" style="height: 200px; padding: 10px;">
                                                            <form action="{{ route('deleteAlbumImage', $image->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" data-id="{{ $image->id }}" class="btn btn-danger py-0 px-1 absolutebtn" title="Remove" class="remove">x</button>
                                                            </form>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <img src="{{ Storage::disk('uploads')->url('noimage.jpg') }}" alt="{{ $album->album_title['en'] }}" style="width:200px; max-height: 200px;">
                                            @endif
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <form action="{{ route('album.update', $album->id) }}" enctype="multipart/form-data" method="POST">
                                                @csrf
                                                @method("PUT")

                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="album_images">Add New Images (Multiple Images can be selected):</label>
                                                            <input type="file" class="form-control" name="album_images[]" id="images" multiple="multiple">
                                                            <p class="text-danger">
                                                                {{ $errors->first('album_images') }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 user-image mb-3 text-center">
                                                        <div class="imgPreview"> </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-success" name="updateImages">Save</button>
                                            </form>
                                        </div>
                                        <hr>
                                    </div>
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
    <script>
        var loadOg = function(event) {
            var output = document.getElementById('current_og');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endpush
