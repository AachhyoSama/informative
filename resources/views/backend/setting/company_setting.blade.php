@extends('backend.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Company Setting</h1>
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
                                    <form action="{{ route('setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_name">Company Name (In English):</label>
                                                    <input type="text" class="form-control" name="company_name[en]" value="{{ $setting->company_name['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('company_name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_name">Company Name (In Nepali):</label>
                                                    <input type="text" class="form-control" name="company_name[np]" value="{{ $setting->company_name['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('company_name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_no">Company contact no. (In English):</label>
                                                    <input type="text" class="form-control" name="contact_no[en]" value="{{ $setting->contact_no['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('contact_no') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_no">Company contact no. (In Nepali):</label>
                                                    <input type="text" class="form-control" name="contact_no[np]" value="{{ $setting->contact_no['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('contact_no') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Company Email:</label>
                                                    <input type="text" class="form-control" name="email" value="{{ $setting->email }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('email') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pan_vat">PAN / VAT:</label>
                                                    <input type="text" class="form-control" value="{{ $setting->pan_vat }}" name="pan_vat">
                                                    <p class="text-danger">
                                                        {{ $errors->first('pan_Vat') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="province">Province no:.</label>
                                                    <select name="province" class="form-control province">
                                                        <option value="">--Select a province--</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}"{{ $province->id == $setting->province_no ? 'selected' : '' }}>{{ $province->eng_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('province') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="district">Districts:</label>
                                                    <select name="district" class="form-control" id="district">
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district->id }}"{{ $district->id == $setting->district_no ? 'selected' : '' }}>{{ $district->dist_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('district') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="local_address">Local Address (In English):</label>
                                                    <input type="text" name="local_address[en]" class="form-control" value="{{ $setting->local_address['en'] }}" placeholder="Enter Local address">
                                                    <p class="text-danger">
                                                        {{ $errors->first('local_address') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="local_address">Local Address (In Nepali):</label>
                                                    <input type="text" name="local_address[np]" class="form-control" value="{{ $setting->local_address['np'] }}" placeholder="Enter Local address">
                                                    <p class="text-danger">
                                                        {{ $errors->first('local_address') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_logo">Company Logo:</label>
                                                    <input type="file" class="form-control" name="company_logo" id="company_logo" onchange="loadLogo(event)">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Recent Logo:</label> <br>
                                                <img id="company_logo_output" style="height: 100px;" src="{{ Storage::disk('uploads')->url($setting->company_logo) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="footer_logo">Footer Logo:</label>
                                                    <input type="file" class="form-control" name="footer_logo" id="footer_logo" onchange="loadFooterLogo(event)">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Recent Footer Logo:</label> <br>
                                                <img id="footer_logo_output" style="height: 100px;" src="{{ Storage::disk('uploads')->url($setting->footer_logo) }}">
                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label for="company_favicon">Company Favicon:</label>
                                                    <input type="file" class="form-control" name="company_favicon" id="company_favicon" onchange="loadFavicon(event)">
                                                </div>
                                            </div>

                                            <div class="col-md-3 mt-2">
                                                <label for="">Recent Favicon:</label> <br>
                                                <img id="company_favicon_output" style="height: 100px;" src="{{ Storage::disk('uploads')->url($setting->company_favicon) }}">
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Company's Accomplishment</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projects_completed">Projects Completed (in number) (In English): </label>
                                                    <input type="number" class="form-control" name="projects_completed[en]" placeholder="Projects completed" value="{{ $setting->projects_completed['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('projects_completed') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projects_completed">Projects Completed (in number) (In Nepali): </label>
                                                    <input type="text" class="form-control" name="projects_completed[np]" placeholder="Projects completed" value="{{ $setting->projects_completed['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('projects_completed') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="clients_satisfied">Satisfied Clients (in number) (In English): </label>
                                                    <input type="number" class="form-control" name="clients_satisfied[en]" placeholder="Satisfied Clients in number." value="{{ $setting->clients_satisfied['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('clients_satisfied') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="clients_satisfied">Satisfied Clients (in number) (In Nepali): </label>
                                                    <input type="text" class="form-control" name="clients_satisfied[np]" placeholder="Satisfied Clients in number." value="{{ $setting->clients_satisfied['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('clients_satisfied') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="award_winner">Awards won (in number) (In English): </label>
                                                    <input type="number" class="form-control" name="award_winner[en]" placeholder="Award winner" value="{{ $setting->award_winner['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('award_winner') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="award_winner">Awards won (in number) (In Nepali): </label>
                                                    <input type="text" class="form-control" name="award_winner[np]" placeholder="Award winner" value="{{ $setting->award_winner['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('award_winner') }}
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
                                                    <input type="text" class="form-control" name="meta_title" placeholder="Meta Title for SEO" value="{{ $setting->meta_title }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_keywords">Meta Keywords(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_keywords" placeholder="Meta Keywords for SEO" value="{{ $setting->meta_keywords }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_keywords') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta-description">Meta Description (optional):</label>
                                                    <textarea name="meta_description" cols="30" rows="5" class="form-control" placeholder="Meta description..">{{ $setting->meta_description }}</textarea>
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
                                                <img id="current_og" style="height: 100px;" src="{{ Storage::disk('uploads')->url($setting->og_image ? $setting->og_image : 'noimage.jpg') }}">
                                            </div>

                                            <div class="col-md-12 text-center mt-4">
                                                <button type="submit" class="btn btn-success" name="companySetting">Submit</button>
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
        $(function() {
            $('.province').change(function() {
                var province_no = $(this).children("option:selected").val();
                function fillSelect(districts) {
                    document.getElementById("district").innerHTML =
                    districts.reduce((tmp, x) => `${tmp}<option value='${x.id}'>${x.dist_name}</option>`, '');
                }
                function fetchRecords(province_no) {

                    var uri = "{{ route('getdistricts', ':no') }}";
                    uri = uri.replace(':no', province_no);
                    $.ajax({
                        url: uri,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            var districts = response;
                            console.log(districts);
                            fillSelect(districts);
                        }
                    });
                }
                fetchRecords(province_no);
            })
        });
    </script>

    <script>
        var loadLogo = function(event) {
            var output = document.getElementById('company_logo_output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>

    <script>
        var loadFooterLogo = function(event) {
            var output = document.getElementById('footer_logo_output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>

    <script>
        var loadFavicon = function(event) {
            var output = document.getElementById('company_favicon_output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
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
