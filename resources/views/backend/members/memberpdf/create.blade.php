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

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
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

    .hide {
        display: none;

    }

    .show {
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
                    <h1 class="m-0">Upload Member PDF <a href="{{ route('memberpdf.index') }}" class="btn btn-primary">View PDFs</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Members PDF</li>
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
                                    <form action="{{ route('memberpdf.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pdf_file">PDF file:</label>
                                                    <input type="file" class="form-control" name="pdf_file" id="pdf_file" onchange="loadProfile(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('pdf_file') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>

                                            <div class="col-md-6 mt-4">
                                                <div class="form-group">
                                                    <label for="name">Name (In English):</label>
                                                    <input type="text" class="form-control" name="name[en]" placeholder="Name.." required>
                                                    <p class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <div class="form-group">
                                                    <label for="name">Name (In Nepali):</label>
                                                    <input type="text" class="form-control" name="name[np]" placeholder="Name.." required>
                                                    <p class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="member_category">Member Category:</label>
                                                    <select name="member_category" class="form-control member">
                                                        <option value="">--Select an option--</option>
                                                        @foreach ($memberCategories as $memberCategory)
                                                            <option value="{{ $memberCategory->id }}">{{ $memberCategory->category_name['en'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('member_category') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="member_subcategory">Member Subcategory:</label>
                                                    <select name="member_subcategory" class="form-control" id="member_subcategory">
                                                        <option value="">--Select a member first--</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('member_subcategory') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="commitee_category">Commitee Category:</label>
                                                    <select name="commitee_category" class="form-control committee">
                                                        <option value="">--Select an option--</option>
                                                        @foreach ($commiteeCategories as $commiteeCategory)
                                                            <option value="{{ $commiteeCategory->id }}">{{ $commiteeCategory->category_name['en'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('commitee_category') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="committee_subcategory">Committee Subcategory:</label>
                                                    <select name="committee_subcategory" class="form-control" id="committee_subcategory">
                                                        <option value="">--Select an committee first--</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('committee_subcategory') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Active">Active: </label>
                                                    <label class="switch pt-0">
                                                        <input type="checkbox" name="active" value="1">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2 text-center">
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

    $('.member').change(function() {
        var member_id = $(this).children("option:selected").val();
        function fillSelect(subCategory) {
            document.getElementById("member_subcategory").innerHTML =
            subCategory.reduce((tmp, x) => `${tmp}<option value='${x.id}'>${x.sub_category_name['en']}</option>`, '');
        }
        function fetchRecords(member_id) {
            var uri = "{{ route('getSubCategory', ':id') }}";
            uri = uri.replace(':id', member_id);
            $.ajax({
                url: uri,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var subCategory = response;
                    fillSelect(subCategory);
                }
            });
        }
        fetchRecords(member_id);
    })

    $('.committee').change(function() {
        var committee_id = $(this).children("option:selected").val();
        function fillSelect(subCategory) {
            document.getElementById("committee_subcategory").innerHTML =
            subCategory.reduce((tmp, x) => `${tmp}<option value='${x.id}'>${x.sub_category_name['en']}</option>`, '');
        }
        function fetchRecords(committee_id) {
            var uri = "{{ route('getSubCategory', ':id') }}";
            uri = uri.replace(':id', committee_id);
            $.ajax({
                url: uri,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var subCategory = response;
                    fillSelect(subCategory);
                }
            });
        }
        fetchRecords(committee_id);
    })
</script>

@endpush
