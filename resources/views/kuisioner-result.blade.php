@extends('layouts.app')

@section('content')
@php
use Illuminate\Support\Facades\Storage;
@endphp
<div class="container">
    <div id="canvas">
        <h1 class="h4 text-center mb-3">
            {{ $kategori->nama }}
        </h1>
        <div class="border border-3 border-dark text-center" id="print">
            @if ($kategori->id == 2)
            <table id="myTable" class="table text-start table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Pertanyaan</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($hasilpil as $item)

                    <tr>
                        <td>{{ $item->pertanyaan }}</td>
                        <td>
                            @if (Storage::exists($item->nilai))
                            <img src="{{ asset('storage/'.$item->nilai) }}" class="img-fluid w-100" alt="">
                            @else
                            {{ $item->nilai }}
                            @endif
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            @else
            <h1 class="h4">Hasil Score</h1>
            @foreach ($subkategori as $item)
            <p>{{ $item->nama.': '.$totalpersub[$item->id]['total'] }}</p>
            @endforeach
            <h1 class="h5 fw-semibold">Total Score: {{ $total }}</h1>
            <p class="fw-semibold">Interpretasi: {{ $hasil }}</p>
            @endif

        </div>
    </div>

    @if ($kategori->id == 2)
    <div class="text-center mt-3">
        <button class="btn btn-primary text-center" id="download-canvas">Simpan Hasil</button>
    </div>
    @else
    <div class="text-center mt-3">
        <button class="btn btn-primary text-center" id="download-canvas">Simpan Hasil</button>
    </div>
    @endif


</div>

@push('scripts')
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js" type="text/javascript"></script>

<script>
    document.getElementById('download-canvas').onclick = function(){
            const screenshotTarget = document.getElementById('canvas');
            html2canvas(screenshotTarget).then((canvas)=>{
                const base64image = canvas.toDataURL('image/png');
                            var anchor = document.createElement('a');
                            anchor.setAttribute("href", base64image);
                            anchor.setAttribute('download', 'kuisioner.png');
                            anchor.click();
                            anchor.remove();
            })

        }

</script>

@endpush

@endsection
