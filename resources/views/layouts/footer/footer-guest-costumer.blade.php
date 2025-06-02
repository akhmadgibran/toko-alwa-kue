@php
        $siteSettings = \App\Models\SiteSetting::first();
@endphp

<footer id="footer">
    <div class="row">
        <div class="col-12 bg-footer-primer">
            <div class="container">
                <div class="row p-5">
                    <!-- Telephone Section -->
                    <div class="col-md-4 col-12 d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center">
                            <!-- Phone Icon -->
                            <img src="{{ asset('icons/phone-icon.png') }}" class="img-fluid me-3"
                                style="max-width: 50px; max-height: 50px;" alt="phone-icon">
                            <!-- Text -->
                            <div>
                                <h4 class="mb-1">Telephone</h4>
                                <p class="mb-0">{{ $siteSettings->phone }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="col-md-4 col-12 d-flex flex-column justify-content-center">
                        {{-- facebook, icon wth text --}}
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('icons/facebook-icon.png') }}" class="img-fluid me-3"
                                style="max-width: 50px; max-height: 50px;" alt="facebook-icon">
                            <div>
                                <h4 class="mb-1">Facebook</h4>
                                <a class="mb-0 text-decoration-none text-black" href="{{ $siteSettings->facebook_link }}" target="_blank" ><p>{{ $siteSettings->facebook_name }}</p></a>
                            </div>
                        </div>
                        {{-- instagram --}}
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('icons/instagram-icon.png') }}" class="img-fluid me-3"
                                style="max-width: 50px; max-height: 50px;" alt="instagram-icon">
                            <div>
                                <h4 class="mb-1">Instagram</h4>
                                <a class="mb-0 text-decoration-none text-black" href="{{ $siteSettings->instagram_link }}" target="_blank" ><p>{{ $siteSettings->instagram_name }}</p></a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('icons/devicon_twitter.png') }}" class="img-fluid me-3"
                                style="max-width: 50px; max-height: 50px;" alt="twitter-icon">
                            <div>
                                <h4 class="mb-1">Twitter</h4>
                                <a class="mb-0 text-decoration-none text-black" href="{{ $siteSettings->twitter_link }}" target="_blank" ><p>{{ $siteSettings->twitter_name }}</p></a>
                            </div>
                        </div>


                        <div class="d-flex align-items-center">
                            <img src="{{ asset('icons/ic_baseline-email.png') }}" class="img-fluid me-3"
                                style="max-width: 50px; max-height: 50px;" alt="email-icon">
                            <div>
                                <h4 class="mb-1">Email</h4>
                                <a class="mb-0 text-decoration-none text-black" href="mailto:{{ $siteSettings->shop_email }}" target="_blank" ><p>{{ $siteSettings->shop_email }}</p></a>
                            </div>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="col-md-4 col-12 d-flex justify-content-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('icons/location-icon.png') }}" class="img-fluid me-3"
                                style="max-width: 50px; max-height: 50px;" alt="location-icon">
                            <div>
                                <h4 class="mb-1">Location</h4>
                                <p class="mb-0">{{ $siteSettings->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Black Bottom Section -->
<div class="col-12 bg-black d-flex align-items-center" style="height: 60px;">
    <div class="container">
        <div class="row w-100">
            <div class="col-12 d-flex justify-content-center">
                <p class="text-white mb-0">All Right Reserved. &copy; {{ $siteSettings->copyright_text }}</p>
            </div>
        </div>
    </div>
</div>

    </div>
</footer>
