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
                                Nilai Utama (Gambar & Judul)
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
                                <p class="text-primary">Gambar 1</p>
                                <img src="{{ asset('storage/'.$data->gambar1)}}" class="w-25 img-fluid mb-5"></img>
                                <p class="text-primary">Gambar 2</p>
                                <img src="{{ asset('storage/'.$data->gambar2)}}" class="w-25 img-fluid mb-5"></img>

                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Nilai Utama (Point-point)
                            </h3>
                            <div class="card-tools">
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <table id="myTable" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Icon</th>
                                            <th>Nilai</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($kategori as $item)

                                        <tr>
                                            <td><img src="{{ asset('storage/'.$item->gambar) }}" class="img-fluid"
                                                    width="20">
                                            </td>
                                            <td>{{ $item->nama }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" href="#" data-toggle="modal"
                                                        data-target="#editpoint{{ $item->id }}"
                                                        class="btn btn-warning">Edit</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editpoint{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editpoint{{ $item->id }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editpoint{{ $item->id }}Label">
                                                            Edit
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.nilai.update') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="text" name="id" value="{{ $item->id }}" hidden>
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Nilai</label>
                                                                    <input value="{{ $item->nama }}" required
                                                                        type="text" name="nama" class="form-control"
                                                                        placeholder="Nilai">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputFile">Icon</label>
                                                                    <div class="input-group">
                                                                        <div class="custom-file">
                                                                            <input type="file" name="gambar"
                                                                                class="custom-file-input"
                                                                                onchange="previewImage({{ $item->id }})"
                                                                                id="gambar{{ $item->id }}">
                                                                            <label class="custom-file-label"
                                                                                for="exampleInputFile">Choose
                                                                                file</label>
                                                                        </div>
                                                                    </div>
                                                                    @if ($item->gambar)
                                                                    <img src="{{ asset('storage/'.$item->gambar) }}"
                                                                        class="img-fluid mt-3 d-block"
                                                                        id="img-preview{{ $item->id }}">
                                                                    @else
                                                                    <img class="img-fluid  mt-3"
                                                                        id="img-preview{{ $item->id }}">
                                                                    @endif
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

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">
                    Edit
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.nilai_gambar.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="id" value="{{ $data->id }}" hidden>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul</label>
                            <input value="{{ $data->judul }}" required type="text" name="judul" class="form-control"
                                placeholder="Judul">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Gambar 1</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gambar1" class="custom-file-input"
                                        onchange="previewImage('g1')" id="gambarg1">
                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                        file</label>
                                </div>
                            </div>
                            @if ($data->gambar1)
                            <img src="{{ asset('storage/'.$data->gambar1) }}" class="img-fluid  mt-3 d-block"
                                id="img-previewg1">
                            @else
                            <img class="img-fluid  mt-3" id="img-previewg1">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Gambar 2</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gambar2" class="custom-file-input"
                                        onchange="previewImage('g2')" id="gambarg2">
                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                        file</label>
                                </div>
                            </div>
                            @if ($data->gambar2)
                            <img src="{{ asset('storage/'.$data->gambar2) }}" class="img-fluid  mt-3 d-block"
                                id="img-previewg2">
                            @else
                            <img class="img-fluid mt-3" id="img-previewg2">
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
@once
@push('scripts')
<script>
    console.log('ready');
    function previewImage(id) {
            var idn = "gambar"+id;
            var classn = "img-preview"+id;
            console.log(idn);
            console.log(classn);
            const image = document.querySelector('#'+idn);
            const imagePreview = document.querySelector('#'+classn);
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
