{{-- Site Setting page for admins --}}

@extends('layouts.app')


@section('content')
    @php
        $actionRoute =
            Auth::user()->usertype == 'admin'
                ? route('admin.site-setting.update')
                : route('superadmin.site-setting.update');
    @endphp

    <section id="site-setting" class="container d-flex flex-column justify-content-center">
        <div id="content-wrapper">
            <form class="p-5" method="POST" action="{{ $actionRoute }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="shop_name" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control" id="shop_name" name="shop_name"
                        value="{{ old('shop_name', $siteSettings->shop_name ?? '') }}">
                    <div id="" class="form-text">Nama toko yang akan tampil di website.</div>
                </div>

                <div class="mb-3">
                    <label for="logo_path" class="form-label">Logo Toko</label>
                    <input type="file" class="form-control" id="logo_path" name="logo_path">
                    <p class="text-danger mb-0" style="font-size: 11px; mb-0">*ukuran file max 2MB</p>
                    @if ($siteSettings->logo_path != null)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="Current Logo"
                                style="max-height: 100px;">
                        </div>
                    @else
                        <div class="mt-2">
                            <p class="text-danger">Belum ada gambar custom, website akan memakai gambar default</p>
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="home_background_path" class="form-label">Home Background</label>
                    <input type="file" class="form-control" id="home_background_path" name="home_background_path">
                    <p class="text-danger mb-0" style="font-size: 11px; mb-0">*ukuran file max 2MB</p>
                    @if ($siteSettings->home_background_path != null)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $siteSettings->home_background_path) }}" alt="Current Logo"
                                style="max-height: 100px;">
                        </div>
                    @else
                        <div class="mt-2">
                            <p class="text-danger">Belum ada gambar custom, website akan memakai gambar default</p>
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="about_banner_path" class="form-label">Foto About Banner</label>
                    <input type="file" class="form-control" id="about_banner_path" name="about_banner_path">
                    <p class="text-danger mb-0" style="font-size: 11px; mb-0">*ukuran file max 2MB</p>
                    @if ($siteSettings->about_banner_path != null)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $siteSettings->about_banner_path) }}" alt="Current Logo"
                                style="max-height: 100px;">
                        </div>
                    @else
                        <div class="mt-2">
                            <p class="text-danger">Belum ada gambar custom, website akan memakai gambar default</p>
                        </div>
                    @endif
                </div>



                <div class="mb-3">
                    <label for="shop_email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="shop_email" name="shop_email"
                        aria-describedby="emailHelp" value="{{ old('shop_email', $siteSettings->shop_email ?? '') }}">
                    <div id="emailHelp" class="form-text">Email Toko yang akan tampil di website.</div>
                </div>
                <div class="mb-3">
                    <label for="slogan" class="form-label">Slogan Toko</label>
                    <input type="text" class="form-control" id="slogan" name="slogan"
                        value="{{ old('slogan', $siteSettings->slogan ?? '') }}">
                    <div id="" class="form-text">Slogan yang akan tampil di website.</div>
                </div>
                <div class="mb-3">
                    <label for="about_us" class="form-label">Deskripsi About us Toko</label>
                    <textarea rows="15" type="text" class="form-control" id="about_us" name="about_us">{{ old('about_us', $siteSettings->about_us ?? '') }}</textarea>
                    </textarea>
                    <div id="" class="form-text">Deskripsi About us toko yang akan tampil di website.</div>
                </div>
                <div class="mb-3">
                    <label for="promotion_paragraph" class="form-label">Promotion Paragraph</label>
                    <input type="text" class="form-control" id="promotion_paragraph" name="promotion_paragraph" value="{{ old('promotion_paragraph', $siteSettings->promotion_paragraph ?? '') }}">
                
                    <div id="" class="form-text">Pragraf Promotion toko yang akan tampil di website.</div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon Toko</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ old('phone', $siteSettings->phone ?? '') }}">
                    <div id="" class="form-text">Nomor telepon toko yang akan tampil di website.</div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Toko</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ old('address', $siteSettings->address ?? '') }}">
                    <div id="" class="form-text">Alamat toko yang akan tampil di website.</div>
                </div>
                <div class="mb-3">
                    <label for="facebook_name" class="form-label">Nama Akun Facebook</label>
                    <input type="text" class="form-control" id="facebook_name" name="facebook_name"
                        value="{{ old('facebook_name', $siteSettings->facebook_name ?? '') }}">
                    <div id="" class="form-text">Nama akun facebook yang akan tampil di website.</div>
                </div>
                <div class="mb-3">
                    <label for="facebook_link" class="form-label">Link Akun Facebook</label>
                    <input type="text" class="form-control" id="facebook_link" name="facebook_link"
                        value="{{ old('facebook_link', $siteSettings->facebook_link ?? '') }}">
                    <div id="" class="form-text">Link facebook untuk menampilkan profil facebook.</div>
                </div>
                <div class="mb-3">
                    <label for="instagram_name" class="form-label">Nama Akun Instagram</label>
                    <input type="text" class="form-control" id="instagram_name" name="instagram_name"
                        value="{{ old('instagram_name', $siteSettings->instagram_name ?? '') }}">
                    <div id="" class="form-text">Nama akun instagram yang akan tampil di website.</div>
                </div>
                <div class="mb-3">
                    <label for="instagram_link" class="form-label">Link Akun Instagram</label>
                    <input type="text" class="form-control" id="instagram_link" name="instagram_link"
                        value="{{ old('instagram_link', $siteSettings->instagram_link ?? '') }}">
                    <div id="" class="form-text">Link instagram untuk menampilkan profil instagram.</div>
                </div>
                <div class="mb-3">
                    <label for="twitter_name" class="form-label">Nama Akun Twitter</label>
                    <input type="text" class="form-control" id="twitter_name" name="twitter_name"
                        value="{{ old('twitter_name', $siteSettings->twitter_name ?? '') }}">
                    <div id="" class="form-text">Nama akun twitter instagram yang akan tampil di website.</div>
                </div>
                <div class="mb-3">
                    <label for="twitter_link" class="form-label">Link Akun Instagram</label>
                    <input type="text" class="form-control" id="twitter_link" name="twitter_link"
                        value="{{ old('twitter_link', $siteSettings->twitter_link ?? '') }}">
                    <div id="" class="form-text">Link twitter untuk menampilkan profil twitter.</div>
                </div>

                <div class="mb-3">
                    <label for="copyright_text" class="form-label">Copyright Text</label>
                    <input type="text" class="form-control" id="copyright_text" name="copyright_text"
                        value="{{ old('copyright_text', $siteSettings->copyright_text ?? '') }}">
                    <div id="" class="form-text">Copyright Text</div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </section>
@endsection
