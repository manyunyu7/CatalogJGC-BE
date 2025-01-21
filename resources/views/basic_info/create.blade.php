@push('script')
    <script src="{{ asset('library/ckeditor/ckeditor.js') }}"></script>
@endpush

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Company Basic Info</h4>
    </div>

    <div class="card-body">
        <form action="{{ url('company-profile/basic-info/store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="basicInput">Nama Perusahaan</label>
                        <input type="text" name="title"
                               class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               value="{{ old('title', $data->company_title ?? '') }}" id="basicInput"
                               placeholder="Title">
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Email</label>
                        <input type="text" name="email"
                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               value="{{ old('email', $data->main_email ?? '') }}"
                               placeholder="Alamat Email">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Kontak</label>
                        <input type="text" name="contact"
                               class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}"
                               value="{{ old('contact', $data->contact ?? '') }}"
                               placeholder="Kontak">
                        @if($errors->has('contact'))
                            <div class="invalid-feedback">
                                {{ $errors->first('contact') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Motto Perusahaan</label>
                        <textarea style="height: 200px" name="motto"
                                  class="form-control ckeditor {{ $errors->has('motto') ? 'is-invalid' : '' }}"
                                  placeholder="Deskripsi">{{ old('motto', $data->company_motto ?? '') }}</textarea>
                        @if($errors->has('motto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('motto') }}
                            </div>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="basicInput">Alamat Perusahaan</label>
                        <textarea style="height: 200px" name="address"
                                  class="form-control ckeditor {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                  placeholder="Address">{{ old('address', $data->main_address ?? '') }}</textarea>
                        @if($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Office Hour</label>
                        <textarea style="height: 200px" name="office_hour"
                                  class="form-control ckeditor {{ $errors->has('office_hour') ? 'is-invalid' : '' }}"
                                  placeholder="Office Hour">{{ old('office_hour', $data->office_hour ?? '') }}</textarea>
                        @if($errors->has('office_hour'))
                            <div class="invalid-feedback">
                                {{ $errors->first('office_hour') }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="basicInput">Deskripsi</label>
                        <textarea style="height: 200px" name="description"
                                  class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                  placeholder="Deskripsi">{{ old('description', $data->description ?? '') }}</textarea>
                        @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Visi</label>
                        <textarea style="height: 200px" name="visi"
                                  class="form-control ckeditor {{ $errors->has('visi') ? 'is-invalid' : '' }}"
                                  placeholder="Visi">{{ old('vision', $data->vision ?? '') }}</textarea>
                        @if($errors->has('visi'))
                            <div class="invalid-feedback">
                                {{ $errors->first('visi') }}
                            </div>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="basicInput">Misi</label>
                        <textarea style="height: 200px" name="misi"
                                  class="form-control ckeditor {{ $errors->has('misi') ? 'is-invalid' : '' }}"
                                  placeholder="Misi">{{ old('misi', $data->mission ?? '') }}</textarea>
                        @if($errors->has('misi'))
                            <div class="invalid-feedback">
                                {{ $errors->first('misi') }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Add Data</button>
                </div>
            </div>

        </form>

    </div>
</div>

@push('script')
    <script>
        var el = document.getElementById('formFile');
        el.onchange = function () {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(document.getElementById("formFile").files[0])
            fileReader.onload = function (oFREvent) {
                document.getElementById("imgPreview").src = oFREvent.target.result;
            };
        }


        $(document).ready(function () {
            $.myfunction = function () {
                $("#previewName").text($("#inputTitle").val());
                var title = $.trim($("#inputTitle").val())
                if (title == "") {
                    $("#previewName").text("Judul")
                }
            };

            $("#inputTitle").keyup(function () {
                $.myfunction();
            });

        });
    </script>
@endpush
