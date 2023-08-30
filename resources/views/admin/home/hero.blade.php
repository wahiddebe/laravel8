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
                                Hero
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="modal"
                                            data-target="#edithero">Edit</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <p class="text-primary">Judul Hero</p>
                                <div class="mb-5">{!! $data->judul !!}</div>
                                <p class="text-primary">Deskripsi Hero</p>
                                <div class="mb-5">{!! $data->sub_judul !!}</div>
                                <p class="text-primary">Tahun Pengalaman</p>
                                <h6 class="mb-5">{{ $data->tahun }}</h6>
                                <p class="text-primary">Gambar Hero</p>
                                <img class="mb-5 img-fluid" src="{{ asset('storage/'.$data->gambar) }}" alt="">
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
<div class="modal fade" id="edithero" tabindex="-1" role="dialog" aria-labelledby="editheroLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editheroLabel">Edit Hero</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="id" hidden value="{{ $data->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Hero</label>
                            {{-- <input value="{{ $data->judul }}" required type="text" name="judul"
                                class="form-control" placeholder="Judul"> --}}
                            <textarea name="judul" required class="my-editor form-control" id="my-editor" cols="30"
                                rows="1">
                                                                {!! $data->judul !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Hero</label>
                            <textarea name="sub_judul" required class="my-editor2 form-control" id="my-editor2"
                                cols="30" rows="10">
                                {!! $data->sub_judul !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Tahun Pengalaman</label>
                            <input required type="number" value="{{ $data->tahun }}" name="tahun" class="form-control"
                                placeholder="Tahun Pengalaman">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Gambar Hero</label>
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
<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
    $('#edithero').modal({
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
    CKEDITOR.replace('my-editor2', options);
    CKEDITOR.replace('my-editor', options);
</script>
@endpush
@endonce
<!-- /.content-wrapper -->
@endsection
