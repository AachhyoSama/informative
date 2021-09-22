@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
    <!-- Banner -->
    {{-- <section class="banner pt pb" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
        <div class="container">
            <h1>{{ $news->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $news->title }}</li>
                </ol>
            </nav>
        </div>
    </section> --}}
    <!-- Banner End -->

    <!-- Details -->
    <section class="details-page mt mb">
        <div class="container">
            <div class="details-wrap">
                <div class="details-left text-center">
                    @php
                        $nepali_date = datenep($news->written_on);
                        $nepali_array = explode('-', $nepali_date);
                        $nepali_month = nepaliMonth($nepali_array[1]);
                        $nepali_bar = nepaliNumber($nepali_array[2]);
                    @endphp
                    <div class="date">
                        @if (session('locale') == "np")
                            <b>{{ $nepali_bar }}</b>
                            {{ $nepali_month }}
                        @else
                            <b>{{ date('d', strtotime($news->written_on)) }}</b>
                            {{ date('M', strtotime($news->written_on)) }}
                        @endif
                    </div>
                    <br>
                </div>
                <div class="details-right">
                    <h2>{{ getLangValue($news->title) }}</h2>
                    <img src="{{ Storage::disk('uploads')->url($news->cover_image) }}" alt="{{ $news->title['en'] }}">
                    <p>{!! getLangValue($news->content) !!}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Details End -->
@endsection
