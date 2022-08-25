@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="hero-small bg-primary100 text-center p-6 mb-5">
        <h1 class="display-2 fw-semibold py-1">Kuisioner Yogasmara</h1>
    </div>
    <div class="kuisioner mb-5">
        <div class="row g-5">
            <div class="col-md-6 pe-0 pe-md-5">
                <h1 class="display-5 fw-semibold">Yuk isi kuisioner!</h1>
                <p class="m-0 text-bn400 fs-18 fw-medium mb-5">Tentukan kuisioner, kemudian Isi form disamping untuk
                    memulai
                    kuisioner.
                    Terimakasih atas
                    partisipasinya!</p>

                <form action="{{ route('kuisioner.create') }}" method="POST" class="mt-3">
                    @csrf
                    <p class="mb-3 fw-medium fs-18 text-bn400">Pilih kuisioner dibawah ini</p>
                    @foreach ($data as $item)
                    <div class="p-4 mb-3 d-flex align-items-center justify-content-between border-bn100 w-100 border-1 border"
                        id="{{ $item->id }}">
                        <p class="m-0 fs-18 fw-medium">{{ $item->nama }}</p>
                        <input class="form-check-input" type="radio" value="{{ $item->id }}" name="kategori"
                            onclick="handleClick(this);" id="kategori-kuis{{ $item->id }}" required>
                    </div>
                    @endforeach
            </div>
            <div class="col-md-6 p-3 pe-0 pe-md-5">
                <div class="box-kuis py-4 px-3">
                    <div class="input-group mb-3 border border-1 px-4 py-3">
                        <span class="input-group-text bg-transparent border-0 border py-0" id="basic-addon1">
                            <img src="/images/profile.svg" width="24" height="24" alt="">
                        </span>
                        <input type="text" class="form-control p-0 border-0 border fs-18" placeholder="Nama Lengkap"
                            aria-label="Nama Lengkap" aria-describedby="basic-addon1" name="nama" required>
                    </div>
                    <div class="input-group mb-3 border border-1 px-4 py-3">
                        <span class="input-group-text bg-transparent border-0 border py-0" id="basic-addon1">
                            <img src="/images/profile.svg" width="24" height="24" alt="">
                        </span>
                        <select class="form-select p-0 border-0 border fs-18" name="jenis_kelamin"
                            aria-label="Default select example" required>
                            <option selected disabled hidden value="">Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 border border-1 px-4 py-3">
                        <span class="input-group-text bg-transparent border-0 border py-0" id="basic-addon1">
                            <img src="/images/calendar.svg" width="24" height="24" alt="">
                        </span>
                        <input type="text" class="form-control p-0 border-0 border fs-18 bg-transparent" readonly
                            placeholder="" name="tglisi" aria-label="" aria-describedby="basic-addon1"
                            value="{{ Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, jS F Y') }}">
                    </div>
                    <div class="input-group date mb-3 border border-1 px-4 py-3">
                        <span class="input-group-text bg-transparent border-0 border py-0" id="basic-addon1">
                            <img src="/images/calendar.svg" width="24" height="24" alt="">
                        </span>
                        <input type="date" class=" tm form-control p-0 border-0 border fs-18 "
                            placeholder="Tanggal Lahir" aria-label="Tanggal Lahir" aria-describedby="basic-addon1"
                            id="tgllahir" placeholder="" name="tgllahir" required autofocus>
                    </div>
                    <div class="input-group mb-3 border border-1 px-4 py-3">
                        <span class="input-group-text bg-transparent border-0 border py-0" id="basic-addon1">
                            <img src="/images/profile.svg" width="24" height="24" alt="">
                        </span>
                        <input type="number" class="form-control p-0 border-0 border fs-18" placeholder="Usia"
                            aria-label="Usia" name="usia" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="d-grid gap-2 mb-3">
                        <button class="btn btn-primary fw-semibold py-3 rounded-0" type="submit">Mulai
                            Kuisioner</button>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    currentValue = 0;
    function handleClick(myRadio) {
      console.log(myRadio.value);
      if (currentValue == 0) {
        document.getElementById(myRadio.value).classList.remove("border-bn100");
        document.getElementById(myRadio.value).classList.add("border-bn500");
      } else {
        document.getElementById(currentValue).classList.remove("border-bn500");
        document.getElementById(currentValue).classList.add("border-bn100");
        document.getElementById(myRadio.value).classList.remove("border-bn100");
        document.getElementById(myRadio.value).classList.add("border-bn500");
      }
      currentValue = myRadio.value;
      bordercurentid = document.getElementById(myRadio.value);
    }
</script>

@endpush

@endsection
