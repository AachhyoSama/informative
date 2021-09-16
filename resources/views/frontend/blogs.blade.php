@extends('frontend.layouts.app')

@section('content')
    <!-- Banner -->
    <section class="banner pt pb" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
        <div class="container">
            <h1>{{ __('index.breadcrumb.blogs') }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('index.top.home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('index.breadcrumb.blogs') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Blog Page -->
    <section class="blog-page mt mb">
        <div class="container">
            <div class="row">
                @if (count($blogs) == 0)
                    <h3 class="text-center">{{ __('index.emptyInfo.noItem') }}</h3>
                @else
                    @foreach ($blogs as $blog)
                        @php
                            $slug = Str::slug($blog->title['en']);
                            $nepali_date = datenep($blog->written_on);
                            $nepali_array = explode('-', $nepali_date);
                            $nepali_month = nepaliMonth($nepali_array[1]);
                            $nepali_bar = nepaliNumber($nepali_array[2]);
                        @endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="blog-wrap" data-aos="flip-left" data-aos-delay="300">
                                <div class="blog-img">
                                    <a href="{{ route('pageSlug', $slug) }}"><img src="{{ Storage::disk('uploads')->url($blog->cover_image) }}" alt="{{ $blog->title['en'] }}"></a>
                                    <div class="date">
                                        @if (session('locale') == "np")
                                            <b>{{ $nepali_bar }}</b>
                                            {{ $nepali_month }}
                                        @else
                                            <b>{{ date('d', strtotime($blog->written_on)) }}</b>
                                            {{ date('M', strtotime($blog->written_on)) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <h3><a href="{{ route('pageSlug', $slug) }}">{{ getLangValue($blog->title) }}</a></h3>
                                    <p>
                                        @php
                                            $blog_part = strip_tags(getLangValue($blog->content));
                                            echo substr($blog_part, 0 ,150). "..";
                                        @endphp
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <nav aria-label="Page navigation example">
                <span class="pagination-sm m-0 float-right">{{ $blogs->links() }}</span>
            </nav>
        </div>
    </section>
    <!-- Blog Page End -->
@endsection
