@extends('backend.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $news_count }}</h3>

                                    <p>Total News</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document"></i>
                                </div>
                                <a href="{{ route('news.index') }}" class="small-box-footer">View News <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $blogs_count }}</h3>

                                <p>Total Blogs</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-folder"></i>
                            </div>
                            <a href="{{ route('blogs.index') }}" class="small-box-footer">View Blogs <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $members_count }}</h3>

                                <p>Total Members</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="{{ route('member.index') }}" class="small-box-footer">View Members <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $users_count }}</h3>

                                <p>Total Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="{{ route('users.index') }}" class="small-box-footer">View Users <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>

                    <div class="card mt-2">
                        <div class="card-header border-transparent">
                          <div class="row">
                              <div class="col-md-9 text-center">
                                <h2>Latest 10 Subscribers</h2>
                              </div>
                              <div class="col-md-3 text-right">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                              </div>
                          </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          <div class="table-responsive">
                            <table class="table m-0 text-center">
                              <thead>
                              <tr>
                                <th>Subscribed On</th>
                                <th>Subscriber Email</th>
                              </tr>
                              </thead>
                              <tbody>
                                    @if (count($subscribers) == 0)
                                        <tr>
                                            <td colspan="2">
                                                No any subscribers.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($subscribers as $subscriber)
                                            <tr>
                                                <td>
                                                    {{ date('F j, Y', strtotime($subscriber->created_at)) }}
                                                </td>
                                                <td>
                                                    {{ $subscriber->email }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix text-center">
                            <a href="{{ route('subscribers.index') }}" class="btn btn-sm btn-info float-left">View all Subscribers</a>
                        </div>
                        <!-- /.card-footer -->
                      </div>

                      <div class="card mt-2">
                        <div class="card-header border-transparent">
                          <div class="row">
                              <div class="col-md-9 text-center">
                                <h2>Latest Customer Messages</h2>
                              </div>
                              <div class="col-md-3 text-right">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                              </div>
                          </div>

                        </div>
                      <!-- /.card-header -->
                      <div class="card-body p-0">
                        <div class="table-responsive">
                          <table class="table m-0 text-center">
                            <thead>
                            <tr>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Contact no.</th>
                              <th>Message</th>
                            </tr>
                            </thead>
                            <tbody>
                                  @if (count($messages) == 0)
                                      <tr>
                                          <td colspan="4">
                                              No any messages.
                                          </td>
                                      </tr>
                                  @else
                                      @foreach ($messages as $message)
                                          <tr>
                                              <td>
                                                {{ $message->name }}
                                              </td>
                                              <td>
                                                {{ $message->email }}
                                              </td>
                                              <td>
                                                {{ $message->contact_no }}
                                              </td>
                                              <td>
                                                {{ substr($message->email, 0, 100) }}..
                                              </td>
                                          </tr>
                                      @endforeach
                                  @endif
                            </tbody>
                          </table>
                        </div>
                        <!-- /.table-responsive -->
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer clearfix text-center">
                          <a href="{{ route('message.index') }}" class="btn btn-sm btn-info float-left">View all Messages</a>
                      </div>
                      <!-- /.card-footer -->
                    </div>

                      <div class="card mt-2">
                        <div class="card-header border-transparent">
                          <div class="row">
                              <div class="col-md-9 text-center">
                                <h2>Latest Partners</h2>
                              </div>
                              <div class="col-md-3 text-right">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                              </div>
                          </div>

                        </div>
                      <!-- /.card-header -->
                      <div class="card-body p-0">
                        <div class="table-responsive">
                          <table class="table m-0 text-center">
                            <thead>
                            <tr>
                              <th>Partner Logo</th>
                              <th>Partner Name</th>
                            </tr>
                            </thead>
                            <tbody>
                                  @if (count($partners) == 0)
                                      <tr>
                                          <td colspan="2">
                                              No any partners.
                                          </td>
                                      </tr>
                                  @else
                                      @foreach ($partners as $partner)
                                          <tr>
                                              <td>
                                                  <img src="{{ Storage::disk('uploads')->url($partner->partner_logo) }}" alt="{{ $partner->partner_name }}">
                                              </td>
                                              <td>
                                                  {{ $partner->partner_name }}
                                              </td>
                                          </tr>
                                      @endforeach
                                  @endif
                            </tbody>
                          </table>
                        </div>
                        <!-- /.table-responsive -->
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer clearfix text-center">
                          <a href="{{ route('partner.index') }}" class="btn btn-sm btn-info float-left">View all Partners</a>
                      </div>
                      <!-- /.card-footer -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection
