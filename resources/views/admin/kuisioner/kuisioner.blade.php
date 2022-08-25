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
                                Kuisioner
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="modal"
                                            data-target="#add">Tambah Kuisioner</a>
                                    </li>
                                    <li class="nav-item">

                                    </li>
                                </ul>
                            </div>

                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <select name="kategori_id" id="selectsubmit" onchange="location = this.value;"
                                        class="form-control">
                                        @foreach ($kategoriall as $kat)
                                        <option value="/admin/kuisioner/show/{{ $kat->id }}" {{ $kat->id ==
                                            $kategori->id ?
                                            'selected' : '' }}>{{ $kat->nama }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="tab-content p-0">
                                <table id="myTable" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Pertanyaan</th>
                                            <th>Pilihan</th>
                                            <th>Kategori</th>
                                            <th>Sub Kategori</th>
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
                                            <td>{{ $item->pertanyaan }}</td>
                                            <td>
                                                <a href="/admin/kuisioner/pilihan/{{ $item->id }}"
                                                    class="btn btn-primary">Pilihan</a>
                                            </td>
                                            <td>{{ $item->kategori->nama }}</td>
                                            <td>{{ $item->subkategori->nama }}</td>
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
                                        {{-- modal view --}}
                                        {{-- <div class="modal fade" id="view{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="view{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="view{{ $item->id }}Label">
                                                            View Berita
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
                                        </div> --}}
                                        {{-- modal delete --}}
                                        <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="delete{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete{{ $item->id }}Label">
                                                            Hapus Kuisioner
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.kuisioner.destroy') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Apakah anda ingin menghapus Kuisioner
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
                                                            Edit Kuisioner
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.kuisioner.update') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Pertanyaan</label>
                                                                    <input type="text" name="id" value="{{ $item->id }}"
                                                                        hidden>
                                                                    <input value="{{ $item->pertanyaan }}" required
                                                                        type="text" name="pertanyaan"
                                                                        class="form-control" placeholder="Pertanyaan">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Kategori</label>
                                                                    <select name="kategori" readonly
                                                                        class="form-control" required>
                                                                        <option selected value="{{ $kategori->id }}">{{
                                                                            $kategori->nama }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Sub Kategori</label>
                                                                    <select name="subkategori" id=""
                                                                        class="form-control" {{ $subkategori!=null
                                                                        ?'required': '' }}>
                                                                        @foreach ($subkategori as $sub)
                                                                        <option value="{{ $sub->id }}" {{ $item->
                                                                            subkategori_id == $sub->id ? 'selected' : ''
                                                                            }}>
                                                                            {{ $sub->nama }}</option>
                                                                        @endforeach

                                                                    </select>
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
                    Tambah Kuisioner
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.kuisioner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pertanyaan</label>
                            <input value="" required type="text" name="pertanyaan" class="form-control"
                                placeholder="Pertanyaan">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" readonly class="form-control" required>
                                <option selected value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub Kategori</label>
                            <select name="subkategori" class="form-control" {{ $subkategori->isEmpty() ?'': 'required'
                                }}>
                                @foreach ($subkategori as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->nama }}</option>
                                @endforeach
                            </select>
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
<script>
    $('#selectsubmit').on('change', function(){
$(this).closest('form').submit();
});
</script>
@endpush
<!-- /.content-wrapper -->
@endsection
