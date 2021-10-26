@extends('backend.layouts.app')
@push('styles')
    <style>
        ol {
            list-style-type: none;
        }

        .menu-handle {
            display: block;
            margin-bottom: 5px;
            padding: 6px 4px 6px 12px;
            color: #333;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            cursor: move;
        }

        .menu-handle:hover {
            background: #fff;
        }

        .placeholder {
            margin-bottom: 10px;
            background: #D7F8FD
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
                    <h1 class="m-0">Members <a href="{{ route('member.create') }}" class="btn btn-primary">Add New Member</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Member Category</li>
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
                                <div class="card-body card-format">
                                    @if ($members->count() > 0)
                                        <ol class="sortable">
                                            @foreach ($members as $member)
                                                    <li id="menuItem_{{ $member->id }}">
                                                        <div class="menu-handle d-flex justify-content-between">
                                                            <span>
                                                                {{ $member->name['en'] }} ({{ $member->position['en'] }})
                                                            </span>

                                                            <div class="menu-options btn-group">
                                                                <a href="{{ route('member.edit', $member->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $member->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                <!-- Modal -->
                                                                    <div class="modal fade text-left" id="deletionservice{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                                </div>
                                                                                <div class="modal-body text-center">
                                                                                    <form action="{{ route('member.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                                                                                        @csrf
                                                                                        @method("POST")
                                                                                        <label for="reason">Are you sure you want to delete??</label><br>
                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                        <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    ";
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        {{-- {{ get_nested_menu($item->id) }} --}}
                                                        {{-- @include('admin.menu.nested',['data'=>$item->child_menu]) --}}
                                                    </li>
                                            @endforeach
                                            <div class="form-group mt-4">
                                                <button type="button" class="btn btn-success btn-sm btn-flat" id="serialize"><i
                                                        class="fa fa-save"></i>
                                                    Update Order
                                                </button>
                                            </div>
                                        </ol>
                                    @else
                                        <p class="text-center">Member Not Found.</p>
                                    @endif
                                </div>
                            </div>



                            {{-- <div class="card">
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Profile Image</th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Email</th>
                                                <th>Contact no.</th>
                                                <th>Member Of</th>
                                                <th>Under Committee</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (count($members) == 0)
                                                <tr>
                                                    <td colspan="8">
                                                        <p class="text-center">
                                                            No any records.
                                                        </p>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($members as $member)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ Storage::disk('uploads')->url($member->profile_photo) }}" alt="{{ $member->name['en'] }}" style="height: 100px; width: 100px;">
                                                        </td>
                                                        <td>
                                                            {{ $member->name['en'] }} <br>
                                                            ({{ $member->name['np'] }})
                                                        </td>
                                                        <td>
                                                            {{ $member->position['en'] }} <br>
                                                            ({{ $member->position['np'] }})
                                                        </td>
                                                        <td>
                                                            @if ($member->email == null)
                                                                Not Provided
                                                            @else
                                                            {{ $member->email }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $member->contact_no['en'] }} <br>
                                                            ({{ $member->contact_no['np'] }})
                                                        </td>
                                                        <td>
                                                            @if ($member->member_id == null)
                                                                -
                                                            @else
                                                                {{ $member->memberCategory->category_name['en'] }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($member->commitee_id == null)
                                                                -
                                                            @else
                                                                {{ $member->commiteeCategory->category_name['en'] }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('member.edit', $member->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletionservice{{ $member->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                            <!-- Modal -->
                                                                <div class="modal fade text-left" id="deletionservice{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <form action="{{ route('member.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                                                                                    @csrf
                                                                                    @method("POST")
                                                                                    <label for="reason">Are you sure you want to delete??</label><br>
                                                                                    <input type="hidden" name="_method" value="DELETE" />
                                                                                    <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                ";
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="text-sm">
                                                    Showing <strong>{{ $members->firstItem() }}</strong> to
                                                    <strong>{{ $members->lastItem() }} </strong> of <strong>
                                                        {{ $members->total() }}</strong>
                                                    entries
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="pagination-sm m-0 float-right">{{ $members->links() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
    <script src="{{ asset('backend/plugins/sortablejs/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/sortablejs/jquery.mjs.nestedSortable.js') }}"></script>
    <script src="{{ asset('backend/plugins/toastrjs/toastr.min.js') }}"></script>
    <script>

        $('ol.sortable').nestedSortable({
            forcePlaceholderSize: true,
            placeholder: 'placeholder',
            handle: 'div.menu-handle',
            helper: 'clone',
            items: 'li',
            opacity: .6,
            maxLevels: 1,
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
        });

        $("#serialize").click(function(e) {
            e.preventDefault();
            $(this).prop("disabled", true);
            $(this).html(
                    `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Updating...`
                );
            var serialized = $('ol.sortable').nestedSortable('serialize');
            // console.log(serialized);
            $.ajax({
                url: "{{ route('updateMemberOrder') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    sort: serialized
                },
                success: function(res) {
                    toastr.options.closeButton = true
                    toastr.success('Member Order Successfuly', "Success !");
                    $('#serialize').prop("disabled", false);
                    $('#serialize').html(`<i class="fa fa-save"></i> Update Member`);
                }
            });
        });

        function show_alert() {
            if (!confirm("Do you really want to do this?")) {
                return false;
            }
            this.form.submit();
        }
    </script>
@endpush
