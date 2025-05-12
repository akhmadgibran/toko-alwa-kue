{{-- payment page --}}

@extends('layouts.app')

@section('content')
<section id="payment-page" >
    <div class="container" >
        <div class="row" >
            {{-- order summary --}}
            <div>
                <h3>Konfirmasi Pembayaran</h3>
                <p>Kode Order :</p>
                <p>{{ $order->costom_order_id }}</p>
                <p>Anda akan melakukan transaksi sebelumnya sebesar Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
                <button id="pay-button" class="btn btn-primary" >Bayar Sekarang</button>
            </div>
        </div>
    </div>
</section>

  <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->
  <div id="snap-container"></div>

  <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
  {{-- <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script> --}}
      <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

       <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
            // window.location.href = "{{ route('costumer.checkout.success', ['custom_order_id' => $order->custom_order_id]) }}";
            var form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", "{{ route('costumer.checkout.success', ['custom_order_id' => $order->custom_order_id]) }}");

            var csrfToken = document.createElement("input");
            csrfToken.setAttribute("type", "hidden");
            csrfToken.setAttribute("name", "_token");
            csrfToken.setAttribute("value", "{{ csrf_token() }}");

            form.appendChild(csrfToken);

            document.body.appendChild(form);
            form.submit();
          },
          onPending: function(result){
            /* You may add your own implementation here */
            alert("wating your payment! Periksa Halaman Order"); console.log(result);
            var form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", "{{ route('costumer.checkout.pending', ['custom_order_id' => $order->custom_order_id]) }}");

            var csrfToken = document.createElement("input");
            csrfToken.setAttribute("type", "hidden");
            csrfToken.setAttribute("name", "_token");
            csrfToken.setAttribute("value", "{{ csrf_token() }}");

            form.appendChild(csrfToken);

            document.body.appendChild(form);
            form.submit();
          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
            var form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", "{{ route('costumer.checkout.fail', ['custom_order_id' => $order->custom_order_id]) }}");

            var csrfToken = document.createElement("input");
            csrfToken.setAttribute("type", "hidden");
            csrfToken.setAttribute("name", "_token");
            csrfToken.setAttribute("value", "{{ csrf_token() }}");

            form.appendChild(csrfToken);

            document.body.appendChild(form);
            form.submit();
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
            var form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", "{{ route('costumer.checkout.cancel', ['custom_order_id' => $order->custom_order_id]) }}");

            var csrfToken = document.createElement("input");
            csrfToken.setAttribute("type", "hidden");
            csrfToken.setAttribute("name", "_token");
            csrfToken.setAttribute("value", "{{ csrf_token() }}");

            form.appendChild(csrfToken);

            document.body.appendChild(form);
            form.submit();
          }
        })
      });
    </script>


  {{-- <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      // Also, use the embedId that you defined in the div above, here.
      window.snap.embed('{{ $snapToken }}', {
        embedId: 'snap-container',
        onSuccess: function (result) {
          /* You may add your own implementation here */
          alert("payment success!"); console.log(result);
          // redirect to success page
window.location.href = "{{ route('costumer.checkout.success', ['custom_order_id' => $order->custom_order_id]) }}";
        },
        onPending: function (result) {
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
          // redirect ke page list orderan dengan query "Menunggu Pembayaran"
          window.location.href = "{{ route('costumer.checkout.pending', ['custom_order_id' => $order->custom_order_id]) }}"
        },
        onError: function (result) {
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
          // redirect to failed page dan hapus orderan dan kembali ke home
          window.location.href = "{{ route('costumer.checkout.fail', ['custom_order_id' => $order->custom_order_id]) }}"
        },
        onClose: function () {
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
          // redirect ke page list orderan dengan query "Menunggu Pembayaran"
          var form = document.createElement("form");
          form.setAttribute("method", "POST");
          form.setAttribute("action", "{{ route('costumer.checkout.cancel', ['custom_order_id' => $order->custom_order_id]) }}");

          var csrfToken = document.createElement("input");
          csrfToken.setAttribute("type", "hidden");
          csrfToken.setAttribute("name", "_token");
          csrfToken.setAttribute("value", "{{ csrf_token() }}");

          form.appendChild(csrfToken);

          document.body.appendChild(form);
          form.submit();
        }
      });
    });
  </script> --}}
@endsection
