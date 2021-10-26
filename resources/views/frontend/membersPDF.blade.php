@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
    <!-- Banner -->
    <section class="banner pt pb" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
        <div class="container">
            <h1>
                @if ($member_category)
                    {{ getLangValue($member_category->category_name) }}
                @else
                    {{ getLangValue($member_subcategory->sub_category_name) }}
                @endif</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('index.top.home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if ($member_category)
                    {{ getLangValue($member_category->category_name) }}
                @else
                    {{ getLangValue($member_subcategory->sub_category_name) }}
                @endif</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Team Page Us -->
    <section class="team-next mt mb">
        <div class="container">
            <div class="table-responsive">
                <table width="100%" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="50">{{ __('index.index.serial_number') }}</th>
                            <th width="400">{{ __('index.index.table_name') }}</th>
                            <th width="206">{{ __('index.index.download') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($memberPDFs) == 0)
                            <tr>
                                <td colspan="3"><h3>{{ __('index.emptyInfo.noItem') }}</h3></td>
                            </tr>
                        @else
                        @php
                            $i = 1;
                        @endphp
                            @foreach ($memberPDFs as $member)
                                <tr>
                                    <td width="50">{{ $i }}</td>
                                    <td width="400">{{ getLangValue($member->name) }}</td>
                                    <td width="206"><a href="{{ Storage::disk('uploads')->url($member->pdf_file) }}" target="_blank" title="View" class="btn btn-success"><i class="las la-download"></i></a></td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Team Page End -->
@endsection
