@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="hero-small bg-primary100 text-center p-6 mb-5">
        <h1 class="display-2 fw-semibold py-1">Yogasmara Shop</h1>
    </div>
    <div class="row g-3 mt-3 mb-5">
        @foreach ($data as $item)
        <div class="col-lg-3 col-md-6 ">
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
                                    <h1 class="fs-36 fw-medium mb-4">Rp<span class="colprice">{{ $item->price }}</span>
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
        @endforeach

    </div>
</div>

@push('scripts')
<script>
    var harga = document.getElementsByClassName('price');
        console.log(harga);
        for(var i = 0; i < harga.length; i++) {
            if (harga[i].value != "" || harga[i].value != null) {
                harga[i].value = formatRupiah(harga[i].value,);
            }
        harga[i].addEventListener('keyup', function(e)
        {
        e.target.value = formatRupiah(this.value, );
        });
        }

        var colprice = document.getElementsByClassName('colprice');
        for(var i = 0; i < colprice.length; i++) {
            if (colprice[i] != null || colprice[i] != "") {
                colprice[i].innerHTML = formatRupiah(colprice[i].innerHTML, "Rp.");
            }

            }
        function formatRupiah(angka, prefix)
        {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        }
</script>
@endpush

@endsection
