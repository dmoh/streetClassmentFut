@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="row col-md-12">
            <form method="POST" action="{{ route('photo.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group{{ $errors->has('photo') ? ' is-invalid' : '' }}">
                    <div class="custom-file">
                        <input type="file" id="photo" name="photo"
                               class="{{ $errors->has('photo') ? ' is-invalid ' : '' }}custom-file-input" required>
                        <label class="custom-file-label" for="photo"></label>
                        @if ($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                    </div>
                    <br>
                </div>
                @component('components.button')
                    @lang('Envoyer')
                @endcomponent
            </form>
        </div>
    </section>
@endsection