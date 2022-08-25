@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
            @endif
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ $title }}
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <table id="myTable" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Usia</th>
                                            <th>Kuisioner</th>
                                            <th>Total Score</th>
                                            <th>Interpretasi</th>
                                            <th>Hasil Setiap Pertanyaan</th>
                                            <th>Tanggal Pengisian</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $item)

                                        <tr>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->jenis_kelamin }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->tgllahir)); }}</td>
                                            <td>{{ $item->usia }}</td>
                                            <td>{{ $item->kategori->nama }}</td>
                                            <td>{{ $item->hasil }}</td>
                                            <td>{{ $item->hasil_kategori->jawaban ?? '' }}</td>
                                            <td>{{ $item->created_at->format('d M Y') }}</td>
                                            <td>
                                                <a class="btn btn-primary"
                                                    href="/admin/kuisioner/hasil/kuisioner/show/{{ $item->id }}">Lihat</a>
                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@push('scripts')
<script>
    $(document).ready( function () {
    $('#myTable').DataTable(
        {
            "scrollX": true,
            responsive: true
        }
    );
    } );
</script>
@endpush
<!-- /.content-wrapper -->
@endsection
