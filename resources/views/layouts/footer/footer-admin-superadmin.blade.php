<footer id="footer" >
    {{-- 2 column, logo, dan copy right --}}
    <div class="row" >
        <div class="col-12 bg-body-secondary d-flex justify-content-center p-2">
            <img class="img-fluid " style="max-width: 50px; max-height: 50px;"  src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="Toko Kue Alwa">
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