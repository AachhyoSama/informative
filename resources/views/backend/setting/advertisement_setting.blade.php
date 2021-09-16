@extends('backend.layouts.app')

@push('styles')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

        .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

        .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

        .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

        input:checked + .slider {
        background-color: #2196F3;
    }

        input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

        input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

        /* Rounded sliders */
        .slider.round {
        border-radius: 34px;
    }

        .slider.round:before {
        border-radius: 50%;
    }
    .hide{
        display: none;

    }
    .show{
        display: block;
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
                    <h1 class="m-0">Advertisement Setting</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Advertisement</li>
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
                                    <form action="{{ route('advertisements.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Opening Advertisement</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="opening_advertisement">Select Image for Ad:</label>
                                                    <input type="file" class="form-control" name="opening_advertisement" id="opening_advertisement" onchange="loadAdvertisement(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('opening_advertisement') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Advertisement URL:</label>
                                                    <input type="text" class="form-control" name="opening_advertisement_url" placeholder="Advertisement URL.." value="{{ $advertisement->opening_advertisement_url }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('opening_advertisement_url') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="is_show">Show In Opening: </label>
                                                    <label class="switch pt-0">
                                                        <input type="checkbox" name="is_show" value="1" {{ $advertisement->is_show == 1 ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="">Current Image:</label> <br>
                                                <img id="opening_advertisement_output" style="height: 450px; width:850px;" src="{{ Storage::disk('uploads')->url($advertisement->opening_advertisement) }}">
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Header Advertisement</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="header_advertisement">Select Image for Ad:</label>
                                                    <input type="file" class="form-control" name="header_advertisement" id="header_advertisement" onchange="loadLogo(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('header_advertisement') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-7">
                                                <label for="">Current Image:</label> <br>
                                                <img id="header_advertisement_output" style="height: 80px; width:650px;" src="{{ Storage::disk('uploads')->url($advertisement->header_advertisement) }}">
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="">Advertisement URL:</label>
                                                    <input type="text" class="form-control" name="header_advertisement_url" placeholder="Advertisement URL.." value="{{ $advertisement->header_advertisement_url }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('header_advertisement_url') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Middle Advertisement (First)</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="middle_ad_one">Select Image for Ad:</label>
                                                    <input type="file" class="form-control" name="middle_ad_one" id="middle_ad_one" onchange="loadFirst(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('middle_ad_one') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-7">
                                                <label for="">Current Image:</label> <br>
                                                <img id="middle_ad_one_output" style="height: 80px; width:650px;" src="{{ Storage::disk('uploads')->url($advertisement->middle_ad_one) }}">
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="">Advertisement URL:</label>
                                                    <input type="text" class="form-control" name="middle_ad_one_url" placeholder="Advertisement URL.." value="{{ $advertisement->middle_ad_one_url }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('middle_ad_one_url') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Middle Advertisement (Second)</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="middle_ad_two">Select Image for Ad:</label>
                                                    <input type="file" class="form-control" name="middle_ad_two" id="middle_ad_two" onchange="loadSecond(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('middle_ad_two') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-7">
                                                <label for="">Current Image:</label> <br>
                                                <img id="middle_ad_two_output" style="height: 80px; width:650px;" src="{{ Storage::disk('uploads')->url($advertisement->middle_ad_two) }}">
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="">Advertisement URL:</label>
                                                    <input type="text" class="form-control" name="middle_ad_two_url" placeholder="Advertisement URL.." value="{{ $advertisement->middle_ad_two_url }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('middle_ad_two_url') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Middle Advertisement (Third)</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="middle_ad_three">Select Image for Ad:</label>
                                                    <input type="file" class="form-control" name="middle_ad_three" id="middle_ad_three" onchange="loadThird(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('middle_ad_three') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-7">
                                                <label for="">Current Image:</label> <br>
                                                <img id="middle_ad_three_output" style="height: 80px; width:650px;" src="{{ Storage::disk('uploads')->url($advertisement->middle_ad_three) }}">
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="">Advertisement URL:</label>
                                                    <input type="text" class="form-control" name="middle_ad_three_url" placeholder="Advertisement URL.." value="{{ $advertisement->middle_ad_three_url }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('middle_ad_three_url') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Middle Advertisement (Fourth)</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="middle_ad_four">Select Image for Ad:</label>
                                                    <input type="file" class="form-control" name="middle_ad_four" id="middle_ad_four" onchange="loadFourth(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('middle_ad_four') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-7">
                                                <label for="">Current Image:</label> <br>
                                                <img id="middle_ad_four_output" style="height: 80px; width:650px;" src="{{ Storage::disk('uploads')->url($advertisement->middle_ad_four) }}">
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="">Advertisement URL:</label>
                                                    <input type="text" class="form-control" name="middle_ad_four_url" placeholder="Advertisement URL.." value="{{ $advertisement->middle_ad_four_url }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('middle_ad_four_url') }}
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Middle Advertisement (Third)</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="middle_ad_three">Select Image for Ad:</label>
                                                    <input type="file" class="form-control" name="middle_ad_three" id="middle_ad_three" onchange="loadThird(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('middle_ad_three') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-7">
                                                <label for="">Current Image:</label> <br>
                                                <img id="middle_ad_three_output" style="height: 80px; width:650px;" src="{{ Storage::disk('uploads')->url($advertisement->middle_ad_three) }}">
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="">Advertisement URL:</label>
                                                    <input type="text" class="form-control" name="middle_ad_three_url" placeholder="Advertisement URL.." value="{{ $advertisement->middle_ad_three_url }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('middle_ad_three_url') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Main Advertisement</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="main_advertisement">Select Image for Ad:</label>
                                                    <input type="file" class="form-control" name="main_advertisement" id="main_advertisement" onchange="loadMain(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('main_advertisement') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Advertisement URL:</label>
                                                    <input type="text" class="form-control" name="main_advertisement_url" placeholder="Advertisement URL.." value="{{ $advertisement->main_advertisement_url }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('main_advertisement_url') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="">Current Image:</label> <br>
                                                <img id="main_advertisement_output" style="height: 160px; width:1100px;" src="{{ Storage::disk('uploads')->url($advertisement->main_advertisement) }}">
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
<script>
    var loadAdvertisement = function(event) {
        var output = document.getElementById('opening_advertisement_output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>

<script>
    var loadLogo = function(event) {
        var output = document.getElementById('header_advertisement_output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>

<script>
    var loadFirst = function(event) {
        var output = document.getElementById('middle_ad_one_output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>

<script>
    var loadSecond = function(event) {
        var output = document.getElementById('middle_ad_two_output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>

<script>
    var loadThird = function(event) {
        var output = document.getElementById('middle_ad_three_output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>

<script>
    var loadFourth = function(event) {
        var output = document.getElementById('middle_ad_four_output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>

<script>
    var loadMain = function(event) {
        var output = document.getElementById('main_advertisement_output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>
@endpush
