{{-- payment page --}}

@extends('layouts.app')

@section('content')
<section id="payment-page" >
    <div class="container" >
        <div class="row" >
            {{-- order summary --}}
            <div>
                <h3>Konfirmasi Pembayaran Tertunda</h3>
                <p>Kode Order :</p>
                <p>{{ $order->costom_order_id }}</p>
                <p>Anda akan melakukan transaksi yang sebelumnya tertunda sebesar Rp. {{ $order->total_price }}</p>
                <button id="pay-button" class="btn btn-primary" >Bayar Sekarang</button>
            </div>
        </div>
    </div>
</section>

  <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->
  <div id="snap-container"></div>

  <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
  <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

  <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      // Also, use the embedId that you defined in the div above, here.
      window.snap.embed('{{ $order->snap_token }}', {
        embedId: 'snap-container',
        onSuccess: function (result) {
          /* You may add your own implementation here */
          alert("payment success!"); console.log(result);
          // redirect to success page
          window.location.href = "{{ route('costumer.checkout.success', ['cusstom_order_id' => $order->id]) }}";
        },
        onPending: function (result) {
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
          // redirect ke page list orderan dengan query "Menunggu Pembayaran"
          window.location.href = "{{ route('costumer.checkout.pending', ['cusstom_order_id' => $order->id]) }}"
        },
        onError: function (result) {
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
          // redirect to failed page dan hapus orderan dan kembali ke home
          window.location.href = "{{ route('costumer.checkout.failed', ['cusstom_order_id' => $order->id]) }}"
        },
        onClose: function () {
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
          // redirect ke page list orderan dengan query "Menunggu Pembayaran"
          window.location.href = "{{ route('costumer.checkout.cancel', ['cusstom_order_id' => $order->id]) }}"
        }
      });
    });
  </script>
@endsection