@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection

@section('content')
    @if (count($popupnotices) > 0)
        <!-- Skip Ads -->
        <div class="skip-ads-section">
            @foreach ($popupnotices as $notice)
                <div class="skip-ads-col ads-desktop">
                    <div class="skip-ads">
                        <div class="container">
                            <div class="skip-ad-wrap">
                                @if (session('success'))
                                    <div class="col-sm-12">
                                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="col-sm-12">
                                        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    </div>
                                @endif
                                <div class="skip-logo">
                                    <a href="{{ route('index') }}"><img src="{{ Storage::disk('uploads')->url($setting->company_logo) }}" alt="{{ $setting->company_name['en'] }}"></a>
                                </div>
                                <a href="javascript:void(0);">
                                    <img src="{{ Storage::disk('uploads')->url($notice->cover_image) }}" alt="Popup Notice">
                                    <button class="skip-ads-btn">Skip</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="skip-ads-col ads-mobile">
                    <div class="skip-ads">
                        <div class="container">
                            <div class="skip-ad-wrap">
                                @if (session('success'))
                                    <div class="col-sm-12">
                                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="col-sm-12">
                                        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    </div>
                                @endif
                                <div class="skip-logo">
                                    <a href="{{ route('index') }}"><img src="{{ Storage::disk('uploads')->url($setting->company_logo) }}" alt="{{ $setting->company_name['en'] }}"></a>
                                </div>
                                <a href="javascript:void(0);">
                                    <img src="{{ Storage::disk('uploads')->url($notice->cover_image) }}" alt="Popup Notice">
                                    <button class="skip-ads-btn">Skip</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Skip Ads End -->
    @endif

    <!-- Slider -->
    <section class="slider">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000" data-pause="true">
                    <img src="{{ Storage::disk('uploads')->url($first_slider->location) }}" alt="First Slider Image">
                </div>
                @foreach ($sliders as $slider)
                    <div class="carousel-item" data-bs-interval="3000" data-pause="true">
                        <img src="{{ Storage::disk('uploads')->url($slider->location) }}" alt="Slider Image">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- Slider End -->

    <!-- Welcome -->
    <section class="welcome pt pb">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="welcome-message" data-aos="fade-right" data-aos-delay="300">
                        <h3>{{ getLangValue($mission_vision->welcome_title) }}</h3>
                        <span>
                            {{ getLangValue($mission_vision->welcome_sub_title) }}
                        </span>
                        <p>{!! getLangValue($mission_vision->welcome_message) !!}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="welcome-team" data-aos="fade-left" data-aos-delay="600">
                        <ul>
                            @foreach ($members as $member)
                                <li>
                                    <img src="{{ Storage::disk('uploads')->url($member->profile_photo) }}" alt="{{ getLangValue($member->name) }}">
                                    <h3>{{ getLangValue($member->name) }}</h3>
                                    <p>{{ getLangValue($member->position) }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Welcome End -->

    <!-- About Section -->
    <section class="about-sec pt pb">
        <div class="container">
            <div class="main-title">
                <h2>{{ __('index.index.information') }}</h2>
                <a href="{{ route('pageSlug', ['slug' => 'contact']) }}">{{ __('index.index.feelFree') }}</a>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="abt-wrap" data-aos="zoom-in" data-aos-delay="200">
                        <div class="abt-icon">
                            <i class="flaticon-construction"></i>
                        </div>
                        <div class="abt-content">
                            <h3><a href="{{ route('pageSlug', ['slug' => 'about']) }}">{{ __('index.index.aboutCompany') }}</a></h3>
                            <p>
                                @php
                                    $about_part = strip_tags(getLangValue($setting->aboutus));
                                    echo substr($about_part, 0 ,200). "..";
                                @endphp
                            </p>
                            <a href="{{ route('pageSlug', ['slug' => 'about']) }}" class="abt-btn">{{ __('index.index.readMore') }} <i class="las la-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="abt-wrap active" data-aos="zoom-in" data-aos-delay="400">
                        <div class="abt-icon">
                            <i class="flaticon-world"></i>
                        </div>
                        <div class="abt-content">
                            <h3><a href="{{ route('pageSlug', ['slug' => 'about']) }}">{{ __('index.index.mission') }}</a></h3>
                            <p>
                                @php
                                    $mission = strip_tags(getLangValue($mission_vision->mission_vision));
                                    echo substr($mission, 0 ,200). "..";
                                @endphp
                            </p>
                            <a href="{{ route('pageSlug', ['slug' => 'about']) }}" class="abt-btn">{{ __('index.index.readMore') }} <i class="las la-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="abt-wrap" data-aos="zoom-in" data-aos-delay="200">
                        <div class="abt-icon">
                            <i class="flaticon-people-1"></i>
                        </div>
                        <div class="abt-content">
                            <h3><a href="{{ route('pageSlug', ['slug' => 'about']) }}">{{ __('index.index.founder') }}</a></h3>
                            <p>
                                @php
                                    $message = strip_tags(getLangValue($mission_vision->founder_message));
                                    echo substr($message, 0 ,200). "..";
                                @endphp
                            </p>
                            <a href="{{ route('pageSlug', ['slug' => 'founder-message']) }}" class="abt-btn">{{ __('index.index.readMore') }} <i class="las la-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sec-bottom-ads">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ads-list">
                            <a href="{{ $advertisement->middle_ad_one_url }}" target="_blank"><img src="{{ Storage::disk('uploads')->url($advertisement->middle_ad_one) }}" alt="{{ $advertisement->opening_advertisement_url }}"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ads-list">
                            <a href="{{ $advertisement->middle_ad_two_url }}" target="_blank"><img src="{{ Storage::disk('uploads')->url($advertisement->middle_ad_two) }}" alt="{{ $advertisement->opening_advertisement_url }}"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- News -->
    <section class="news pt pb">
        <div class="container">
            <div class="main-title1">
                <h2>{{ __('index.index.newsBoard') }}</h2>
                <p>{{ __('index.index.followUs') }}</p>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="news" data-aos="fade-right" data-aos-delay="300">
                        <ul>
                            @foreach ($news_index as $news)
                            @php
                                $slug = Str::slug($news->title['en']);
                                $nepali_date = datenep($news->written_on);
                                $nepali_array = explode('-', $nepali_date);
                                $nepali_month = nepaliMonth($nepali_array[1]);
                                $nepali_bar = nepaliNumber($nepali_array[2]);
                            @endphp
                                <li class="news-list">
                                    <div class="">
                                        <ul>
                                            <li>
                                                <div class="date">
                                                    @if (session('locale') == "np")
                                                        <b>{{ $nepali_bar }}</b>
                                                        {{ $nepali_month }}
                                                    @else
                                                        <b>{{ date('d', strtotime($news->written_on)) }}</b>
                                                        {{ date('M', strtotime($news->written_on)) }}
                                                    @endif
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="news-right">
                                        <h3><a href="{{ route('pageSlug', $slug) }}">{{ getLangValue($news->title) }}</a></h3>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="information" data-aos="fade-left" data-aos-delay="600">
                        <ul>
                            @foreach ($features as $feature)
                                <li>
                                    <div class="inform-icon">
                                        <img src="{{ Storage::disk('uploads')->url($feature->icons) }}" alt="{{ $feature->title['en'] }}">
                                    </div>
                                    <div class="inform-content">
                                        <span>{{ getLangValue($feature->title) }}</span>
                                        <p>
                                            {{ getLangValue($feature->descriptive_title) }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- News End -->

    <!-- Content Section -->
    <section class="content-sec mt mb">
        <div class="container">
            <div class="sec-top-ads">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ads-list">
                            <a href="{{ $advertisement->middle_ad_three_url }}" target="_blank"><img src="{{ Storage::disk('uploads')->url($advertisement->middle_ad_three) }}" alt="{{ $advertisement->opening_advertisement_url }}"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ads-list">
                            <a href="{{ $advertisement->middle_ad_four_url }}" target="_blank"><img src="{{ Storage::disk('uploads')->url($advertisement->middle_ad_four) }}" alt="{{ $advertisement->opening_advertisement_url }}"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="content-sec-left" data-aos="fade-right" data-aos-delay="300">
                        <img src="{{ Storage::disk('uploads')->url($member_benefit->cover_image) }}" alt="{{ $member_benefit->title['en'] }}">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="content-list" data-aos="fade-left" data-aos-delay="600">
                        <h3>{{ getLangValue($member_benefit->title) }}</h3>
                        <span>{{ getLangValue($member_benefit->descriptive_title) }}</span>
                        <p>
                            @php
                                $benefit = strip_tags(getLangValue($member_benefit->content));
                                echo substr($benefit, 0 ,600). "..";
                            @endphp
                        </p>
                        <a href="{{ route('pageSlug', ['slug' => 'about']) }}" class="cnt-btn">{{ __('index.index.exploreMore') }}</a>
                        <div class="counter">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="counter-wrap">
                                        <div class="counter-icon">
                                            <i class="flaticon-book"></i>
                                        </div>
                                        <div class="counter-content">
                                            <span>{{ getLangValue($setting->projects_completed) }}+</span>
                                            <p>{{ __('index.index.projectComplete') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="counter-wrap">
                                        <div class="counter-icon">
                                            <i class="flaticon-people-1"></i>
                                        </div>
                                        <div class="counter-content">
                                            <span>{{ getLangValue($setting->clients_satisfied) }}+</span>
                                            <p>{{ __('index.index.satisfiedCustomer') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="counter-wrap">
                                        <div class="counter-icon">
                                            <i class="flaticon-avatar"></i>
                                        </div>
                                        <div class="counter-content">
                                            <span>{{ getLangValue($setting->award_winner) }}+</span>
                                            <p>{{ __('index.index.awardsWon') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content Section End -->

    <!-- Blog -->
    <section class="blog pt pb">
        <div class="container">
            <div class="main-title1">
                <h2>{{ __('index.index.popularBlogs') }}</h2>
                <p>{{ __('index.index.followUs') }}</p>
            </div>
            <div class="row">
                @foreach ($blogs_index as $blogs)
                @php
                    $slug = Str::slug($blogs->title['en']);
                    $nepali_date = datenep($blogs->written_on);
                    $nepali_array = explode('-', $nepali_date);
                    $nepali_month = nepaliMonth($nepali_array[1]);
                    $nepali_bar = nepaliNumber($nepali_array[2]);
                @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-wrap" data-aos="flip-left" data-aos-delay="300">
                            <div class="blog-img">
                                <a href="{{ route('pageSlug', $slug) }}"><img src="{{ Storage::disk('uploads')->url($blogs->cover_image) }}" alt="{{ $blogs->title['en'] }}"></a>
                                <div class="date">
                                    @if (session('locale') == "np")
                                        <b>{{ $nepali_bar }}</b>
                                        {{ $nepali_month }}
                                    @else
                                        <b>{{ date('d', strtotime($blogs->written_on)) }}</b>
                                        {{ date('M', strtotime($blogs->written_on)) }}
                                    @endif
                                </div>
                            </div>
                            <div class="blog-content">
                                <h3><a href="{{ route('pageSlug', $slug) }}">{{ getLangValue($blogs->title) }}</a></h3>
                                <p>
                                    @php
                                        $blogs_part = strip_tags(getLangValue($blogs->content));
                                        echo substr($blogs_part, 0 ,150). "..";
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog End -->

    <!-- Home Gallery -->
    <section class="h-gallery pt">
        <div class="container">
            <div class="sec-top-ads">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ads-list">
                            <a href="{{ $advertisement->main_advertisement_url }}" target="_blank"><img src="{{ Storage::disk('uploads')->url($advertisement->main_advertisement) }}" alt="{{ $advertisement->opening_advertisement_url }}"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-title1">
                <h2>{{ __('index.index.gallery') }}</h2>
                <p>{{ __('index.index.followUs') }}</p>
            </div>
            <div class="owl-carousel owl-theme" id="h-gallery">
                @foreach ($albumForIndex as $album)
                @php
                    $slug = Str::slug($album->album_title['en']);
                @endphp
                    <div class="item" data-aos="zoom-in" data-aos-delay="200">
                        <div class="album-wrap">
                            <a href="{{ route('pageSlug', $slug) }}" title="{{ $album->album_title['en'] }}">
                                <div class="g-img">
                                    <img src="{{ Storage::disk('uploads')->url($album->album_cover) }}" alt="{{ $album->album_title['en'] }}">
                                </div>
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
            </div>
        </div>
    </section>
    <!-- Home Gallery End -->

    <!-- Logo Partner -->
    <section class="logo-partner mt mb">
        <div class="container">
            <div class="main-title1">
                <h2>{{ __('index.index.partners') }}</h2>
            </div>
            <div class="owl-carousel owl-theme" id="partner">
                @foreach ($partners as $partner)
                    <div class="item" data-aos="flip-up" data-aos-delay="200">
                        <div class="partner-wrap">
                            <a href="#"><img src="{{ Storage::disk('uploads')->url($partner->partner_logo) }}" alt="{{ $partner->partner_name }}"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Logo Partner End -->

    <!-- Newsletter -->
    <section class="newsletter mt">
        <div class="container">
            <div class="newsletter-wrap">
                <h3>{{ __('index.index.newsletter') }}</h3>
                <div class="newsletter-form">
                    <form action="{{ route('subscribers.store') }}" method="POST">
                        @csrf
                        @method("POST")
                        <input type="email" name="email" placeholder="{{ __('index.index.subscribeFormInput') }}" class="form-control" required>
                        <button type="submit" class="btn btn-danger">{{ __('index.index.subscribe') }} <i class="lab la-telegram-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter End -->
@endsection
