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
                        <th width="50%">Pertanyaan</th>
                        <th width="50%">Nilai</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($hasilpil as $item)

                    <tr>
                        <td>{{ $item->pertanyaan }}</td>
                        <td>
                            @if (Storage::exists($item->nilai))
                            <img src="{{ asset('storage/'.$item->nilai) }}" class="img-fluid" width="250" alt="">
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

    <div class="text-center py-3">

        <div class="btn-group" role="group" aria-label="Basic example">
            <button class="btn btn-primary text-center" id="download-img-canvas">Simpan Hasil (Gambar)</button>
            <button class="btn btn-danger text-center" id="download-pdf-canvas">Simpan Hasil (Pdf)</button>
        </div>
    </div>



</div>

@push('scripts')
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
<script>
    document.getElementById('download-img-canvas').onclick = function(){
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
        document.getElementById('download-pdf-canvas').onclick = function(){
var divContents = $("#canvas").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>Kuisioner</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            setTimeout(function() {
            printWindow.print();
            printWindow.close();
            }, 250);



        }

</script>



@endpush

@endsection
