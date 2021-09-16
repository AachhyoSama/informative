@extends('backend.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Social Media Setting</h1>
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
                                    <form action="{{ route('setting.update', $setting->id) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">

                                            <div class="col-md-3">
                                                <label for="facebook">Facebook:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="facebook" value="{{ $setting->facebook }}" placeholder="Facebook link url">
                                                    <p class="text-danger">
                                                        {{ $errors->first('facebook') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>

                                            <div class="col-md-3">
                                                <label for="youtube">Youtube:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="youtube" value="{{ $setting->youtube }}" placeholder="Youtube link url">
                                                    <p class="text-danger">
                                                        {{ $errors->first('youtube') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>

                                            <div class="col-md-3">
                                                <label for="instagram">Instagram:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="instagram" value="{{ $setting->instagram }}" placeholder="Instagram link url">
                                                    <p class="text-danger">
                                                        {{ $errors->first('instagram') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>

                                            <div class="col-md-3">
                                                <label for="whatsapp">Whatsapp:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="whatsapp" value="{{ $setting->whatsapp }}" placeholder="Whatsapp link url">
                                                    <p class="text-danger">
                                                        {{ $errors->first('whatsapp') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>

                                            <div class="col-md-3">
                                                <label for="twitter">Twitter:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="twitter" value="{{ $setting->twitter }}" placeholder="Twitter link url">
                                                    <p class="text-danger">
                                                        {{ $errors->first('twitter') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>

                                            <div class="col-md-12 text-center mt-4">
                                                <button type="submit" class="btn btn-success" name="socialMedia">Submit</button>
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

@endpush
