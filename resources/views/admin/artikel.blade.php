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
                                Artikel
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="modal"
                                            data-target="#add">Tambah Artikel</a>
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
                                            <th>Gambar</th>
                                            <th>Deskripsi</th>
                                            <th>Kategori</th>
                                            <th>Penulis</th>
                                            <th>Tanggal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $item)

                                        <tr>
                                            <style>
                                                .text {
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    display: -webkit-box;
                                                    -webkit-line-clamp: 4;
                                                    /* number of lines to show */
                                                    -webkit-box-orient: vertical;
                                                }
                                            </style>
                                            <td class="text">{{ $item->title }}</td>
                                            <td><img src="{{ asset('storage/'.$item->gambar) }}" class="img-fluid"
                                                    width="50">
                                            </td>
                                            <td class="text">{!! $item->desc !!} </td>
                                            <td>{{ $item->kategori->nama }}</td>
                                            <td>{{ $item->penulis }}</td>
                                            <td>{{ $item->created_at->format('d M Y') }}</td>
                                            <td>

                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" href="#" data-toggle="modal"
                                                        data-target="#view{{ $item->id }}"
                                                        class="btn btn-success">View</button>
                                                    <button type="button" href="#" data-toggle="modal"
                                                        data-target="#edit{{ $item->id }}" class="btn btn-warning"
                                                        onclick="ckbuild({{ $item->id }})">Edit</button>
                                                    <button type="button" href="#" data-toggle="modal"
                                                        data-target="#delete{{ $item->id }}"
                                                        class="btn btn-danger">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- modal view --}}
                                        <div class="modal fade" id="view{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="view{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="view{{ $item->id }}Label">
                                                            View Artikel
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <img class="pr-2"
                                                                src="{{ asset('storage/'.$item->kategori->gambar) }}"
                                                                width="80" alt="">
                                                            <h1 class="m-0 pl-1 display-4 font-weight-bold">
                                                                {{$item->title}}
                                                            </h1>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-4">
                                                            <p class="m-0 h6 font-weight-bold">{{
                                                                $item->created_at->format('d M Y') }}</p>
                                                            <div class="divider-berita">
                                                                <p class="m-0 font-weight-bold mx-3">.</p>
                                                            </div>
                                                            <p class="m-0 h6 font-weight-bold">Penulis : {{
                                                                $item->penulis }}</p>
                                                            </p>
                                                        </div>
                                                        <div class="py-3">
                                                            {!! $item->desc !!}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- modal delete --}}
                                        <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="delete{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete{{ $item->id }}Label">
                                                            Hapus Berita
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.artikel.destroy') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Apakah anda ingin menghapus artikel
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
                                                            Edit Artikel
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.artikel.update') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Judul</label>
                                                                    <input type="text" name="id" value="{{ $item->id }}"
                                                                        hidden>
                                                                    <input value="{{ $item->title }}" required
                                                                        type="text" name="title" class="form-control"
                                                                        placeholder="Judul">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="desc">Deskripsi</label>
                                                                    <textarea name="desc" required
                                                                        class="my-editoredit{{ $item->id }} form-control"
                                                                        id="my-editoredit{{ $item->id }}" cols="30"
                                                                        rows="10">
                                                                        {!! $item->desc !!}
                                                                    </textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputFile">Gambar</label>
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
                                                                        class="img-fluid w-25 mt-3 d-block"
                                                                        id="img-preview{{ $item->id }}">
                                                                    @else
                                                                    <img class="img-fluid w-25  mt-3"
                                                                        id="img-preview{{ $item->id }}">
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Kategori</label>
                                                                    <select name="kategoris_id" required
                                                                        class="form-control">
                                                                        <option value="" disabled selected>Kategori
                                                                        </option>
                                                                        @foreach ($kategori as $k)
                                                                        <option {{ $k->id==$item->kategori->id ?
                                                                            'selected' : '' }}
                                                                            value="{{ $k->id }}">{{ $k->nama }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Penulis</label>
                                                                    <input value="{{ $item->penulis }}" required
                                                                        type="text" name="penulis" class="form-control"
                                                                        placeholder="Penulis">
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
                    Tambah Artikel
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul</label>
                            <input value="" required type="text" name="title" class="form-control" placeholder="Judul">
                        </div>
                        <div class="form-group">
                            <label for="desc">Deskripsi</label>
                            <textarea name="desc" required class="my-editorar2 form-control" id="my-editorar2" cols="30"
                                rows="10">
                    </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" required name="gambar" class="custom-file-input"
                                        onchange="previewImage('add')" id="gambaradd">
                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                        file</label>
                                </div>
                            </div>
                            <img class="img-fluid w-25  mt-3" id="img-previewadd">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategoris_id" required class="form-control">
                                <option value="" disabled selected>Kategori</option>
                                @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Penulis</label>
                            <input value="" required type="text" name="penulis" class="form-control"
                                placeholder="Penulis">
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
    function ckbuild(params) {
        console.log(params);
        }
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
            "scrollX": true
        }
    );

    } );
</script>
<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
    var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
  };
</script>
<script>
    // CKEDITOR.replace('my-editoredit', options);
    function ckbuild(params) {
        console.log(params);
    CKEDITOR.replace('my-editoredit'+params, options);
    }
    CKEDITOR.replace('my-editorar2', options);
</script>
@endpush
<!-- /.content-wrapper -->
@endsection
