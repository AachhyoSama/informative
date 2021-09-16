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
                    <h1 class="m-0">About Us</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">About Us</li>
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
                                    <form action="{{ route('setting.update', $setting->id) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <h3>Working Days</h3>
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="from_day">From:</label>
                                                        <select name="from_day" class="form-control">
                                                            <option value="">--Select a day--</option>
                                                            <option value="Sunday"{{ $setting->from_day == "Sunday" ? 'selected' :'' }}>Sunday</option>
                                                            <option value="Monday"{{ $setting->from_day == "Monday" ? 'selected' :'' }}>Monday</option>
                                                            <option value="Tuesday"{{ $setting->from_day == "Tuesday" ? 'selected' :'' }}>Tuesday</option>
                                                            <option value="Wednesday"{{ $setting->from_day == "Wednesday" ? 'selected' :'' }}>Wednesday</option>
                                                            <option value="Thursday"{{ $setting->from_day == "Thursday" ? 'selected' :'' }}>Thursday</option>
                                                            <option value="Friday"{{ $setting->from_day == "Friday" ? 'selected' :'' }}>Friday</option>
                                                            <option value="Saturday"{{ $setting->from_day == "Saturday" ? 'selected' :'' }}>Saturday</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="to_day">To:</label>
                                                        <select name="to_day" class="form-control">
                                                            <option value="">--Select a day--</option>
                                                            <option value="Sunday"{{ $setting->to_day == "Sunday" ? 'selected' :'' }}>Sunday</option>
                                                            <option value="Monday"{{ $setting->to_day == "Monday" ? 'selected' :'' }}>Monday</option>
                                                            <option value="Tuesday"{{ $setting->to_day == "Tuesday" ? 'selected' :'' }}>Tuesday</option>
                                                            <option value="Wednesday"{{ $setting->to_day == "Wednesday" ? 'selected' :'' }}>Wednesday</option>
                                                            <option value="Thursday"{{ $setting->to_day == "Thursday" ? 'selected' :'' }}>Thursday</option>
                                                            <option value="Friday"{{ $setting->to_day == "Friday" ? 'selected' :'' }}>Friday</option>
                                                            <option value="Saturday"{{ $setting->to_day == "Saturday" ? 'selected' :'' }}>Saturday</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                    <h3>Working Hours</h3>
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="from_time">Opening Time:</label>
                                                        <input type="time" class="form-control" name="opening_time" value="{{ $setting->opening_time }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="to_time">Closing Time:</label>
                                                        <input type="time" class="form-control" name="closing_time" value="{{ $setting->closing_time }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                    <h3>Map URL</h3>
                                                    <hr>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="map_url">Google Map Url:</label>
                                                        <input type="text" class="form-control" name="map_url" value="{{ $setting->map_url }}" placeholder="Insert your location google map url">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                    <h3>About Us</h3>
                                                    <hr>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="About Us">Fill the Details (In Engslish):</label>
                                                <textarea name="aboutUs[en]" id="summernote" class="form-control">{!! $setting->aboutus['en'] !!}</textarea>
                                                <p class="text-danger">
                                                    {{ $errors->first('aboutUs') }}
                                                </p>
                                            </div>

                                            <div class="form-group mt-4">
                                                <label for="About Us">Fill the Details (In Nepali):</label>
                                                <textarea name="aboutUs[np]" id="summernote1" class="form-control">{!! $setting->aboutus['np'] !!}</textarea>
                                                <p class="text-danger">
                                                    {{ $errors->first('aboutUs') }}
                                                </p>
                                            </div>

                                            <button type="submit" class="btn btn-success" name="about_us">Submit</button>
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
<!-- summernote js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script type="text/javascript">
    $('#summernote').summernote({
        height: 300,
        placeholder: "About Us Details.."
    });

    $('#summernote1').summernote({
        height: 300,
        placeholder: "About Us Details.."
    });
</script>
@endpush
