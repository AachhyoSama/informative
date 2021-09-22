@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
    <!-- Banner -->
    <section class="banner pt pb" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
        <div class="container">
            <h1>{{ $album->album_title['en'] }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('index.top.home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $album->album_title['en'] }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Gallery Details -->
    <section class="gallery-details mt mb">
        <div class="container">
            <div class="row">
                <div class="gallery-details-wrap">
                    <ul id="lightgallery" class="row">
                        @foreach ($album_images as $images)
                            <li class="col-lg-3 col-md-4 col-sm-6" data-src="{{ Storage::disk('uploads')->url($images->album_images) }}">
                                <a href="">
                                    <img src="{{ Storage::disk('uploads')->url($images->album_images) }}" alt="{{ $album->album_title['en'] }}">
                                    <span>{{ getLangValue($album->album_title) }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery Details Page End -->
@endsection
