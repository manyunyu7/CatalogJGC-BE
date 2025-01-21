<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add New Brand</h4>
    </div>

    <div class="card-body">
        <form action="{{ url('company-profile/brand/store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="basicInput">Judul Utama</label>
                        <input type="text" name="title" required class="form-control"
                               value="{{ old('title') }}" required id="basicInput"
                               placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Deskripsi</label>
                        <textarea style="height: 200px" name="description" class="form-control" id="basicInput" placeholder="Deskripsi">{{ old('description') }}</textarea>
                        <small class="text-muted">Please provide a detailed description (minimum 2 lines).</small>
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Action</label>
                        <input type="text" name="action"  class="form-control"
                               value="{{ old('action') }}"
                               placeholder="Action">
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Link</label>
                        <input type="text" name="action_link" class="form-control"
                               value="{{ old('action_link') }}"
                               placeholder="Action Link">
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Urutan</label>
                        <input type="number" name="order" class="form-control"
                               value="{{ old('order') }}"
                               placeholder="Urutan">
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="formFile" class="form-label">Icon</label>
                        <input name="image" class="form-control" type="file" id="formFile" accept="image/*">
                    </div>

                    <img src="https://i.stack.imgur.com/y9DpT.jpg" style="border-radius: 20px;  max-height: 130px" id="imgPreview" class="img-fluid" alt="Responsive image">

                    <div class="form-group">
                        <label for="formFile" class="form-label">Poster</label>
                        <input name="poster" class="form-control" type="file" id="formFilePoster" accept="image/*">
                    </div>

                    <img src="https://i.stack.imgur.com/y9DpT.jpg" style="border-radius: 20px; max-height: 130px" id="imgPreviewPoster" class="img-fluid" alt="Responsive image">

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
        el.onchange = function() {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(document.getElementById("formFile").files[0])
            fileReader.onload = function(oFREvent) {
                document.getElementById("imgPreview").src = oFREvent.target.result;
            };
        }

        var ol = document.getElementById('formFilePoster');
        ol.onchange = function() {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(document.getElementById("formFilePoster").files[0])
            fileReader.onload = function(oFREvent) {
                document.getElementById("imgPreviewPoster").src = oFREvent.target.result;
            };
        }

    </script>
@endpush
