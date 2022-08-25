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
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="modal"
                                            data-target="#add">Tambah {{ $title }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <table id="myTable" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Kategori</th>
                                            <th>Jawaban</th>
                                            <th>Nilai Min</th>
                                            <th>Nilai Min</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $item)

                                        <tr>
                                            <td>{{ $item->kategori->nama }}</td>
                                            <td>{{ $item->jawaban }}</td>
                                            <td>{{ $item->min_jawaban }}</td>
                                            <td>{{ $item->max_jawaban }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    {{-- <button type="button" href="#" data-toggle="modal"
                                                        data-target="#view{{ $item->id }}"
                                                        class="btn btn-success">View</button> --}}
                                                    <button type="button" href="#" data-toggle="modal"
                                                        data-target="#edit{{ $item->id }}" class="btn btn-warning"
                                                        onclick="ckbuild({{ $item->id }})">Edit</button>
                                                    <button type="button" href="#" data-toggle="modal"
                                                        data-target="#delete{{ $item->id }}"
                                                        class="btn btn-danger">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- modal delete --}}
                                        <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="delete{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete{{ $item->id }}Label">
                                                            Hapus {{ $title }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.hasil.kategori.destroy') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Apakah anda ingin menghapus Jawaban
                                                                        ini?</label>
                                                                    <input type="text" name="id" value="{{ $item->id }}"
                                                                        hidden>
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
                                        {{-- modal edit --}}
                                        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="edit{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit{{ $item->id }}Label">
                                                            Edit {{ $title }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.hasil.kategori.update') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Kategori</label>
                                                                    <select name="kategori_id" id=""
                                                                        class="form-control" required>
                                                                        @foreach ($kategori as $item2)
                                                                        <option value="{{ $item2->id }}" {{ $item->
                                                                            kategori_id == $item2->id ? 'selected' : ''
                                                                            }}>
                                                                            {{ $item2->nama }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Jawaban</label>
                                                                    <input type="text" name="id" value="{{ $item->id }}"
                                                                        hidden>
                                                                    <input value="{{ $item->jawaban }}" required
                                                                        type="text" name="jawaban" class="form-control"
                                                                        placeholder="Jawaban">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nilai Min</label>
                                                                    <input value="{{ $item->min_jawaban }}" required
                                                                        type="number" name="min_jawaban"
                                                                        class="form-control" placeholder="Nilai Min">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nilai Max</label>
                                                                    <input value="{{ $item->max_jawaban }}" required
                                                                        type="number" name="max_jawaban"
                                                                        class="form-control" placeholder="Nilai Max">
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
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">
                    Tambah {{ $title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.hasil.kategori.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori_id" id="" class="form-control" required>
                                @foreach ($kategori as $item2)
                                <option value="{{ $item2->id }}">
                                    {{ $item2->nama }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label>Jawaban</label>
                            <input value="" required type="text" name="jawaban" class="form-control"
                                placeholder="Jawaban">
                        </div>
                        <div class="form-group">
                            <label>Nilai Min</label>
                            <input value="" required type="number" name="min_jawaban" class="form-control"
                                placeholder="Nilai Min">
                        </div>
                        <div class="form-group">
                            <label>Nilai Max</label>
                            <input value="" required type="number" name="max_jawaban" class="form-control"
                                placeholder="Nilai Max">
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
