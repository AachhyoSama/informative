@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Feature Information <a href="{{ route('bullets.index') }}" class="btn btn-primary">View Features</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Features</li>
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
                                    <form action="{{ route('bullets.update', $existing_feature->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="icons">Feature Icon (png):</label>
                                                    <input type="file" class="form-control" name="icons" id="icons" onchange="loadLogo(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('icons') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="">Icon Preview:</label> <br>
                                                <img id="partner_logo_output" style="height: 150px; width:150px; background: black;" src="{{ Storage::disk('uploads')->url($existing_feature->icons) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Title (In English): </label>
                                                    <input type="text" class="form-control" name="title[en]" placeholder="Feature Title" value="{{ $existing_feature->title['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Title (In Nepali): </label>
                                                    <input type="text" class="form-control" name="title[np]" placeholder="Feature Title" value="{{ $existing_feature->title['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="descriptive_title">Descriptive title (In English): </label>
                                                    <input type="text" class="form-control" name="descriptive_title[en]" placeholder="Feature descriptive title" value="{{ $existing_feature->descriptive_title['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('descriptive_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="descriptive_title">Descriptive title (In Nepali): </label>
                                                    <input type="text" class="form-control" name="descriptive_title[np]" placeholder="Feature descriptive title" value="{{ $existing_feature->descriptive_title['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('descriptive_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-4">
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
        var loadLogo = function(event) {
            var output = document.getElementById('partner_logo_output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endpush
