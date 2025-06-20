{{-- show order pagee --}}

@extends('layouts.app')

@section('content')

<section id="cart" class="py-5" style="min-height: 90vh" >
    <div class="container" >
            <div class="row" >
                        {{-- order table --}}
            <div class="col-md-7 col-sm-12 " >
                <h3 class="title-script" >Item Order</h3>
                <table class="table normal-font table-transparent d-none d-lg-table">
                    <thead>
                        <tr>
                            {{-- <th scope="col">No</th> --}}
                            <th scope="col">Item</th>
                            <th scope="col">Harga</th>
                            <th scope="col" class="text-center">Jumlah</th>
                            <th scope="col">Subtotal</th>
                            {{-- <th scope="col">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adminOrderDetail as $Item)
                            <tr>
                                <td>{{ $Item->product_name  }}</td>
                                <td>Rp. {{ $Item->product_price }}</td>
                                <td class="text-center">{{ $Item->quantity }}</td>
                                <td>Rp. {{ number_format($Item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- end cart table --}}

            {{-- cart summary --}}
            <div class="col-md-3 col-sm-12 border rounded" style="" >
                <div class="p-3">
                    <h3>Ringkasan Order</h3>

                    <table class="table normal-font table-transparent">
                        <thead>
                            <tr>
                                <th scope="col">Order Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                {{-- <td>Rp. {{ $subTotal }}</td> --}}
                                {{-- <td>Rp. {{ $ongkir }}</td> --}}
                                <td>Rp. {{ number_format($adminOrderItem->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Kode Order :</p>
                    <p class="faded-border"> {{ $adminOrderItem->custom_order_id }}</p>
                    {{-- <p>Status : {{ $adminOrderItem->status }}</p> --}}
                    <p>Nomor Telepon : </p>
                    <p class="faded-border"> {{ $adminOrderItem->user->phone }} </p>
                    <p>Alamat : </p>
                    <p class="faded-border"> {{ $adminOrderItem->address }} </p>
                    <p>Catatan untuk penjual :</p>
                    <p class="faded-border">{{ $adminOrderItem->buyer_note ? $adminOrderItem->buyer_note : 'Belum ada catatan' }}</p>

                    @php
                        $actionRoute = Auth::user()->usertype == 'admin'
                        ? route('admin.order.update', $adminOrderItem->custom_order_id)
                        : route('superadmin.order.update', $adminOrderItem->custom_order_id);
                    @endphp

                    <form action="{{ $actionRoute }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- inpus option for status change from admin --}}
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="Menunggu Pembayaran" {{ $adminOrderItem->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                            <option value="Menunggu Verifikasi" {{ $adminOrderItem->status == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="Dalam Proses" {{ $adminOrderItem->status == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="Delivery" {{ $adminOrderItem->status == 'Delivery' ? 'selected' : '' }}>Delivery</option>
                            <option value="Selesai" {{ $adminOrderItem->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Ditolak" {{ $adminOrderItem->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="Dibatalkan" {{ $adminOrderItem->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        <label for="seller_note">Note untuk pembeli</label>
                        <textarea name="seller_note" id="seller_note" class="" cols="34" rows="5" >
                            {{ $adminOrderItem->seller_note }}
                        </textarea>
                        {{-- submit button --}}
                        <button type="submit" class="btn bg-button-primer w-100">Update</button>
                    </form>



                    {{-- <a href="{{ route('costumer.checkout.index') }}" class="btn btn-primary w-100">Order</a> --}}
                </div>
            </div>
            {{-- end cart summary --}}
            </div>
    </div>
</section>

@endsection
