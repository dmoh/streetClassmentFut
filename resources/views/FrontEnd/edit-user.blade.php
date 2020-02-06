@extends('layouts.app')


@section('content')
    <div class="container-fluid bg-list-players">
        <div class="row">
            <div class="col-md-12">
                <h3 style="color: #fff; font-size: x-large; font-family: 'Oswald', sans-serif; padding: 2rem" class="text-center">EDITER CE PROFILE</h3>
            </div>
        </div>
        <div class="container">
            <form action="{{ route('update.user', ['id', $user->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="idUserUpdate" value="{{$user->id}}">
                <div class="row">
                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'Nom de l\'utilisateur',
                                'type' => 'text',
                                'value' => $user->name,
                                'name' => 'name',
                                'required' => true,
                            ])
                    </div>
                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'Email',
                                'type' => 'text',
                                'value' => $user->email,
                                'name' => 'email',
                                'required' => true,
                            ])
                    </div>
                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'Surnom',
                                'type' => 'text',
                                'value' => $user->surname,
                                'name' => 'surname',
                                'required' => true,
                            ])
                    </div>
                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'Age',
                                'type' => 'number',
                                'value' => $user->age,
                                'name' => 'age',
                                'required' => true,
                            ])
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">ENREGISTRER</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <hr>
                <div class="col">
                    <h4 style="color: #fff;padding: 1rem;font-family: Oswald, sans-serif;font-size: xx-large;text-transform: uppercase;" class="text-center"> CAPACITéS DU JOUEUR</h4>
                </div>
            </div>
            @include('BackEnd.dropzone')

            <form action="{{ route('update.stats') }}" id="formStatsPlayer" method="POST">
                @csrf
                <input type="hidden" name="idStatsPlayer" value="{{$statsPlayer->user_id}}">

                <div class="row">
                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'Note GLOBALE',
                                'type' => 'number',
                                'value' => $statsPlayer->current_rating,
                                'name' => 'current_rating',
                                'required' => true,
                            ])
                    </div>
                </div>
                <div class="row">

                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'Passes Décisives',
                                'type' => 'number',
                                'value' => $statsPlayer->assists,
                                'name' => 'assists',
                                'required' => true,
                            ])
                    </div>
                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'BUTS',
                                'type' => 'number',
                                'value' => $statsPlayer->goals,
                                'name' => 'goals',
                                'required' => true,
                            ])
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @if($photo !== null)
                            <input type="hidden" id="photoExist" name="photoExist" value="1">
                        @endif
                        @include('partials.form-group', [
                                'title' => 'VITESSE',
                                'type' => 'number',
                                'value' => $statsPlayer->pace,
                                'name' => 'pace',
                                'required' => true,
                            ])
                    </div>
                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'TIR',
                                'type' => 'number',
                                'value' => $statsPlayer->shoot,
                                'name' => 'shoot',
                                'required' => true,
                            ])
                    </div>
                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'PASSE',
                                'type' => 'number',
                                'value' => $statsPlayer->passe,
                                'name' => 'passe',
                                'required' => true,
                            ])
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'DRIBBLE',
                                'type' => 'number',
                                'value' => $statsPlayer->dribble,
                                'name' => 'dribble',
                                'required' => true,
                            ])
                    </div>
                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'DEFENSE',
                                'type' => 'number',
                                'value' => $statsPlayer->defense,
                                'name' => 'defense',
                                'required' => true,
                            ])
                    </div>
                    <div class="col">
                        @include('partials.form-group', [
                                'title' => 'PHYSIQUE',
                                'type' => 'number',
                                'value' => $statsPlayer->physique,
                                'name' => 'physique',
                                'required' => true,
                            ])
                    </div>
                </div>
                <div class="row" style="color: white;">
                    <div class="col">
                        <label for="position">POSTE</label>
                        <select class="form-control" name="position" id="position">
                            @foreach($postes->toArray() as $poste)
                                <option value="{{ $poste }}" {{$poste == $statsPlayer->position ? 'selected' : ''}}>{{ $poste }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="skill">POINT FORT</label>
                        <select name="skill" class="form-control" id="skill" >
                            @foreach($skills->toArray() as $skill)
                                <option  value="{{ $skill }}" {{$skill == $statsPlayer->skill ? 'selected' : ''}}>{{ $skill }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="strong_foot">PIEDS FORT</label>
                        <select name="strong_foot" class="form-control" id="strong_foot" >
                            @foreach($feet->toArray() as $foot)
                                <option  value="{{ strtolower($foot) }}" {{$foot == $statsPlayer->strong_foot ? 'selected' : ''}}>{{ $foot }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div style="margin: 1rem" class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" name="legend" @if($statsPlayer->legend == '1') checked @endif  class="custom-control-input" id="customControlInline">
                    <label style="color: white" class="custom-control-label" for="customControlInline">C'est une légende ?</label>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" id="saveStatsPlayer" class="btn btn-primary">ENREGISTRER</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        /*$(document).on('click', '#saveStatsPlayer', function () {
            const formStatsPlayer = $("#formStatsPlayer");
            const path = formStatsPlayer.attr('action');
            console.log(path);

            $.ajax({
                url: path,
                type: 'POST',
                data: formStatsPlayer.serialize(),
                dataType: 'json'
            });
        });*/
    </script>
@endsection