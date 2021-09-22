@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
    <!-- Banner -->
    <section class="banner pt pb" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
        <div class="container">
            <h1>{{ __('index.index.gallery') }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('index.top.home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('index.index.gallery') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Gallery Page Us -->
    <section class="gallery-page mt mb">
        <div class="container">
            <div class="row">
                @if (count($albums) == 0)
                    <h3 class="text-center">{{ __('index.emptyInfo.noItem') }}</h3>
                @else
                    @foreach ($albums as $album)
                    @php
                        $slug = Str::slug($album->album_title['en']);
                    @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="album-wrap">
                                <a href="{{ route('pageSlug', $slug) }}" title="{{ $album->album_title['en'] }}">
                                    <img src="{{ Storage::disk('uploads')->url($album->album_cover) }}" alt="{{ $album->album_title['en'] }}">
                                    <span>{{ getLangValue($album->album_title) }}</span>
                                    <p>
                                        @php
                                            $album_images_count = \App\Models\AlbumImages::where('album_id', $album->id)->count();
                                        @endphp
                                        {{ $album_images_count }} {{ __('index.index.photo') }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Gallery Page End -->
@endsection
