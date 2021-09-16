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
                    <h1 class="m-0">Update Member Information <a href="{{ route('member.index') }}" class="btn btn-primary">View Members</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Members</li>
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
                                    <form action="{{ route('member.update', $existing_member->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="profile_photo">Profile Photo:</label>
                                                    <input type="file" class="form-control" name="profile_photo" id="profile_photo" onchange="loadProfile(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('profile_photo') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="">Recent Photo:</label> <br>
                                                <img id="profile_photo_output" style="height: 100px;" src="{{ Storage::disk('uploads')->url($existing_member->profile_photo) }}">
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <div class="form-group">
                                                    <label for="name">Member Name (In English):</label>
                                                    <input type="text" value="{{ $existing_member->name['en'] }}" class="form-control" name="name[en]" placeholder="Member Name..">
                                                    <p class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <div class="form-group">
                                                    <label for="name">Member Name (In Nepali):</label>
                                                    <input type="text" value="{{ $existing_member->name['np'] }}" class="form-control" name="name[np]" placeholder="Member Name..">
                                                    <p class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <div class="form-group">
                                                    <label for="position">Designation (In English):</label>
                                                    <input type="text" value="{{ $existing_member->position['en'] }}" class="form-control" name="position[en]" placeholder="Member designation..">
                                                    <p class="text-danger">
                                                        {{ $errors->first('position') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <div class="form-group">
                                                    <label for="position">Designation (In Nepail):</label>
                                                    <input type="text" value="{{ $existing_member->position['np'] }}" class="form-control" name="position[np]" placeholder="Member designation..">
                                                    <p class="text-danger">
                                                        {{ $errors->first('position') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_no">Member Contact no. (In English):</label>
                                                    <input type="text" value="{{ $existing_member->contact_no['en'] }}" class="form-control" name="contact_no[en]" placeholder="Member contact_no..">
                                                    <p class="text-danger">
                                                        {{ $errors->first('contact_no') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_no">Member Contact no. (In Nepali):</label>
                                                    <input type="text" value="{{ $existing_member->contact_no['np'] }}" class="form-control" name="contact_no[np]" placeholder="Member contact_no..">
                                                    <p class="text-danger">
                                                        {{ $errors->first('contact_no') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address (In English):</label>
                                                    <input type="text" class="form-control" name="address[en]" placeholder="Member address.." value="{{ $existing_member->address['en'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('address') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address (In Nepali):</label>
                                                    <input type="text" class="form-control" name="address[np]" placeholder="Member address.." value="{{ $existing_member->address['np'] }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('address') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Member Email (Optional):</label>
                                                    <input type="text" value="{{ $existing_member->email }}" class="form-control" name="email" placeholder="Member email..">
                                                    <p class="text-danger">
                                                        {{ $errors->first('email') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="member_category">Member Caategory:</label>
                                                    <select name="member_category" class="form-control">
                                                        <option value="">--Select an option--</option>
                                                        @foreach ($memberCategories as $memberCategory)
                                                            <option value="{{ $memberCategory->id }}"{{ $memberCategory->id == $existing_member->member_id ? 'selected' : '' }}>{{ $memberCategory->category_name['en'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('member_category') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="commitee_category">Commitee Caategory:</label>
                                                    <select name="commitee_category" class="form-control">
                                                        <option value="">--Select an option--</option>
                                                        @foreach ($commiteeCategories as $commiteeCategory)
                                                            <option value="{{ $commiteeCategory->id }}"{{ $commiteeCategory->id == $existing_member->commitee_id ? 'selected' : '' }}>{{ $commiteeCategory->category_name['en'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('commitee_category') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="details">Details (In English):</label>
                                                    <textarea name="details[en]" class="form-control" cols="30" rows="5" placeholder="Details.....">{{ $existing_member->details['en'] }}</textarea>
                                                    <p class="text-center">
                                                        {{ $errors->first('details') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="details">Details (In Nepali):</label>
                                                    <textarea name="details[np]" class="form-control" cols="30" rows="5" placeholder="Details.....">{{ $existing_member->details['np'] }}</textarea>
                                                    <p class="text-center">
                                                        {{ $errors->first('details') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center mt-3">
                                                <hr>
                                                <h3>Social Media</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="facebook">Facebook:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="facebook" placeholder="Facebook Link" value="{{ $existing_member->facebook }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('facebook') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>

                                            <div class="col-md-2">
                                                <label for="whatsapp">Whatsapp:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="whatsapp" placeholder="Whatsapp Link" value="{{ $existing_member->whatsapp }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('whatsapp') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>

                                            <div class="col-md-2">
                                                <label for="youtube">Youtube:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="youtube" placeholder="Youtube Link" value="{{ $existing_member->youtube }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('youtube') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>

                                            <div class="col-md-2">
                                                <label for="twitter">Twitter:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="twitter" placeholder="Twitter Link" value="{{ $existing_member->twitter }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('twitter') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>

                                            <div class="col-md-2">
                                                <label for="linkedin">Linked In:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="linkedin" placeholder="Linked In Link" value="{{ $existing_member->linkedin }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('linkedin') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>

                                            <div class="col-md-12 mt-2 text-center">
                                                <button type="submit" class="btn btn-success">Update</button>
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
    var loadProfile = function(event) {
        var output = document.getElementById('profile_photo_output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>

@endpush
