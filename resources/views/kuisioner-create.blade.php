@extends('layouts.app')

@section('content')
<style>
    .tab {
        display: none;
    }

    input.invalid {
        background-color: #ffdddd;
    }
</style>
<div class="container pb-5">
    <p class="mt-4 mb-3 fw-semibold text-bn300"> Kuisioner <span class="text-primary">/</span><span><a
                class="text-decoration-none" href="#">{{ $kategori->nama
                }}</a></span>
    </p>
    <div class="kuisioner mb-5">
        <div class="row g-5">
            <div class="col-md-6 p-3 pe-0 pe-md-5">
                <div class="box-kuis py-4 px-4">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="fw-semibold">
                                <td class="p-0" width="30%">Nama</td>
                                <td class="p-0" width="5%">
                                    <p class="text-center">:</p>
                                </td>
                                <td class="p-0" width="65%">{{ $data['nama'] }}</td>
                            </tr>
                            <tr class="fw-semibold">
                                <td class="p-0" width="30%">Jenis Kelamin</td>
                                <td class="p-0" width="5%">
                                    <p class="text-center">:</p>
                                </td>
                                <td class="p-0" width="65%">{{ $data['jenis_kelamin'] }}</td>
                            </tr>
                            <tr class="fw-semibold">
                                <td class="p-0" width="30%">Pengisian Kuisioner</td>
                                <td class="p-0" width="5%">
                                    <p class="text-center">:</p>
                                </td>
                                <td class="p-0" width="65%">{{ $data['tglisi'] }}</td>
                            </tr>
                            <tr class="fw-semibold">
                                <td class="p-0" width="30%">Tanggal Lahir</td>
                                <td class="p-0" width="5%">
                                    <p class="text-center">:</p>
                                </td>
                                <td class="p-0" width="65%">{{ $data['tgllahir'] }}</td>
                            </tr>
                            <tr class="fw-semibold">
                                <td class="p-0" width="30%">Usia</td>
                                <td class="p-0" width="5%">
                                    <p class="text-center">:</p>
                                </td>
                                <td class="p-0" width="65%">{{ $data['usia'] }} Tahun</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="col-md-6 px-3 py-0 pe-0 pe-md-5">
                <form action="{{ route('kuisioner.store') }}" id="form-kuisioner" enctype="multipart/form-data"
                    method="post">
                    @csrf
                    @php
                    $no = 1;
                    function countsub($id)
                    {
                    $count = DB::table('kuisioners')->where('sub_kategori_id', $id)->count();
                    return $count;
                    }
                    @endphp
                    @foreach ($kuisioner as $item)

                    <div class=" py-4 px-4 tab">
                        <div class="py-2 px-4 bg-bn100 fs-18 fw-medium d-inline">
                            {{ $item->subkategori->nama != null || $item->subkategori->nama != "NULL" ||
                            $item->subkategori->nama != '' ? $item->subkategori->nama : '' }}( {{ $no }}/ {{
                            countsub($item->sub_kategori_id) }} )
                        </div>
                        <div class="mt-4">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr class="fw-medium">
                                        <td class="p-0" width="5%">{{ $no }}. </td>
                                        <td class="p-0" width="95%">
                                            <p class="text-left">
                                                {{ $item->pertanyaan }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="p-0" width="5%"></td>
                                        <td class="p-0" width="95%">
                                            <div class="form-check my-4 d-none">

                                                <input required class="form-check-input"
                                                    oninput="this.className = 'form-check-input'" value="-100"
                                                    type="radio"
                                                    name="pilihan{{ $item->sub_kategori_id }}{{ $item->id }}" id=""
                                                    hidden checked>
                                            </div>
                                            @foreach ($item->pilihans as $item2)

                                            @if ($item2->pilihan == 'Gambar')
                                            <div class="my-4">
                                                <input onchange="gantibtn()"
                                                    name="pilihan{{ $item->sub_kategori_id }}{{ $item->id }}" required
                                                    class="form-control" type="file" id="formFile">
                                            </div>

                                            @endif
                                            @if ($item2->pilihan == 'Teks')
                                            <div class="my-4">
                                                <input onchange="gantibtn()"
                                                    name="pilihan{{ $item->sub_kategori_id }}{{ $item->id }}" required
                                                    class="form-control" type="teks" id="formFile">
                                            </div>
                                            @endif
                                            @if ($item2->pilihan != 'Gambar' && $item2->pilihan != 'Teks')
                                            <div class="form-check my-4">

                                                <input onchange="gantibtn()" required class="form-check-input"
                                                    oninput="this.className = 'form-check-input'"
                                                    value="{{ $item2->nilai }}" type="radio"
                                                    name="pilihan{{ $item->sub_kategori_id }}{{ $item->id }}"
                                                    id="pilihanid{{ $item->sub_kategori_id }}{{ $item2->id }}">
                                                <label class="form-check-label"
                                                    for="pilihanid{{ $item->sub_kategori_id }}{{ $item2->id }}">
                                                    {{ $item2->pilihan }}
                                                </label>
                                            </div>
                                            @endif
                                            @endforeach

                                            <button type="button" class="nextBtn mt-4 px-lg-5 btn btn-bn300 rounded-0"
                                                id="nextBtn" onclick="nextPrev(1)"></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @php
                    if ($no == countsub($item->sub_kategori_id)) {
                    $no = 1;
                    }
                    else{
                    $no++;
                    }
                    @endphp
                    @endforeach
                    <input type="text" name="nama" hidden value="{{ $data['nama'] }}">
                    <input type="text" name="jenis_kelamin" hidden value="{{ $data['jenis_kelamin'] }}">
                    <input type="text" name="tgllahir" hidden value="{{ $data['tgllahir'] }}">
                    <input type="text" name="usia" hidden value="{{ $data['usia'] }}">
                    <input type="text" name="kategori" hidden value="{{ $data['kategori'] }}">
                </form>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    function gantibtn() {
        var elements = document.getElementsByClassName("nextBtn");
        for (var i = 0; i < elements.length; i++) {
            elements[i].classList.add("btn-primary");
            elements[i].classList.remove("btn-bn300");
        }
            // document.getElementsByClassName("nextBtn").classList.add("btn-primary");
            // document.getElementsByClassName("nextBtn").classList.remove("btn-bn300");
    }
    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      console.log(x.length,n);
      if (n == (x.length-1)) {
        var elements = document.getElementsByClassName("nextBtn");
        for (var i = 0; i < elements.length; i++) {
            elements[i].innerHTML = "Submit";
        }
      } else {
        var elements = document.getElementsByClassName("nextBtn");
        for (var i = 0; i < elements.length; i++) {
            elements[i].innerHTML = "Lanjut";
        }
      }

    }
    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("form-kuisioner").submit();
        return false;
      }
      var elements = document.getElementsByClassName("nextBtn");
            for (var i = 0; i < elements.length; i++) { elements[i].classList.remove("btn-primary");
                elements[i].classList.add("btn-bn300"); }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i,j, valid = true;
      x = document.getElementsByClassName("tab");
    //   y = x[currentTab].getElementsByTagName("input");
      y = x[currentTab].getElementsByClassName("form-check-input");
      z = x[currentTab].getElementsByClassName("form-control");
      // A loop that checks every input field in the current tab:
        // If a field is empty...
        console.log("length"+z.length);
        if(z.length>0){
        for (j = 0; j < z.length; j++) {
        // If a field is empty...
        console.log(z[j].value);
        if (z[0].value == null || z[0].value === "") {
          // add an "invalid" class to the field:
          z[j].className += " invalid";
          // and set the current valid status to false
          valid = false;

        }

      }
        }

      if(y.length>1){
              for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[0].checked == true) {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }

      }
      }

console.log(valid);
      return valid; // return the valid status
    }
</script>
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
