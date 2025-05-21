{{-- pop up message at sticked at top when shop is closed --}}

@if ($statusToko == 'closed')
    <div id="shopStatusAlert" class="w-100 z-2">
        <div class="alert alert-danger alert-dismissible fade show mb-0 text-center rounded-0" role="alert">
            <strong>Shop is closed</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

