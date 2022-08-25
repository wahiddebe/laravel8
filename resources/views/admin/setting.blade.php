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
                                Settings
                            </h3>
                            <div class="card-tools">
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <table id="myTable" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>No. Hp</th>
                                            <th>Link Instagram</th>
                                            <th>Link Youtube</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->no_hp }}</td>
                                            <td>{{ $data->instagram }}</td>
                                            <td>{{ $data->youtube }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" href="#" data-toggle="modal"
                                                        data-target="#editkategori{{ $data->id }}"
                                                        class="btn btn-warning">Edit</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editkategori{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editkategori{{ $data->id }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editkategori{{ $data->id }}Label">
                                                            Edit
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.setting.update') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="text" name="id" value="{{ $data->id }}" hidden>
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input value="{{ $data->email}}" required
                                                                        type="email" name="email" class="form-control"
                                                                        placeholder="Email">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>No. Hp</label>
                                                                    <input value="{{ $data->no_hp}}" required
                                                                        type="text" name="no_hp" class="form-control"
                                                                        placeholder="No. Hp">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Instagram</label>
                                                                    <input value="{{ $data->instagram}}" required
                                                                        type="text" name="instagram"
                                                                        class="form-control" placeholder="Instagram">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Youtube</label>
                                                                    <input value="{{ $data->youtube}}" required
                                                                        type="text" name="youtube" class="form-control"
                                                                        placeholder="Youtube">
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
