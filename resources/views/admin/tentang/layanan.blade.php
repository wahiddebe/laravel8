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
                                Title & Gambar
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="modal"
                                            data-target="#editlayanan">Edit</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <p class="text-primary">Judul Layanan</p>
                                <h1 class="mb-5">{{ $data->title_layanan }}</h1>
                                <p class="text-primary">Gambar Layanan</p>
                                <img class="mb-5 img-fluid w-25" src="{{ asset('storage/'.$data->gambar_layanan) }}"
                                    alt="">
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Point-Point Layanan
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="modal"
                                            data-target="#addpoint">Tambah Point Layanan</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <table id="myTable" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data1 as $item)

                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>{!! $item->desc !!} </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" href="#" data-toggle="modal"
                                                        data-target="#editpoint{{ $item->id }}"
                                                        onclick="ckbuild({{ $item->id }})"
                                                        class="btn btn-warning">Edit</button>
                                                    <button type="button" href="#" data-toggle="modal"
                                                        data-target="#deletepoint{{ $item->id }}"
                                                        class="btn btn-danger">Delete</button>
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
                                                        <form
                                                            action="{{ route('admin.tentang-kami.layanan.point.update') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="text" name="id" value="{{ $item->id }}" hidden>
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Judul Point</label>
                                                                    <input value="{{ $item->title }}" required
                                                                        type="text" name="title" class="form-control"
                                                                        placeholder="Judul Point">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Deskripsi Point</label>
                                                                    <textarea name="desc" required
                                                                        class="my-editoredit{{ $item->id }} form-control"
                                                                        id="my-editoredit{{ $item->id }}" cols="30"
                                                                        rows="10">
                                                                        {!! $item->desc !!}
                                                                    </textarea>
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
                                        <div class="modal fade" id="deletepoint{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editpoint{{ $item->id }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editpoint{{ $item->id }}Label">
                                                            Delete
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('admin.tentang-kami.layanan.point.delete') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="text" name="id" value="{{ $item->id }}" hidden>
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
<div class="modal fade" id="editlayanan" tabindex="-1" role="dialog" aria-labelledby="editheroLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editheroLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.tentang-kami.layanan.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="id" hidden value="{{ $data->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Layanan</label>
                            <input value="{{ $data->title_layanan }}" required type="text" name="title_layanan"
                                class="form-control" placeholder="Judul Hero">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Gambar Hero</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gambar_layanan" class="custom-file-input"
                                        onchange="previewImage()" id="gambar">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            @if ($data->gambar_layanan)
                            <img src="{{ asset('storage/'.$data->gambar_layanan) }}"
                                class="img-fluid img-preview mt-3 d-block">
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
<div class="modal fade" id="addpoint" tabindex="-1" role="dialog" aria-labelledby="editheroLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editheroLabel">Tambah Point</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.tentang-kami.layanan.point.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Point</label>
                            <input value="" required type="text" name="title" class="form-control"
                                placeholder="Judul Point">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Point</label>
                            <textarea name="desc" required class="my-editor2 form-control" id="my-editor2" cols="30"
                                rows="10">
                            </textarea>

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
<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
    $('#addpoint').modal({
focus: false,
show:false
})

$.fn.modal.Constructor.prototype.enforceFocus = function () {};
</script>
<script>
    var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',

  };

</script>
<script>
    function ckbuild(params) {
    console.log(params);
    CKEDITOR.replace('my-editoredit'+params, options);
    $('#editpoint'+params).modal({
    focus: false,
    show:false
    })
    }
    CKEDITOR.replace('my-editor2', options);
</script>
@endpush
@endonce
<!-- /.content-wrapper -->
@endsection
