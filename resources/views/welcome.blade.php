@extends('layouts.app')

@section('content')
<div class="hero-section min-vh-100 bg-primary100">
    <div class="container">
        <div class="hero-text text-center mb-5">
            <h1 class="display-3 fw-semibold text-bn500 px-5">
                {{ $hero->judul }}
            </h1>
            <p class="fs-4 text-bn400 px-5">
                {{$hero->sub_judul}}
            </p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="#lingkup-section" type="button" class="btn btn-primary px-5 btn-lg py-3 rounded-0">Pelajari
                    Lebih Lanjut</a>
            </div>
        </div>

        <div class="hero-img mt-3 position-relative">
            <img class="img-fluid" src="{{ asset('storage/'.$hero->gambar) }}" width="100%" alt="">
            <div
                class="position-absolute bottom-0 start-0 pengalaman bg-warning m-4 py-3 px-4 d-inline-flex align-items-center">
                <h2 class="ms-3 display-2 fw-semibold">{{ $hero->tahun }}</h2>
                <p class="  ms-3 me-3 my-0 fw-medium fs-18">Tahun <br> Pengalaman</p>
            </div>
        </div>
    </div>
</div>
<section class="lingkup-section py-5" id="lingkup-section">
    <div class="container py-5">
        <div class="text-center">
            <h3 class="display-5 text-dark fw-semibold mb-5">{{ $lingkup->judul }}</h3>
        </div>
        <div class="row m-0 mt-3">
            <div class="col-md-6 position-relative pe-md-5 ps-md-0 px-0
              ">
                <img src="{{ asset('storage/'.$lingkup->gambar) }}" class="img-fluid" alt="">
                <img src="{{ asset('/images/Akomodasi.png') }}"
                    class="img-fluid position-absolute top-0 start-0 translate-middle" alt="">
            </div>
            <div class="col-md-6 ps-md-5 pe-md-0 px-0">
                <div class="lingkup-list ">
                    @php
                    $array = json_decode($lingkup->point);
                    $no = 1;
                    @endphp
                    @foreach ($array as $item)
                    @if ($item != "")

                    <div class="lingkup-list-item pb-3 d-flex align-items-center">
                        <img class="pe-3 "
                            src="{{ ($no == 1) ? asset('images/green.svg') : (($no==2) ? asset('images/yellow.svg') : asset('images/red.svg') ) }}"
                            alt="">
                        <p class="m-0 fs-18 fw-medium">{{ $item }}</p>
                    </div>
                    @endif
                    @php
                    if ($no == 3) {
                    $no = 1;
                    }
                    else {
                    $no++;
                    }
                    @endphp
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<section class="nilai-section bg-primary100 py-5">
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-6 pe-md-5 ps-md-0 px-0">
                <h3 class="display-5 text-dark fw-semibold mb-5">
                    {{ $nilai->judul }}
                </h3>
                <div class="row m-0 mb-4 g-4">


                    @foreach ($kategori as $item)
                    <div class="col-12 col-xl-6 text-center">
                        <div class="bg-fafafa p-4">
                            <div class="p-3">
                                <img src="{{ asset('storage/'.$item->gambar) }}" style="max-height: 135px;"
                                    class="img-fluid " alt="">
                                <p class="fs-4 mb-0 mt-3">{{ $item->nama }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 ps-md-5 pe-md-0 ">
                <img src="{{ asset('storage/'.$nilai->gambar1) }}" class="img-fluid nilai-img mt-5" alt="">
                <img src="{{ asset('storage/'.$nilai->gambar2) }}" class="img-fluid mt-4" alt="">
            </div>
        </div>
    </div>

</section>
<section class="berita-terbaru-section min-vh-100 py-5 position-relative overflow-hidden">
    <div class="container py-5">
        <div class="title-section d-flex justify-content-between mb-5">
            <div class="title-item d-flex align-items-center">
                <h3 class="display-5 text-dark fw-semibold mb-0 me-5">Berita Terbaru</h3>
                <img src="/images/penerimaan 1.svg" alt="">
            </div>
            <div class="title-item d-flex align-items-center">
                <a class="text-decoration-none fs-18" href="{{ route('berita') }}">Lihat Berita Lainnya</a>
            </div>
        </div>

        <div class="row g-4">
            @php
            $no = 0;
            use Illuminate\Support\Facades\Crypt;
            @endphp
            @foreach ($berita as $item)
            @php
            $id = Crypt::encryptString($item->id);
            @endphp
            @if ($no == 0 ) <div class="col-lg-8">
                <div class="berita-card position-relative h-100">
                    <img src="{{ asset('storage/'.$item->gambar) }}" width="100%" class="img-fluid" alt="">
                    <div class="berita-text bg-blur-56 position-absolute bottom-0 w-100">
                        <div class="row">
                            <div class="col-12 col-sm-8 p-3">
                                <div class="berita-item p-3 ms-3">
                                    <div class="keterangan-berita d-flex align-items-center">
                                        <p class="m-0 fs-14 fw-semibold">{{ $item->created_at->format('d M Y') }}</p>
                                        <div class="divider-berita "></div>
                                        <p class="m-0 fs-14 fw-semibold">Penulis : {{ $item->penulis }}</p>
                                    </div>
                                    <div class="title-berita my-3">
                                        <h2 class="h2 fw-semibold m-0">{{ $item->title }}</h2>
                                    </div>
                                    <div class="deskripsi-berita m-0">{!! $item->desc !!}</div>
                                </div>
                            </div>
                            <div
                                class="col-12 col-sm-4 bg-blur-40 d-flex flex-row flex-sm-column align-items-center justify-content-center p-0">
                                <a href="/berita/{{ $id }}/{{ $item->slug }}" class="text-decoration-none ">
                                    <img src="/images/arrow-right.svg"
                                        class="img-fluid order-last order-sm-first mx-auto d-block " alt="">
                                    <p class="fw-semibold text-center m-0 me-3 me-sm-0">Baca Berita <br>
                                        Lengkap</p>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @php
            $no++;
            @endphp
            @endforeach
            <div class="col-lg-4">
                <div class="row g-4">
                    @php
                    $no1 = 0;
                    @endphp
                    @foreach ($berita as $item)
                    @php
                    $id = Crypt::encryptString($item->id);
                    @endphp
                    @if ($no1 < 2) <div class="col-12">
                        <div class="berita-card position-relative">
                            <img src="{{ asset('storage/'.$item->gambar) }}" width="100%" class="img-fluid" alt="">
                            <div class="berita-text bg-blur-56 position-absolute bottom-0 w-100">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="berita-item p-3">
                                            <div class="keterangan-berita d-flex align-items-center">
                                                <p class="m-0 fs-12 fw-semibold">{{ $item->created_at->format('d M Y')
                                                    }}</p>
                                                <div class="divider-berita "></div>
                                                <p class="m-0 fs-12 fw-semibold">Penulis : {{ $item->penulis }}</p>
                                            </div>
                                            <div class="title-berita my-2">
                                                <h2 class="fs-18 fw-semibold m-0">{{ $item->title }}</h2>
                                            </div>
                                            <div class="fs-14 deskripsi-berita m-0 mb-1">
                                                {!! $item->desc !!}
                                            </div>
                                            <a href="/berita/{{ $id }}/{{ $item->slug }}" class="text-decoration-none">
                                                <p class="m-0 fs-14 fw-semibold">Baca Berita Lengkap</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endif
                @php
                $no1++;
                @endphp
                @endforeach
            </div>
        </div>
    </div>
    </div>
    <img src="/images/penerimaan 1 (1).png" class="position-absolute bg-berita" alt="">
</section>
<section class="artikel-terbaru-section min-vh-100 py-3 position-relative overflow-hidden">
    <div class="container py-5">
        <div class="title-section d-flex justify-content-between mb-5">
            <div class="title-item d-flex align-items-center">
                <h3 class="display-5 text-dark fw-semibold mb-0 me-5">Artikel Terbaru</h3>
                <img src="/images/penerimaan 1.svg" alt="">
            </div>
            <div class="title-item d-flex align-items-center">
                <a class="text-decoration-none fs-18" href="{{ route('artikel') }}">Lihat Artikel Lainnya</a>
            </div>
        </div>
        <div class="row g-4">
            @php
            $no2 = 0;
            @endphp
            @foreach ($artikel as $item)
            @php
            $id = Crypt::encryptString($item->id);
            @endphp
            @if ($no2 < 3) <div class="col-md-4">
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
                    <a class="fs-18 " href="/artikel/{{ $id }}/{{ $item->slug }}">Lihat Artikel Lengkap</a>
                </div>
        </div>
        @endif


        @php
        $no2++;
        @endphp
        @endforeach


    </div>
    </div>
    <img src="/images/penerimaan 2.png" class="position-absolute bg-artikel" alt="">
</section>
<section class="yogasmara-shop min-vh-100 py-3">
    <div class="container py-5">
        <div class="title-section d-flex justify-content-between mb-5">
            <div class="title-item d-flex align-items-center">
                <h3 class="display-5 text-dark fw-semibold mb-0 me-5">Yogasmara Shop</h3>
            </div>
            <div class="title-item d-flex align-items-center">
                <a href="{{ route('shop') }}" class="btn btn-outline-primary rounded-0 px-5 btn-lg py-3">Lihat Lebih
                    Banyak</a>

            </div>
        </div>
        <div class="row g-3">
            @php
            $no3 = 0;
            @endphp
            @foreach ($shop as $item)
            @if ($no3 < 4) <div class="col-lg-3 col-md-6 ">
                <div class="card-shop">
                    <style>
                        .text-2 {
                            overflow: hidden;
                            text-overflow: ellipsis;
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            /* number of lines to show */
                            -webkit-box-orient: vertical;
                        }
                    </style>
                    <div class="shop-heading p-5 d-flex align-items-center">
                        <img src="{{ asset('storage/'.$item->gambar) }}"
                            class=" border border-white border-4 radius-4 img-fluid mx-auto d-block" alt="">
                    </div>
                    <div class="shop-body mt-4">
                        <p class="m-0 fs-4 fw-medium text-2">{{ $item->title }}</p>
                        <a class="fs-18 fw-medium mt-3" data-bs-toggle="modal" data-bs-target="#view{{ $item->id }}"
                            href="">Lihat
                            Barang</a>
                    </div>
                </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="view{{ $item->id }}" tabindex="-1" aria-labelledby="view{{ $item->id }}Label"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable ">
                <div class="modal-content border-0 rounded-0 bg-transparent overflow-visible">
                    <div class="modal-header ">
                        <button type="button" class="btn-close" style="margin-right: -4em;" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-white p-5">
                        <div class="container-fluid">
                            <div class="row g-5">
                                <div class="col-lg-3">
                                    <div class="shop-heading p-5 d-flex align-items-center mb-3">
                                        <img src="{{ asset('storage/'.$item->gambar) }}"
                                            class="border border-white border-4 radius-4 img-fluid mx-auto d-block"
                                            alt="">
                                    </div>
                                    <p class="mt-4 text-bn300">
                                        Harga per Item
                                    </p>
                                    <h1 class="fs-36 fw-medium mb-4">Rp<span class="colprice">{{ $item->price
                                            }}</span>
                                    </h1>
                                    <div class="d-grid gap-2 mt-5">
                                        <a class="btn btn-green rounded-0 p-3" href="{{ $item->link }}" target="_blank">
                                            <div class="d-flex align-items-center justify-content-center text-white">
                                                <img src="{{ asset('/images/arcticons_tokopedia.svg') }}"
                                                    class="img-fluid me-2" alt="">
                                                Beli di Tokopedia
                                            </div>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-lg-9">
                                    <h1 class="fs-36 fw-medium">
                                        {{ $item->title }}
                                    </h1>
                                    <div class="divider-modal w-100 mt-3 mb-4">
                                    </div>
                                    <p class="fs-18 fw-semibold">Kegunaan :</p>
                                    <div class="">
                                        {!! $item->desc !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @php
        $no3++;
        @endphp
        @endforeach
    </div>
    </div>
    </div>
</section>
@endsection
