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
                @endif
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('index.top.home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if ($member_category)
                            {{ getLangValue($member_category->category_name) }}
                        @else
                            {{ getLangValue($member_subcategory->sub_category_name) }}
                        @endif
                    </li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Team Page Us -->
    <section class="team mt mb">
        <div class="container">
            <div class="row">
                @if (count($members) == 0)
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <h3>{{ __('index.emptyInfo.noMember') }}</h3>
                    </div>
                @endif
                @foreach ($members as $member)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="team-wrap">
                            <a href="#" data-bs-toggle="modal" data-bs-target=".modal-pop-{{ $member->id }}">
                                <div class="team-img">
                                    <img src="{{ Storage::disk('uploads')->url($member->profile_photo) }}" alt="images">
                                </div>
                                <div class="team-content">
                                    <h3>{{ getLangValue($member->name) }}</h3>
                                    <span>{{ getLangValue($member->position) }}</span>
                                </div>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade modal-pop-{{ $member->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $member->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel{{ $member->id }}">{{ getLangValue($member->name) }}</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="team-detail-wrap">
                                                <img src="{{ Storage::disk('uploads')->url($member->profile_photo) }}" alt="{{ getLangValue($member->name) }}" style="max-height: 450px;">
                                                <ul class="team-detail-list">
                                                    <li>
                                                        <b>{{ __('index.index.table_name') }}:</b>
                                                        <span>{{ getLangValue($member->name) }}</span>
                                                    </li>
                                                    <li>
                                                        <b>{{ __('index.index.designation') }}:</b>
                                                        <span>{{ getLangValue($member->position) }}</span>
                                                    </li>
                                                    <li>
                                                        <b>{{ __('index.contact.address') }}:</b>
                                                        <span>{{ getLangValue($member->address) }}</span>
                                                    </li>
                                                    <li>
                                                        <b>{{ __('index.contact.phone') }}:</b>
                                                        <span>{{ __('index.contact.telecode') }} {{ getLangValue($member->contact_no) }}</span>
                                                    </li>
                                                    <li>
                                                        <b>{{ __('index.contact.email') }}:</b>
                                                        <span>
                                                            @if ($member->email == null)
                                                                -
                                                            @else
                                                                {{ $member->email }}
                                                            @endif
                                                        </span>
                                                    </li>
                                                </ul>
                                                <p>
                                                    {{ getLangValue($member->details) }}
                                                </p>
                                                <ul class="team-details-social">
                                                    <li class="facebook"><a href="{{ $member->facebook }}" target="_blank"><i class="lab la-facebook-f"></i></a></li>
                                                    <li class="whatsapp"><a href="{{ $member->whatsapp }}" target="_blank"><i class="lab la-whatsapp"></i></a></li>
                                                    <li class="twitter"><a href="{{ $member->twitter }}" target="_blank"><i class="lab la-twitter"></i></a></li>
                                                    <li class="youtube"><a href="{{ $member->youtube }}" target="_blank"><i class="lab la-youtube"></i></a></li>
                                                    <li class="linkedin"><a href="{{ $member->linkedin }}" target="_blank"><i class="lab la-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Team Page End -->
@endsection
