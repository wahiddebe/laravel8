@extends('layouts.app')

@section('content')
<div class="container">
    <section class="berita-detail pt-3 pb-5">
        @php
        use Illuminate\Support\Facades\Crypt;
        $id = Crypt::encryptString($data->id);
        @endphp
        <p class="mt-4 mb-3 fw-semibold text-bn300"> Artikel <span class="text-primary">/</span><span><a
                    class="text-decoration-none" href="/artikel/{{ $id }}/{{ $data->slug }}">{{ $data->title
                    }}</a></span>
        </p>
        <div class="berita-detail px-6 mt-4">
            <div class="d-flex align-items-center mb-4">
                <img class="pe-2" src="{{ asset('storage/'. $data->kategori->gambar) }}" width="80" alt="">
                <h1 class="m-0 ps-1 display-2 fw-semibold" id="voice-title">{{ $data->title }}</h1>
            </div>
            <div class="keterangan-berita d-flex align-items-center mb-4">
                <p class="m-0 fs-14 fw-semibold">{{ $data->created_at->format('d M Y') }}</p>
                <div class="divider-berita "></div>
                <p class="m-0 fs-14 fw-semibold">Penulis : {{ $data->penulis }}</p>
            </div>
            <div class="isi-berita py-3">
                <button onclick="speak()" class="btn btn-primary mb-3" id="speak">
                    <i class="fas fa-play text-light"></i>
                </button>
                <button onclick="stop()" class="btn btn-danger mb-3" id="stop"><i
                        class="fas text-light fa-stop"></i></button>
                <img src="{{ asset('storage/'.$data->gambar) }}" class="w-100 img-fluid" alt="">
                <div class="m-0 py-3" id="voice-desc">
                    {!! $data->desc !!}
                </div>
            </div>
        </div>
    </section>
    <div class="mb-5 divider-modal"></div>
    <section class="mt-5 mb-5 pb-5">
        <h1 class="fw-semibold display-5 text-center mb-5">
            Artikel Lainnya
        </h1>
        <div class="row g-4 mt-3">
            @php
            $no = 1;
            @endphp
            @foreach ($data2 as $item)
            @php
            $id = Crypt::encryptString($item->id);
            @endphp
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
                        href="/artikel/{{ $id }}/{{ $item->slug }}">
                        <p class="m-0 fs-18 fw-medium pe-1 text-primary">Baca Artikel Lengkap</p>
                        <img class="" src="{{ asset('/images/arrow-right-blue.svg') }}" alt="">
                    </a>
                </div>
            </div>

            @if ($no == 3)
            @php
            break;
            @endphp
            @endif
            @php
            $no++;
            @endphp
            @endforeach

        </div>
    </section>
</div>
@push('scripts')
<script type="text/javascript">
    function speak() {
    var title = document.getElementById('voice-title').innerText;
    var element = document.getElementById('voice-desc');
    var children = element.children;
    var desc = "";
    for(var i=0; i<children.length; i++)
    {
        var child=children[i];
        desc+=child.innerText ;
    }
    let utter=new SpeechSynthesisUtterance();
    utter.lang='id-ID';
    utter.text='Judul Artikel ' +title+'. Isi Artikel     '+desc;
    utter.volume = 1;
    utter.rate = 0.6;

    // event after text has been spoken


    // speak
    window.speechSynthesis.speak(utter);
      }
      window.onbeforeunload = function() {
        return responsiveVoice.cancel();
}

function stop() {
    return responsiveVoice.cancel();
}
</script>
@endpush
@endsection
