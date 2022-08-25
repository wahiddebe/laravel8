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
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0" style="overflow-x: scroll;">
                                {{-- modal edit --}}
                                <button type="button" href="#" data-toggle="modal" data-target="#edit{{ $data->id }}"
                                    class="btn btn-warning" onclick="ckbuild({{ $data->id }})">Edit</button>
                                {!! $data->deskripsi !!}
                                <div class="modal fade" id="edit{{ $data->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="edit{{ $data->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="edit{{ $data->id }}Label">
                                                    Edit {{ $title }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.informasi.update') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="deskripsi">Deskripsi</label>
                                                            <input type="text" name="id" value="{{ $data->id }}" hidden
                                                                id="">
                                                            <textarea name="deskripsi" required
                                                                class="my-editoredit{{ $data->id }} form-control"
                                                                id="my-editoredit{{ $data->id }}" cols="30" rows="10">
                                                                        {!! $data->deskripsi !!}
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
</script>
@endpush
<!-- /.content-wrapper -->
@endsection
