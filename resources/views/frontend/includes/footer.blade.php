 <!-- Footer -->
 <footer class="footer">
    <div class="shape1"></div>
    <div class="shape2"></div>
    <div class="shape3"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer-contact">
                    <a href="{{ route('index') }}"><img src="{{ Storage::disk('uploads')->url($setting->footer_logo) }}" alt="{{ $setting->company_name['en'] }}"></a>
                    <ul>
                        <li><a href="{{ $setting->facebook }}" target="_blank"><i class="lab la-facebook-f"></i></a></li>
                        <li><a href="{{ $setting->youtube }}" target="_blank"><i class="lab la-youtube"></i></a></li>
                        <li><a href="{{ $setting->twitter }}" target="_blank"><i class="lab la-twitter"></i></a></li>
                        <li><a href="{{ $setting->whatsapp }}" target="_blank"><i class="lab la-whatsapp"></i></a></li>
                        <li><a href="{{ $setting->instagram }}" target="_blank"><i class="lab la-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-links">
                            <h3>{{ __('index.footer.committees') }}</h3>
                            @php
                                $footerCommitties = \App\Models\Membercategory::latest()->where('member_commities', 1)->take(4)->get();
                            @endphp
                            <ul>
                                @foreach ($footerCommitties as $communities)
                                    <li><a href="{{ route('pageSlug', $communities->slug) }}">{{ getLangValue($communities->category_name) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-links links-only">
                            <h3>{{ __('index.footer.quickLinks') }}</h3>
                            <ul>
                                @foreach ($footer_menus as $menu)
                                    <li><a href="{{ route('pageSlug', $menu->category_slug) }}">{{ getLangValue($menu->name) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-info">
                            <h3>{{ __('index.footer.contact') }}</h3>
                            <ul>
                                <li>
                                    <i class="flaticon-signs"></i>
                                    <span>{{ getLangValue($setting->local_address) }}, {{ $setting->district->dist_name }} <br>
                                         {{ $setting->province->eng_name }}, Nepal.</span>
                                </li>
                                <li>
                                    <i class="flaticon-phone-call"></i>
                                    <span> {{ getLangValue($setting->contact_no) }}</span>
                                </li>
                                <li>
                                    <i class="flaticon-message"></i>
                                    <span>{{ $setting->email }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->

<!-- Footer Bottom -->
<div class="footer-bottom">
    <div class="container">
        <ul>
            <li>© 2021 {{ getLangValue($setting->company_name) }}. All Rights Reserved.</li>
            <li>Developed By: <a href="#" target="_blank">Nectar Digit</a></li>
        </ul>
    </div>
</div>
<!-- Footer Bottom End -->


