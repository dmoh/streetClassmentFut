<div class="row">
    @if($photo !== null)
        <div class="col-md-6">
            <h5>Photo actuelle</h5>
            <img style="max-height: 150px" src="{{ asset('images/'.$photo->filename) }}" alt="">
        </div>
    @endif
    <div class="col-md-6">
        <div class="form-group">
            <label>Photo (2 images au maximum et 3Mo pour chacune)</label>
            <form method="post" action="{{ route('save-images') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                @csrf
                <div class="dz-message">
                    <div class="col-xs-8">
                        <div class="message">
                            <p>Dépose ta photo ou clique </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div id="preview" style="display: none;">
            <div class="dz-preview dz-file-preview">
                <div class="dz-image"><img data-dz-thumbnail /></div>
                <div class="dz-details">
                    <div class="dz-size"><span data-dz-size></span></div>
                    <div class="dz-filename"><span data-dz-name></span></div>
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                <div class="dz-success-mark"></div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script type="text/javascript">
        Dropzone.options.myDropzone = {
            uploadMultiple: false,
            parallelUploads: 1,
            maxFilesize: 3,
            maxFiles: 1,
            dictMaxFilesExceeded : 'Vous ne pouvez charger qu\'une photo',
            previewTemplate: document.querySelector('#preview').innerHTML,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            dictInvalidFileType : 'Type de fichier interdit',
            dictRemoveFile: 'Supprimer',
            dictFileTooBig: 'L\'image fait plus de 3 Mo',
            timeout: 10000,
            init () {
                const myDropzone = this;
                $.get('{{ route('server-images') }}', data => {
                    $.each(data.images, (key, value) => {
                        const mockFile = {
                            name: value.original,
                            size: value.size,
                            dataURL: '{{ url('images') }}' + '/' + value.server
                        };
                        myDropzone.files.push(mockFile);
                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.createThumbnailFromUrl(mockFile,
                            myDropzone.options.thumbnailWidth,
                            myDropzone.options.thumbnailHeight,
                            myDropzone.options.thumbnailMethod, true, (thumbnail) => {
                                myDropzone.emit('thumbnail', mockFile, thumbnail);
                            });
                        myDropzone.emit('complete', mockFile);
                    });
                });
                this.on("removedfile", file => {
                    $.ajax({
                        method: 'delete',
                        url: '{{ route('destroy-images') }}',
                        data: { name: file.name, _token: $('[name="_token"]').val() }
                    });
                });
            }
        };

    </script>
@endsection