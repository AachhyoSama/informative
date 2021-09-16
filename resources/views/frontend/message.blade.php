@extends('frontend.layouts.app')

@section('content')
    <!-- About Us Page -->
    <section class="about-page mt mb">
        <div class="container">
            <h2 class="page-title">{{ __('index.index.founder') }}</h2>
            <div class="page-content">
               {!! getLangValue($mission_vision->founder_message) !!}
            </div>
        </div>
    </section>
    <!-- About Us Page End -->
@endsection
