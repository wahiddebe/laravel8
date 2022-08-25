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
                                <h1 class="mb-5">{{ $data->title_hero }}</h1>
                                <p class="text-primary">Deskripsi Hero</p>
                                <h4 class="mb-5">{!! $data->desc_hero !!}</h4>
                                <p class="text-primary">Gambar Hero</p>
                                <img class="mb-5 img-fluid w-25" src="{{ asset('storage/'.$data->gambar_hero) }}"
                                    alt="">
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Visi Misi
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="modal"
                                            data-target="#editvisimisi">Edit</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <p class="text-primary">Judul Visi</p>
                                <h1 class="mb-5">{{ $data->title_visi }}</h1>
                                <p class="text-primary">Deskripsi Visi</p>
                                <h4 class="mb-5">{{ $data->desc_visi }}</h4>
                                <p class="text-primary">Judul Misi</p>
                                <h1 class="mb-5">{{ $data->title_misi }}</h1>
                                <p class="text-primary">Deskripsi Misi</p>
                                <h4 class="mb-5">{!! $data->desc_misi !!}</h4>
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
                <form action="{{ route('admin.tentang-kami.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="id" hidden value="{{ $data->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Hero</label>
                            <input value="{{ $data->title_hero }}" required type="text" name="title_hero"
                                class="form-control" placeholder="Judul Hero">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Hero</label>
                            <textarea name="desc_hero" onkeyup='writeText(this)' required class="form-control"
                                placeholder="Deskripsi Hero" id="" cols="30"
                                rows="10">{!! $data->desc_hero !!}</textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Gambar Hero</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gambar_hero" class="custom-file-input"
                                        onchange="previewImage()" id="gambar">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            @if ($data->gambar_hero)
                            <img src="{{ asset('storage/'.$data->gambar_hero) }}"
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
<div class="modal fade" id="editvisimisi" tabindex="-1" role="dialog" aria-labelledby="editheroLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editheroLabel">Edit Visi Misi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.visimisi.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="id" hidden value="{{ $data->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Visi</label>
                            <input value="{{ $data->title_visi }}" required type="text" name="title_visi"
                                class="form-control" placeholder="Judul Visi">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Visi</label>
                            <textarea name="desc_visi" onkeyup='writeText(this)' required class="form-control"
                                placeholder="Deskripsi Visi" id="" cols="30"
                                rows="10">{!! $data->desc_visi !!}</textarea>

                        </div>
                        <div class="form-group">
                            <label>Judul Misi</label>
                            <input value="{{ $data->title_misi }}" required type="text" name="title_misi"
                                class="form-control" placeholder="Judul Misi">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Misi</label>
                            <textarea name="desc_misi" onkeyup='writeText(this)' required class="form-control"
                                placeholder="Deskripsi Misi" id="" cols="30"
                                rows="10">{!! $data->desc_misi !!}</textarea>

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
    let t = '';

    let writeText = (ele) => {
    t = ele.value;
    ele.value = t.replace(/\n\r?/g, '<br />');
    }
</script>
@endpush
@endonce
<!-- /.content-wrapper -->
@endsection
