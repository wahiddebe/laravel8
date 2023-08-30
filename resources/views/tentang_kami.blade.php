@extends('layouts.app')

@section('content')
<div class="hero-tentang bg-primary100 min-vh-100">
    <div class="container py-4">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{ asset('storage/'.$data->gambar_hero) }}" class="d-block mx-lg-auto img-fluid" alt=""
                    width="450" height="560" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-3 fw-semibold lh-2 mb-3">{{$data->title_hero}}</h1>
                <p class="fs-18 fw-semibold text-bn400 mt-3 mb-5">
                    {!! $data->desc_hero !!}
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="#visi-misi" type="button" class="btn btn-primary px-5 btn-lg py-3">Lihat Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="visi-misi bg-visi-misi" id="visi-misi">
    <div class="container">
        <div class="row">
            <div class="col-md-5 py-5 pe-6 bg-fafafa">
                <h1 class="display-6 fw-semibold">{{ $data->title_visi }}</h1>
                <p class="m-0 mt-4 pe-5 text-bn400 fs-18">
                    {!! $data->desc_visi !!}
                </p>
            </div>
            <div class="col-md-7 py-5 ps-6">
                <h1 class="ms-5 display-6 fw-semibold">{{ $data->title_misi }}</h1>
                <p class="m-0 ms-5 mt-4 text-bn400 fs-18">
                    {!! $data->desc_misi !!}
                </p>
            </div>
        </div>
    </div>
</div>
<div class="layanan bg-fafafa min-vh-100">
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-lg-5 pe-6">
                <img src="{{ asset('storage/'.$data->gambar_layanan) }}" class="d-block mx-lg-auto img-fluid" alt=""
                    width="450" height="560" loading="lazy">
            </div>
            <div class="col-lg-7">
                <h1 class="display-5 fw-semibold lh-2 mb-3">{{ $data->title_layanan }}</h1>
                <div class="accordion accordion-flush mt-4" id="accordionFlushExample">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($data1 as $item)
                    <div class="accordion-item mb-4 border-0">
                        <h2 class="accordion-header" id="a-head{{ $item->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a{{ $item->id }}" aria-expanded="false"
                                aria-controls="{{ 'a'.$item->id }}">
                                <div class="lingkup-list-item d-flex align-items-center">
                                    <img class="pe-3"
                                        src="{{ ($no == 1) ? asset('images/green.svg') : (($no==2) ? asset('images/yellow.svg') : asset('images/red.svg') ) }}"
                                        alt="">
                                    <p class="m-0 fs-18 fw-medium">{{ $item->title }}</p>
                                </div>
                            </button>
                        </h2>
                        <div id="{{ 'a'.$item->id }}" class="accordion-collapse collapse"
                            aria-labelledby="a-head{{ $item->id }}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {!! $item->desc !!}
                            </div>
                        </div>
                    </div>
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
</div>
<div class="nilai-kami py-5">
    <div class="container py-5">
        <h1 class="display-5 fw-semibold lh-2 mb-5 text-center">Nilai Utama Kami</h1>
        <div class="row mt-3 g-4">
            @foreach ($kategori as $kat)
            <div class="col-lg-3 col-md-6 text-center">
                <div class="bg-fafafa p-4">
                    <div class="p-3">
                        <img src="{{ asset('storage/'.$kat->gambar) }}" style="max-height: 135px;" class="img-fluid "
                            alt="">
                        <p class="fs-4 mb-0 mt-3">{{ $kat->nama }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div class="col-lg-3 col-md-6 text-center">
                <div class="bg-fafafa p-4">
                    <div class="p-3">
                        <img src="/images/penerimaan 1.png" style="max-height: 135px;" class="img-fluid " alt="">
                        <p class="fs-4 mb-0 mt-3">Penerimaan</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="bg-fafafa p-4">
                    <div class="p-3">
                        <img src="/images/Akomodasi 1.png" style="max-height: 135px;" class="img-fluid " alt="">
                        <p class="fs-4 mb-0 mt-3">Akomodasi</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="bg-fafafa p-4">
                    <div class="p-3">
                        <img src="/images/Apresiasi 1.png" style="max-height: 135px;" class="img-fluid " alt="">
                        <p class="fs-4 mb-0 mt-3">Apresiasi</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
