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
                    <h1 class="m-0">MembersPDF Document (PDF) <a href="{{ route('memberpdf.create') }}" class="btn btn-primary">Upload a PDF</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">MembersPDF Document</li>
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
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>File Name</th>
                                                <th>Member Category</th>
                                                <th>Member Subcategory</th>
                                                <th>Committee Category</th>
                                                <th>Committee Subcategory</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (count($membersPDF) == 0)
                                                <tr>
                                                    <td colspan="7">
                                                        <p class="text-center">
                                                            No any records.
                                                        </p>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($membersPDF as $memberPDF)
                                                    <tr>
                                                        <td>
                                                            {{ $memberPDF->name['en'] }}
                                                        </td>
                                                        <td>
                                                            @if ($memberPDF->member_id == null)
                                                                -
                                                            @else
                                                                {{ $memberPDF->member->category_name['en'] }}
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if ($memberPDF->member_subcategory_id == null)
                                                                -
                                                            @else
                                                                {{ $memberPDF->memberSubCategory->sub_category_name['en'] }}
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if ($memberPDF->committee_id == null)
                                                                -
                                                            @else
                                                                {{ $memberPDF->committee->category_name['en'] }}
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if ($memberPDF->committee_subcategory_id == null)
                                                                -
                                                            @else
                                                                {{ $memberPDF->committeeSubCategory->sub_category_name['en'] }}
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if ($memberPDF->is_active == 0)
                                                                Inactive
                                                            @else
                                                                Active
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ Storage::disk('uploads')->url($memberPDF->pdf_file) }}" target="_blank" class="btn btn-success btn-sm" title="View"><i class="fas fa-download"></i></a>
                                                            <a href="{{ route('memberpdf.edit', $memberPDF->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletionservice{{ $memberPDF->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                            <!-- Modal -->
                                                                <div class="modal fade text-left" id="deletionservice{{ $memberPDF->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <form action="{{ route('memberpdf.destroy', $memberPDF->id) }}" method="POST" style="display:inline-block;">
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
                                                    Showing <strong>{{ $membersPDF->firstItem() }}</strong> to
                                                    <strong>{{ $membersPDF->lastItem() }} </strong> of <strong>
                                                        {{ $membersPDF->total() }}</strong>
                                                    entries
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="pagination-sm m-0 float-right">{{ $membersPDF->links() }}</span>
                                            </div>
                                        </div>
                                    </div>
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
