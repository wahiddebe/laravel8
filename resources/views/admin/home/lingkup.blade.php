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
                                Lingkup Kegiatan (Gambar & Judul)
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="modal"
                                            data-target="#edit">Edit</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <p class="text-primary">Judul</p>
                                <h1 class="mb-5">{{ $data->judul }}</h1>
                                <p class="text-primary">Gambar</p>
                                <img src="{{ asset('storage/'.$data->gambar)}}" class="w-25 img-fluid mb-5"></img>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Lingkup Kegiatan (Point-point)
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#" data-toggle="modal"
                                            data-target="#tambahpoint">Tambah</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <table id="myTable" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Point-Point</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $array = json_decode($data->point);
                                        $no = 1;
                                        @endphp
                                        @foreach ($array as $item)
                                        @if ($item != '')

                                        <tr>
                                            <td>{{ $item }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" href="#" data-toggle="modal"
                                                        data-target="#editpoint{{ $no }}"
                                                        class="btn btn-warning">Edit</button>
                                                    <button type="button" href="#" data-toggle="modal"
                                                        data-target="#hapuspoint{{ $no }}"
                                                        class="btn btn-danger">Hapus</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editpoint{{ $no }}" tabindex="-1" role="dialog"
                                            aria-labelledby="editpoint{{ $no }}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editpoint{{ $no }}Label">Edit
                                                            Point</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.lingkup.update') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="text" name="id" value="{{ $item }}" hidden>
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Point</label>
                                                                    <input value="{{ $item }}" required type="text"
                                                                        name="point" class="form-control"
                                                                        placeholder="Point">
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="hapuspoint{{ $no }}" tabindex="-1" role="dialog"
                                            aria-labelledby="hapuspoint{{ $no }}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapuspoint{{ $no }}Label">Hapus
                                                            Point</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.lingkup.update') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="text" name="id" value="{{ $item }}" hidden>
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Apakah anda ingin menghapus point
                                                                        ini?</label>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @php
                                        $no++;
                                        @endphp
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
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.lingkup_gambar.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul</label>
                            <input value="{{ $data->judul }}" required type="text" name="judul" class="form-control"
                                placeholder="Judul">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gambar" class="custom-file-input" onchange="previewImage()"
                                        id="gambar">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            @if ($data->gambar)
                            <img src="{{ asset('storage/'.$data->gambar) }}" class="img-fluid img-preview mt-3 d-block">
                            @else
                            <img class="img-fluid img-preview mt-3">
                            @endif
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahpoint" tabindex="-1" role="dialog" aria-labelledby="tambahpointLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahpointLabel">Tambah Point-Point</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.lingkup.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Point</label>
                            <input value="" required type="text" name="point" class="form-control" placeholder="Point">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


@once
@push('scripts')
<script>
    function previewImage() {
            const image = document.querySelector('#gambar');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            };
            }
</script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
</script>
@endpush
@endonce
<!-- /.content-wrapper -->
@endsection
