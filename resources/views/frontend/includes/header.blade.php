<!-- Top Header -->
<div class="top-header">
    <div class="container">
        <div class="th-wrap">
            <div class="th-left">
                <ul>
                    <li><i class="las la-envelope-open-text"></i> {{ $setting->email }}</li>
                    <li><i class="las la-phone-volume"></i> {{ getLangValue($setting->contact_no) }}</li>
                </ul>
            </div>
            <div class="th-right">
                <div class="socail-media">
                    <ul>
                        <li class="facebook"><a href="{{ $setting->facebook }}" target="_blank"><i class="lab la-facebook-f"></i></a></li>
                        <li class="youtube"><a href="{{ $setting->youtube }}" target="_blank"><i class="lab la-youtube"></i></a></li>
                        <li class="whatsapp"><a href="{{ $setting->whatsapp }}" target="_blank"><i class="lab la-whatsapp"></i></a></li>
                        <li class="skype"><a href="{{ $setting->twitter }}" target="_blank"><i class="lab la-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="language">
                    <ul>
                        <li><a href="{{ route('lang', ['np']) }}"><img src="{{ asset('frontend/img/nep.png') }}" alt="images"> Nep</a></li>
                        <li><a href="{{ route('lang', ['en']) }}"><img src="{{ asset('frontend/img/en.png') }}" alt="images"> En</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Top Header End -->

<!-- Header Middle -->
<div class="header-middle">
    <div class="container">
        <div class="mh-wrap">
            <div class="logo">
                <a href="{{ route('index') }}"><img src="{{ Storage::disk('uploads')->url($setting->company_logo) }}" alt="{{ $setting->company_name['en'] }}"></a>
            </div>
            <div class="toggle-btn">
                <div class="toggle-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="toggle-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="toggle-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="ads">
                @php
                    $advertisement = \App\Models\Advertisement::first();
                @endphp
                <a href="{{ $advertisement->header_advertisement_url }}" target="_blank"><img src="{{ Storage::disk('uploads')->url($advertisement->header_advertisement) }}" alt="{{ $advertisement->opening_advertisement_url }}"></a>
            </div>
        </div>
    </div>
</div>
<!-- Header Middle End -->

<!-- Header -->
<header id="header" class="header">
    <div class="header-col">
        <div class="container">
            <div class="h-wrap">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @php
                                $members = \App\Models\Membercategory::latest()->where('member_commities', 0)->where('is_active', 1)->get();
                                $committees = \App\Models\Membercategory::latest()->where('member_commities', 1)->where('is_active', 1)->get();
                            @endphp
                            @foreach ($menus as $menu)
                                @php
                                    $child_menus = \App\Models\Menu::latest()->where('parent_id', $menu->id)->get();
                                @endphp
                                @if (count($child_menus) > 0)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ getLangValue($menu->name) }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @foreach ($child_menus as $child_menu)
                                                <li><a class="dropdown-item" href="{{ route('pageSlug', $child_menu->category_slug) }}">{{ $child_menu->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @elseif($menu->slug == "members")
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ getLangValue($menu->name) }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @foreach ($members as $member)
                                                <li><a class="dropdown-item" href="{{ route('pageSlug', $member->slug) }}">{{ getLangValue($member->category_name) }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @elseif($menu->slug == "committees")
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ getLangValue($menu->name) }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @foreach ($committees as $committee)
                                                <li><a class="dropdown-item" href="{{ route('pageSlug', $committee->slug) }}">{{ getLangValue($committee->category_name) }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('pageSlug', $menu->category_slug) }}">{{ getLangValue($menu->name) }}</a>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </nav>
                <div class="search">
                    <div class="search-box">
                        <i class="flaticon-search"></i>
                    </div>
                    <div class="search-overlay">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="search-overlay-layer"></div>
                                <div class="search-overlay-layer"></div>
                                <div class="search-overlay-layer"></div>
                                <div class="search-overlay-close">
                                    <span class="search-overlay-close-line"></span>
                                    <span class="search-overlay-close-line"></span>
                                </div>
                                <div class="search-overlay-form">
                                    <form>
                                        <input type="text" class="input-search" placeholder="Search here...">
                                        <button type="submit"><i class="flaticon-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-news">
        <div class="container">
            <div class="scroll-news-wrap">
                <h3>{{ __('index.top.newsUpdate') }}</h3>
                <marquee behavior="scroll" direction="left" onMouseOver="this.stop()" onMouseOut="this.start()">
                    <ul>
                        @foreach ($latest_news as $news)
                            @php
                                $slug = Str::slug($news->title['en']);
                            @endphp
                            <li>
                                <a href="{{ route('pageSlug', $slug) }}">
                                    {{ getLangValue($news->title) }}.
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </marquee>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->

<!-- Mobile Menu -->
<div id="mySidenav" class="sidenav">
    <div class="mobile-logo">
        <a href="{{ route('index') }}"><img src="{{ asset('frontend/img/logo.png') }}" alt="logo"></a>
        <a href="javascript:void(0)" id="close-btn" class="closebtn">&times;</a>
    </div>
    <div class="no-bdr1">
        <ul id="menu1">
            @foreach ($menus as $menu)
                @php
                    $child_menus = \App\Models\Menu::latest()->where('parent_id', $menu->id)->get();
                @endphp
                @if (count($child_menus) > 0)
                    <li>
                        <a href="#" class="has-arrow">
                            {{ getLangValue($menu->name) }}
                        </a>
                        <ul>
                            @foreach ($child_menus as $child_menu)
                                <li><a href="{{ route('pageSlug', $child_menu->category_slug) }}">{{ $child_menu->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @elseif($menu->slug == "members")

                        <li>
                            <a class="has-arrow" href="#">
                                {{ getLangValue($menu->name) }}
                            </a>
                            <ul>
                                @foreach ($members as $member)
                                    <li><a href="{{ route('pageSlug', $member->slug) }}">{{ getLangValue($member->category_name) }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @elseif($menu->slug == "committees")

                        <li>
                            <a class="has-arrow" href="#">
                                {{ getLangValue($menu->name) }}
                            </a>
                            <ul>
                                @foreach ($committees as $committee)
                                    <li><a href="{{ route('pageSlug', $committee->slug) }}">{{ getLangValue($committee->category_name) }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('pageSlug', $menu->category_slug) }}">{{ getLangValue($menu->name) }}</a>
                    </li>
                @endif

            @endforeach
        </ul>
    </div>
</div>
<!-- Mobile Menu End -->
