@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection

@section('content')
    <!-- Contact Us Page -->
    <section class="contact-us mt mb">
        <div class="container">
            <div class="row">
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
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="col-lg-7">
                    <div class="contact-left">
                        <form action="{{ route('message.store') }}" method="POST">
                            @csrf
                            @method("POST")
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="{{ __('index.contact.fullName') }}" required>
                                        <p class="text-danger">
                                            {{ $errors->first('name') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="{{ __('index.contact.email') }}" required>
                                        <p class="text-danger">
                                            {{ $errors->first('email') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="contact_no" class="form-control" placeholder="{{ __('index.contact.phone') }}" required>
                                        <p class="text-danger">
                                            {{ $errors->first('contact_no') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="subject" class="form-control" placeholder="{{ __('index.contact.subject') }}">
                                        <p class="text-danger">
                                            {{ $errors->first('subject') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" placeholder="{{ __('index.contact.message') }}"></textarea>
                                        <p class="text-danger">
                                            {{ $errors->first('message') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-danger">{{ __('index.contact.submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-right">
                        <ul>
                            <li>
                                <i class="flaticon-signs"></i>
                                <div class="contact-content">
                                    <span>{{ __('index.contact.location') }}</span>
                                    <p>
                                        {{ getLangValue($setting->local_address) }}, {{ $setting->district->dist_name }} <br>
                                        {{ $setting->province->eng_name }}.
                                    </p>
                                </div>
                            </li>
                            <li>
                                <i class="flaticon-phone-call"></i>
                                <div class="contact-content">
                                    <span>{{ __('index.contact.callUs') }}</span>
                                    <p> {{ getLangValue($setting->contact_no) }}</p>
                                </div>
                            </li>
                            <li>
                                <i class="flaticon-message"></i>
                                <div class="contact-content">
                                    <span>{{ __('index.contact.emailUs') }}</span>
                                    <p>{{ $setting->email }}</p>
                                </div>
                            </li><li>
                                <i class="flaticon-alarm-clock"></i>
                                <div class="contact-content">
                                    <span>{{ __('index.contact.workTime') }}</span>
                                    <p>{{ $setting->from_day }} - {{ $setting->to_day }} <br> {{ date('h:i a', strtotime($setting->opening_time)) }} - {{ date('h:i a', strtotime($setting->closing_time)) }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="map mt">
                <iframe src="{{ $setting->map_url }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>
    <!-- Contact Us Page End -->
@endsection
