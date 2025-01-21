<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add Whatsapp Contact</h4>
    </div>

    <div class="card-body">
        <form action="{{ url('company-profile/whatsapp/store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="basicInput">Nama Kontak</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name') }}" required id="basicInput"
                               placeholder="Nama Kontak">
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Kontak</label>
                        <input type="text" name="contact" class="form-control"
                               value="{{ old('contact') }}" required id="basicInput"
                               placeholder="Nomor Telepon">
                        <small class="text-muted">Contoh Format : 6288334748709.</small>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="basicInput">Deskripsi</label>
                        <textarea style="height: 250px" name="description" class="form-control" id="basicInput" placeholder="Deskripsi">{{ old('description') }}</textarea>
                        <small class="text-muted">Please provide a detailed description (minimum 2 lines).</small>
                    </div>
                </div>


                {{--                <div class="col-md-6">--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="formFile" class="form-label">Profile Contact</label>--}}
{{--                        <input name="image" class="form-control" type="file" id="formFile" accept="image/*">--}}
{{--                    </div>--}}

{{--                    <img src="https://i.stack.imgur.com/y9DpT.jpg" id="imgPreview"--}}
{{--                         class="rounded-circle" style="width: 200px; height:200px; object-fit: cover" alt="Responsive image">--}}
{{--                </div>--}}

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
