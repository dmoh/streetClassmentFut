@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-dark-fut">
        <!-- TODO add class or id to this section -->
        <div class="container" style="padding-top: 2rem;color: white;">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">
                        Ajouter un joueur
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Photo (2 images au maximum et 3Mo pour chacune)</label>
                        <form method="post" action="{{ route('save-images') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                            @csrf
                            <div class="dz-message">
                                <div class="col-xs-8">
                                    <div class="message">
                                        <p>Dépose ta photo ou clique</p>
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
            <form action="{{ route('store.user') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @include('partials.form-group', [
                        'title' => 'Nom de l\'utilisateur',
                        'type' => 'text',
                        'name' => 'name',
                        'required' => true,
                    ])
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @include('partials.form-group', [
                        'title' => 'Mail',
                        'type' => 'email',
                        'name' => 'emailUser',
                        'required' => true,
                    ])
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <fieldset style=" font-size: xx-large; text-align: center; text-transform: uppercase; margin-bottom: 1rem; border: 1px solid #2d2d2d">
                            Capacités du joueur
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        @include('partials.form-group', [
                        'title' => 'VITESSE',
                        'type' => 'text',
                        'name' => 'vitesse',
                        'required' => true,
                    ])

                    </div>

                    <div class="col-md-6">
                        @include('partials.form-group', [
                        'title' => 'DRIBBLE',
                        'type' => 'text',
                        'name' => 'dribble',
                        'required' => true,
                    ])

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        @include('partials.form-group', [
                        'title' => 'TIR',
                        'type' => 'number',
                        'name' => 'tir',
                        'required' => true,
                    ])

                    </div>
                    <div class="col-md-6">
                        @include('partials.form-group', [
                        'title' => 'DEFENSE',
                        'type' => 'text',
                        'name' => 'defense',
                        'required' => true,
                    ])
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        @include('partials.form-group', [
                        'title' => 'PASSE',
                        'type' => 'text',
                        'name' => 'passe',
                        'required' => true,
                    ])

                    </div>
                    <div class="col-md-6">
                        @include('partials.form-group', [
                        'title' => 'PHYSIQUE',
                        'type' => 'text',
                        'name' => 'physique',
                        'required' => true,
                    ])
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @include('partials.form-group', [
                        'title' => 'NOTE GLOBALE',
                        'type' => 'text',
                        'name' => 'note_globale',
                        'required' => true,
                    ])
                    </div>
                </div>
                <div class="row" style="color: white;">
                    <div class="col">
                        <label for="position">POSTE</label>
                        <select class="form-control" name="position" id="position">
                            @foreach($postes->toArray() as $poste)
                                <option value="{{ $poste }}" >{{ $poste }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="skill">POINT FORT</label>
                        <select name="skill" class="form-control" id="skill" >
                            @foreach($skills->toArray() as $skill)
                                <option  value="{{ $skill }}">{{ $skill }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="strong_foot">PIEDS FORT</label>
                        <select name="strong_foot" class="form-control" id="strong_foot" >
                            @foreach($feet->toArray() as $foot)
                                <option  value="{{ strtolower($foot) }}" >{{ $foot }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div style="margin: 1rem" class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" name="legend" class="custom-control-input" id="customControlInline">
                    <label style="color: white" class="custom-control-label" for="customControlInline">C'est une légende ?</label>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit"  class="btn btn-success">ENREGISTRER</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- end Section  -->
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        Dropzone.options.myDropzone = {
            uploadMultiple: true,
            parallelUploads: 3,
            maxFilesize: 3,
            maxFiles: 3,
            dictMaxFilesExceeded : 'Vous ne pouvez charger que 3 photos',
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