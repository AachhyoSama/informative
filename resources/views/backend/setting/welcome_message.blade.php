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
                    <h1 class="m-0">Company Vision and Welcome Messages</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Setting</li>
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
                                    <form action="{{ route('updateMissionVision',$mission->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="missionVision">Mission and Vision (In English):</label>
                                                    <textarea name="mission_vision[en]" cols="20" rows="5" placeholder="Short Description on Company's Vision.." class="form-control" id="summernote">{{ $mission->mission_vision['en'] }}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('missionVision') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="missionVision">Mission and Vision (In Nepali):</label>
                                                    <textarea name="mission_vision[np]" cols="20" rows="5" placeholder="Short Description on Company's Vision.." class="form-control" id="summernote1">{{ $mission->mission_vision['np'] }}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('missionVision') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-4">
                                                <div class="form-group">
                                                    <label for="founder_message">Founder's Message (In English):</label>
                                                    <textarea name="founder_message[en]" cols="20" rows="5" placeholder="Words from Founder.." class="form-control" id="summernote2">{{ $mission->founder_message['en'] }}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('founder_message') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="founder_message">Founder's Message (In Nepali):</label>
                                                    <textarea name="founder_message[np]" cols="20" rows="5" placeholder="Words from Founder.." class="form-control" id="summernote3">{{ $mission->founder_message['np'] }}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('founder_message') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <h3>Welcome Message</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="welcome_title">Welcome Message Title (In English):</label>
                                                    <input type="text" class="form-control" placeholder="Welcome Title" name="welcome_title[en]" value="{{ $mission->welcome_title['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('welcome_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="welcome_title">Welcome Message Title (In Nepali):</label>
                                                    <input type="text" class="form-control" placeholder="Welcome Title" name="welcome_title[np]" value="{{ $mission->welcome_title['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('welcome_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="welcome_sub_title">Welcome Sub Title (In English):</label>
                                                    <input type="text" class="form-control" placeholder="Sub Title" name="welcome_sub_title[en]" value="{{ $mission->welcome_sub_title['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('welcome_sub_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="welcome_sub_title">Welcome Sub Title (In Nepali):</label>
                                                    <input type="text" class="form-control" placeholder="Sub Title" name="welcome_sub_title[np]" value="{{ $mission->welcome_sub_title['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('welcome_sub_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="welcome_message">Welcome Message (In English):</label>
                                                    <textarea name="welcome_message[en]" cols="30" rows="5" class="form-control" placeholder="Welcome message for visitors.." id="summernote4">{{ $mission->welcome_message['en'] }}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('welcome_message') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="welcome_message">Welcome Message (In Nepali):</label>
                                                    <textarea name="welcome_message[np]" cols="30" rows="5" class="form-control" placeholder="Welcome message for visitors.." id="summernote5">{{ $mission->welcome_message['np'] }}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('welcome_message') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center mt-4">
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

    $('#summernote2').summernote({
        height: 200,
        placeholder: "About Us Details.."
    });

    $('#summernote3').summernote({
        height: 200,
        placeholder: "About Us Details.."
    });

    $('#summernote4').summernote({
        height: 200,
        placeholder: "About Us Details.."
    });

    $('#summernote5').summernote({
        height: 200,
        placeholder: "About Us Details.."
    });
</script>
@endpush
