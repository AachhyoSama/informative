@extends('backend.layouts.app')
@push('styles')
<!-- summernote css -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Membership Benefits</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Membership Benefits</li>
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
                                    <form action="{{ route('benefits.update', $member_benefits->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cover_image">Benefit's Cover Image:</label>
                                                    <input type="file" class="form-control" name="cover_image" onchange="loadLogo(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('cover_image') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="">Cover Image Preview:</label> <br>
                                                <img id="partner_logo_output" style="height: 150px; width:150px;" src="{{ Storage::disk('uploads')->url($member_benefits->cover_image) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Benefit Title (In English): </label>
                                                    <input type="text" class="form-control" name="title[en]" placeholder="Feature title" value="{{ $member_benefits->title['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Benefit Title (In Nepali): </label>
                                                    <input type="text" class="form-control" name="title[np]" placeholder="Feature title" value="{{ $member_benefits->title['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="descriptive_title">Descriptive Title (In English): </label>
                                                    <input type="text" class="form-control" name="descriptive_title[en]" placeholder="Feature descriptive title" value="{{ $member_benefits->descriptive_title['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('descriptive_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="descriptive_title">Descriptive Title (In Nepali): </label>
                                                    <input type="text" class="form-control" name="descriptive_title[np]" placeholder="Feature descriptive title" value="{{ $member_benefits->descriptive_title['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('descriptive_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="About Us">Fill the Details (In English):</label>
                                                    <textarea name="content[en]" class="form-control"cols="30" rows="5" id="summernote">{{ $member_benefits->content['en'] }}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('content') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="About Us">Fill the Details (In Nepali):</label>
                                                    <textarea name="content[np]" class="form-control"cols="30" rows="5" id="summernote1">{{ $member_benefits->content['np'] }}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('content') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success">Submit</button>
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


<!-- summernote js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script type="text/javascript">
    $('#summernote').summernote({
        height: 200,
        placeholder: "About Us Details.."
    });
    $('#summernote1').summernote({
        height: 200,
        placeholder: "About Us Details.."
    });
</script>
@endpush
