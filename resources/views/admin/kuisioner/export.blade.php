<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>
</head>

<body>
    <h5>Nama</h5>
    <p>{{ $data->nama }}</p>
    <h5>Jenis Kelamin</h5>
    <p>{{ $data->jenis_kelamin }}</p>
    <h5>Tanggal Lahir</h5>
    <p>{{ date('d-m-Y', strtotime($data->tgllahir)); }}</p>
    <h5>Usia</h5>
    <p>{{ $data->usia }}</p>
    <h5>Kuisioner</h5>
    <p>{{ $data->kategori->nama }}</p>
    <h5>Total Score</h5>
    <p>{{ $data->hasil }}</p>
    <h5>Interpretasi</h5>
    <p>{{ $data->hasil_kategori->jawaban ?? '' }}</p>
    <h5>Tanggal Pengisian</h5>
    <p>{{ $data->created_at->format('d M Y') }}</p>
    <table width="100%" border="2" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th>Pertanyaan</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @php
            use Illuminate\Support\Facades\Storage;
            @endphp
            @foreach ($data2 as $item)

            <tr>
                <td>{{ $item->pertanyaan }}</td>
                <td>
                    @if (Storage::exists($item->nilai))
                    <img src="{{ asset('storage/'.$item->nilai) }}" width="250" alt="">
                    @else
                    {{ $item->nilai }}
                    @endif
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</body>



<script>
    window.print();
</script>

</html>
