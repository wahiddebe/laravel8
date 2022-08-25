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
                                Yogasmarashop
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="modal"
                                            data-target="#add">Tambah Barang</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <table id="myTable" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Gambar</th>
                                            <th>Kegunaan</th>
                                            <th>Harga (Rp)</th>
                                            <th>Link Tokopedia</th>
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
                                            <td class="colprice">{{ $item->price }}</td>
                                            <td><a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a></td>
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
                                                            View Barang
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row g-5">
                                                                <div class="col-lg-3">
                                                                    <style>
                                                                        .shop-heading {
                                                                            width: 100%;
                                                                            background-image: url('/images/penerimaan\ 3.png');
                                                                            background-size: contain;
                                                                            background-repeat: no-repeat;
                                                                            background-position: center;
                                                                        }
                                                                    </style>
                                                                    <div
                                                                        class="shop-heading p-5 d-flex align-items-center mb-3">
                                                                        <img src="{{ asset('storage/'.$item->gambar) }}"
                                                                            class="border border-white border-4 radius-4 img-fluid mx-auto d-block"
                                                                            alt="">
                                                                    </div>
                                                                    <p class="mt-4 text-bn300">
                                                                        Harga per Item
                                                                    </p>
                                                                    <h1 class="fs-36 fw-medium mb-4 ">Rp. <span
                                                                            class="colprice">{{
                                                                            $item->price }}</span></h1>
                                                                    </h1>
                                                                    <div class="d-grid gap-2 mt-5">
                                                                        <a class="btn btn-success rounded-0 p-3"
                                                                            href="{{ $item->link }}" target="_blank">
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-center text-white">
                                                                                <img src="/images/arcticons_tokopedia.svg"
                                                                                    class="img-fluid mr-2" alt="">
                                                                                Beli di Tokopedia
                                                                            </div>
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <h1 class="fs-36 font-weight-bold">
                                                                        {{$item->title}}
                                                                    </h1>
                                                                    <div class="divider-modal w-100 mt-3 mb-4">
                                                                    </div>
                                                                    <p class="fs-18 font-weight-bold">Kegunaan :</p>
                                                                    <div class="">
                                                                        {!! $item->desc !!}
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                            Hapus Barang
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.shop.destroy') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Apakah anda ingin menghapus barang
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
                                                            Edit Barang
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.shop.update') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Nama</label>
                                                                    <input type="text" name="id" value="{{ $item->id }}"
                                                                        hidden>
                                                                    <input value="{{ $item->title }}" required
                                                                        type="text" name="title" class="form-control"
                                                                        placeholder="Nama">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="desc">Kegunaan</label>
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
                                                                    <label>Harga (Rp)</label>
                                                                    <input type="text" name="id" value="{{ $item->id }}"
                                                                        hidden>
                                                                    <input value="{{ $item->price }}" required
                                                                        type="number" name="price" id="price"
                                                                        class="form-control price"
                                                                        placeholder="Harga (Rp)">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Link Tokopedia</label>
                                                                    <input value="{{ $item->link }}" required
                                                                        type="text" name="link" class="form-control"
                                                                        placeholder="Link Tokopedia">
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
                    Tambah Berita
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.shop.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input value="" required type="text" name="title" class="form-control" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="desc">Kegunaan</label>
                            <textarea name="desc" required class="my-editor2 form-control" id="my-editor2" cols="30"
                                rows="10">

                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gambar" class="custom-file-input"
                                        onchange="previewImage('add')" id="gambaradd">
                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                        file</label>
                                </div>
                            </div>
                            <img class="img-fluid w-25  mt-3" id="img-previewadd">
                        </div>
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input value="" required type="number" name="price" id="price" class="form-control price"
                                placeholder="Harga (Rp)">
                        </div>
                        <div class="form-group">
                            <label>Link Tokopedia</label>
                            <input value="" required type="text" name="link" class="form-control"
                                placeholder="Link Tokopedia">
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
    function ckbuild(params) {
    console.log(params);
    CKEDITOR.replace('my-editoredit'+params, options);
    }
    CKEDITOR.replace('my-editor2', options);
</script>
<script>
    var harga = document.getElementsByClassName('price');
    console.log(harga);
    for(var i = 0; i < harga.length; i++) {
        if (harga[i].value != "" || harga[i].value != null) {
            harga[i].value = formatRupiah(harga[i].value,);
        }
    harga[i].addEventListener('keyup', function(e)
    {
    e.target.value = formatRupiah(this.value, );
    });
    }

    var colprice = document.getElementsByClassName('colprice');
    for(var i = 0; i < colprice.length; i++) {
        if (colprice[i] != null || colprice[i] != "") {
            colprice[i].innerHTML = formatRupiah(colprice[i].innerHTML, "Rp.");
        }

        }
    function formatRupiah(angka, prefix)
    {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
</script>
@endpush
<!-- /.content-wrapper -->
@endsection
