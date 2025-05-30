{{-- pop up message at sticked at top when shop is closed --}}

@if ($statusToko->name == 'closed')
        <div id="shopStatusAlert" class="w-100 sticky-alert-top">
        <div class="alert alert-danger alert-dismissible fade show mb-0 text-center rounded-0 shadow-lg" role="alert">
            <strong>Toko sedang tutup, {{ $statusToko->description }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

@endif
