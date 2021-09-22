<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @yield('meta')

        <link rel="icon" type="" href="{{ asset('frontend/img/bg.jpg') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/line-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/flaticon.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/metisMenu.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/lightslider.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/lightgallery.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
        <link href="{{ asset('frontend/css/aos.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}">
        @php
            $setting = \App\Models\Setting::first();
            $latest_news = \App\Models\News::latest()->where('news_blogs', 0)->take(4)->get();
            $memberCategories = \App\Models\Membercategory::latest()->where('member_commities', 0)->where('is_active', 1)->get();
            $commiteeCategories = \App\Models\Membercategory::latest()->where('member_commities', 1)->where('is_active', 1)->get();
            $menus = \App\Models\Menu::orderBy('position', 'asc')->where('parent_id', null)->whereIn('header_footer', [1, 3])->get();
            $footer_menus = \App\Models\Menu::latest()->where('parent_id', null)->whereIn('header_footer', [2, 3])->get();
        @endphp
        <title>{{ getLangValue($setting->company_name) }}</title>
        <link rel="shortcut icon" type="image/jpg" href="{{ Storage::disk('uploads')->url($setting->company_favicon) }}"/>
    </head>
    <body>
        <div class="wrapper">

            <!-- Header -->
            @include('frontend.includes.header')

            @yield('content')

            @include('frontend.includes.footer')

            <!-- Scroll Top -->
            <div class="go-top">
                <div class="pulse">
                    <i class="las la-angle-up"></i>
                </div>
            </div>
            <!-- Scroll Top End -->

        </div>
        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery-ui.js') }}"></script>
        <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('frontend/js/aos.js') }}"></script>
        <script src="{{ asset('frontend/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('frontend/js/lightslider.min.js') }}"></script>
        <script src="{{ asset('frontend/js/lightgallery-all.min.js') }}"></script>
        <script src="{{ asset('frontend/js/custom.js') }}"></script>
    </body>
</html>
