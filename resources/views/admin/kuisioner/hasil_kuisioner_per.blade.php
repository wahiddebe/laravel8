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
                                            <th>Pertanyaan</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        use Illuminate\Support\Facades\Storage;
                                        @endphp
                                        @foreach ($data as $item)

                                        <tr>
                                            <td>{{ $item->pertanyaan }}</td>
                                            <td>
                                                @if (Storage::exists($item->nilai))
                                                <img src="{{ asset('storage/'.$item->nilai) }}" class="img-fluid w-100"
                                                    alt="">
                                                @else
                                                {{ $item->nilai }}
                                                @endif
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
