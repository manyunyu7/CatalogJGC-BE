@extends('template')

@section('page-heading')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Data</h3>
                    <p class="text-subtitle text-muted">Gunakan Menu ini untuk mengatur data klien di profile</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Company Profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Client</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-content')
    <section class="section">
        @include('components.message')
    </section>

    @push('script')
        <script>
            var el = document.getElementById('formFile');
            el.onchange = function() {
                var fileReader = new FileReader();
                fileReader.readAsDataURL(document.getElementById("formFile").files[0])
                fileReader.onload = function(oFREvent) {
                    document.getElementById("imgPreview").src = oFREvent.target.result;
                };
            }


            $(document).ready(function() {
                $.myfunction = function() {
                    $("#previewName").text($("#inputTitle").val());
                    var title = $.trim($("#inputTitle").val())
                    if (title == "") {
                        $("#previewName").text("Judul")
                    }
                };

                $("#inputTitle").keyup(function() {
                    $.myfunction();
                });

            });
        </script>
    @endpush

    <section class="section">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Klien</h4>
            </div>

            <div class="card-body">
                <form action="{{ url('company-profile/client/update') }}" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Judul Utama</label>
                                <input type="text" name="title" required class="form-control"
                                       value="{{ old('title',$data->title) }}" required id="basicInput"
                                       placeholder="Title">
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Deskripsi</label>
                                <textarea style="height: 200px" name="description" class="form-control" id="basicInput" placeholder="Deskripsi">{{ old('description',$data->description) }}</textarea>
                                <small class="text-muted">Please provide a detailed description (minimum 2 lines).</small>
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Action</label>
                                <input type="text" name="action"  class="form-control"
                                       value="{{ old('action',$data->action) }}"
                                       placeholder="Action">
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Link</label>
                                <input type="text" name="action_link" class="form-control"
                                       value="{{ old('action_link',$data->action_link) }}"
                                       placeholder="Action Link">
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Urutan</label>
                                <input type="number" name="order" class="form-control"
                                       value="{{ old('order',$data->order) }}"
                                       placeholder="Urutan">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="formFile" class="form-label">Background Photo</label>
                                <input name="image" class="form-control" type="file" id="formFile" accept="image/*">
                            </div>

                            <img src='{{asset("$data->image")}}' style="border-radius: 20px" id="imgPreview" class="img-fluid" alt="Responsive image">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Add Data</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </section>

    <!-- Modal -->
    <div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel120">
                        Anda Yaking Ingin Menghapus Data Karyawan Ini ?
                    </h5>
                    <button type="button" class="close hide-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data Karyawan terkait akan dihapus.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary hide-modal" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class=" d-sm-block">Close</span>
                    </button>

                    <a class="btn-destroy" href="">
                        <button type="button" class="btn btn-danger ml-1 hide-modal " data-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class=" d-sm-block">Hapus Karyawan</span>
                        </button>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection
