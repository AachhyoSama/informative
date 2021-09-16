@extends('frontend.layouts.app')

@section('content')
    <!-- About Us Page -->
    <section class="about-page mt mb">
        <div class="container">

            <h2 class="page-title mt-5">{{ __('index.index.aboutCompany') }}</h2>
            <div class="page-content">
                {!! getLangValue($setting->aboutus) !!}
            </div>
            {{-- <h2 class="page-title">Founder's Message</h2>
            <div class="page-content">
               {{ $mission_vision->founder_message }}
            </div> --}}
            <h2 class="page-title mt-5">{{ __('index.index.mission') }}</h2>
            <div class="page-content">
               {!! getLangValue($mission_vision->mission_vision) !!}
            </div>

            <h2 class="page-title mt-5">{{ getLangValue($member_benefit->title) }} ({{ getLangValue($member_benefit->descriptive_title) }})</h2>
            <div class="page-content">
               {!! getLangValue($member_benefit->content) !!}
            </div>
        </div>
    </section>
    <!-- About Us Page End -->
@endsection
