@extends('layouts.app')

@section('content')
<div class="container">
    <div class="hero-small bg-primary100 text-center p-6 mb-5">
        <h1 class="display-2 fw-semibold py-1">Berita & Artikel Yogasmara</h1>
    </div>
    <div class="row mt-3 g-3">
        <div class="col-lg-1 col-4 col-md-2">
            <a href="{{ route('berita') }}"
                class="btn {{ $tahun == '' ? 'btn-dark' : 'btn-outline-dark'}} rounded-0 fw-semibold">Semua</a>
        </div>
        @foreach ($year as $item)
        <div class="col-lg-1 col-4 col-md-2">
            <a href="/berita/tahun/{{ $item->year }}"
                class="btn {{ $tahun == $item->year ? 'btn-dark' : 'btn-outline-dark'}} rounded-0 fw-semibold">{{
                $item->year
                }}</a>
        </div>
        @endforeach

    </div>
</div>
<section class="berita-terbaru-section min-vh-100 py-5 position-relative overflow-hidden">
    <div class="container py-3">
        <div class="row g-4">
            @php
            $no = 0;
            use Illuminate\Support\Facades\Crypt;
            @endphp
            @foreach ($data as $item)
            @php
            $id = Crypt::encryptString($item->id);
            @endphp
            @if ($no == 0)
            <div class="col-lg-8">
                <div class="berita-card position-relative h-100">
                    <img src="{{ asset('storage/'.$item->gambar) }}" width="100%" class="img-fluid" alt="">
                    <div class="berita-text bg-blur-56 position-absolute bottom-0 w-100">
                        <div class="row">
                            <div class="col-12 col-sm-8 p-3">
                                <div class="berita-item p-3 ms-3">
                                    <div class="keterangan-berita d-flex align-items-center">
                                        <p class="m-0 fs-14 fw-semibold">{{ $item->created_at->format('d M Y') }}
                                        </p>
                                        <div class="divider-berita "></div>
                                        <p class="m-0 fs-14 fw-semibold">Penulis : {{ $item->penulis }}</p>
                                    </div>
                                    <div class="title-berita my-3">
                                        <h2 class="h2 fw-semibold m-0 ">{{ $item->title }}</h2>
                                    </div>
                                    <div class="deskripsi-berita m-0 ">{!! $item->desc !!}</div>
                                </div>
                            </div>
                            <div
                                class="col-12 col-sm-4 bg-blur-40 d-flex flex-row flex-sm-column align-items-center justify-content-center p-0">

                                <a href="/berita/{{ $id }}/{{ $item->slug }}" class="text-decoration-none ">
                                    <img src="{{ asset('/images/arrow-right.svg') }}"
                                        class="img-fluid order-last order-sm-first mx-auto d-block " alt="">
                                    <p class="fw-semibold text-center m-0 me-3 me-sm-0">Baca Berita <br>
                                        Lengkap</p>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-4">
                <div class="artikel-heading mb-3"
                    style="background-image: url('{{ asset('storage/'.$item->gambar) }}');">
                </div>
                <div class="artikel-body">
                    <div class="keterangan-artikel d-flex align-items-center">
                        <p class="m-0 fs-14 fw-semibold">{{ $item->created_at->format('d M Y') }}</p>
                        <div class="divider-artikel "></div>
                        <p class="m-0 fs-14 fw-semibold">Penulis : {{ $item->penulis }}</p>
                    </div>
                    <div class="title-artikel my-1">
                        <h4 class="h4 fw-semibold m-0">{{ $item->title }}</h4>
                    </div>
                    <div class="deskripsi-artikel m-0 mb-4">
                        {!! $item->desc !!}
                    </div>
                    <a class="fs-18 d-flex align-items-center text-decoration-none"
                        href="/berita/{{ $id }}/{{ $item->slug }}">
                        <p class="m-0 fs-18 fw-medium pe-1 text-primary">Baca Berita Lengkap</p>
                        <img class="" src="{{ asset('/images/arrow-right-blue.svg') }}" alt="">
                    </a>
                </div>
            </div>
            @endif
            @php
            $no++;
            @endphp
            @endforeach
        </div>
</section>
@endsection
@push('scripts')

@endpush
