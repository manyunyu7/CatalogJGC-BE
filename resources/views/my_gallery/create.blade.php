<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add New Gallery</h4>
    </div>

    <div class="card-body">
        <form action="{{ url('company-profile/gallery/store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="basicInput">Judul</label>
                        <input type="text" name="title" required class="form-control"
                               value="{{ old('title') }}" required id="basicInput"
                               placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Deskripsi</label>
                        <textarea style="height: 200px" name="description" class="form-control" id="basicInput" placeholder="Deskripsi">{{ old('description') }}</textarea>
                        <small class="text-muted">Please provide a detailed description (minimum 2 lines).</small>
                    </div>

                    <div class="form-group d-none">
                        <label for="basicInput">Type</label>
                        <select name="action" class="form-control">
                            <option value="photo" {{ old('action') == 'photo' ? 'selected' : '' }}>Photo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Tag</label>
                        <input type="text" name="tag" class="form-control"
                               value="{{ old('tag') }}"
                               placeholder="Tag">
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formFile" class="form-label">File</label>
                        <input name="media" class="form-control" type="file" id="formFile" accept="image/*, video/*">
                    </div>

                    <div id="mediaPreviewContainer" style="border-radius: 20px">
                        <img src="https://i.stack.imgur.com/y9DpT.jpg" style="border-radius: 20px" id="imgPreview" class="img-fluid" alt="Image Preview">
                        <video controls id="videoPreview" style="display: none;" class="img-fluid" alt="Video Preview"></video>
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
            fileReader.readAsDataURL(document.getElementById("formFile").files[0]);

            fileReader.onload = function (oFREvent) {
                var mediaPreviewContainer = document.getElementById("mediaPreviewContainer");
                var imgPreview = document.getElementById("imgPreview");
                var videoPreview = document.getElementById("videoPreview");

                if (el.files[0].type.includes("image")) {
                    imgPreview.src = oFREvent.target.result;
                    imgPreview.style.display = "block";
                    videoPreview.style.display = "none";
                } else if (el.files[0].type.includes("video")) {
                    videoPreview.src = oFREvent.target.result;
                    videoPreview.style.display = "block";
                    imgPreview.style.display = "none";
                }
            };
        }

        $(document).ready(function () {
            $.myfunction = function () {
                $("#previewName").text($("#inputTitle").val());
                var title = $.trim($("#inputTitle").val());
                if (title == "") {
                    $("#previewName").text("Judul");
                }
            };

            $("#inputTitle").keyup(function () {
                $.myfunction();
            });
        });
    </script>
@endpush
