<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add New Slider</h4>
    </div>

    <div class="card-body">
        <form action="{{ url('company-profile/slider/store') }}" enctype="multipart/form-data" method="post">
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
                        <label for="basicInput">Action 2</label>
                        <input type="text" name="second_action"  class="form-control"
                               value="{{ old('second_action') }}"
                               placeholder="Action">
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Link 2</label>
                        <input type="text" name="second_action_link" class="form-control"
                               value="{{ old('second_action_link') }}"
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
                        <label for="formIcon" class="form-label">Background</label>
                        <input name="image" class="form-control" type="file" id="formFile" accept="image/*">
                    </div>
                    <img src="https://i.stack.imgur.com/y9DpT.jpg" style="border-radius: 20px; max-width: 500px" id="imgPreview" class="img-fluid" alt="Responsive image">


                    <div class="form-group">
                        <label for="formFile" class="form-label">Icon</label>
                        <input name="icon" class="form-control" type="file" id="formIcon" accept="image/*">
                    </div>

                    <img src="https://i.stack.imgur.com/y9DpT.jpg" style="border-radius: 20px; max-width: 300px" id="iconPreview" class="img-fluid img-thumbnail"  alt="Responsive image">
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

        var ul = document.getElementById('formIcon');
        ul.onchange = function() {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(document.getElementById("formIcon").files[0])
            fileReader.onload = function(oFREvent) {
                document.getElementById("iconPreview").src = oFREvent.target.result;
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
