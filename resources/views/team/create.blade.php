@extends('layouts.app')

@section('content')
    <div class="container-fluid wallpaper-foot">
        <div class="row">
            <div class="col-md-12">
                <h1 style="color: #4c83e6; font-family: Anton, sans-serif;" class="text-center">{{ session('groupName') }}</h1>
            </div>
        </div>
        @if(!empty($categories))
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="selectCat">Catégorie</label>
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="">
                         <select class="form-control" name="" id="selectCat">
                             <option value="null">-Sélectionner une catégorie-</option>
                             @foreach($categories as $category)
                                 <option value="{{ $category->id }}">{{ $category->name }}</option>
                             @endforeach
                         </select>
                     </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="selectCoach">Coach</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <select class="form-control" name="" id="selectCoach">
                        <option value="null">-Sélectionner un coach-</option>
                        @foreach($coachs as $coach)
                            <option value="{{ $coach->user_id }}">{{ $coach->name }}</option>
                        @endforeach
                    </select>
                    <div id="error-coach">
                    </div>
                </div>
            </div>
        </div>
        <form action="">
            <div class="row">
                <div class="col-md-2">
                    <label for="teamName">Nom de l'équipe</label>
                </div>
                <div class="col-md-6">
                    <input class="form-control" id="teamName" type="text" placeholder="Nom de l'équipe">
                </div>
                <div class="error-team">
                </div>
            </div>
        </form>
         <div class="row">
             <div style="text-align: center" id="error-players" class="col-md-12">
             </div>
         </div>
        <div style="margin-top: 1rem; background-color: #79797924" class="area-select-players">
            <div style="padding-top: 1rem; padding-bottom:  1rem" class="row">
                <div  class="col-6 col-md-6">
                    <h4 class="text-center">JOUEURS DISPONIBLES</h4>
                </div>
                <div class="col-6 col-md-6">
                    <h4 class="text-center">JOUEURS Sélectionnés</h4>
                </div>
            </div>
            <div style="display: flex; justify-content: space-evenly" class="switch-list">
                <div style="background: white;padding: 1rem;display: flex;justify-content: space-evenly;flex-wrap: wrap;height: 300px;overflow-y: auto;margin-bottom: 2rem;" id="area-players-availble" class="col-6 col-md-5">
                    @foreach($players as $player)
                        @include('components.mini-card', ['showAge' => true])
                    @endforeach
                </div>
                <div style="justify-self: center" class="col-md-1">
                </div>
                <div style="background: white;padding: 1rem;display: flex;justify-content: space-evenly;flex-wrap: wrap;height: 300px;overflow-y: auto;margin-bottom: 2rem;" id="players-selected-area" class=" col-6 col-md-5">
                </div>
            </div>
        </div>
        <div style="display: flex; justify-content: space-around" >
            <div class="">
                <button class="btn btn-primary" type="button" id="saveGoManageTeam">
                    ENREGISTRER ET PASSER A LA GESTION D'EQUIPE
                </button>
            </div>
            <div>
                <button class="btn btn-success" type="button" id="saveGoDashBoard">
                    ENREGISTRER ET RETOUR AU TABLEAU DE BORD
                </button>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function(){
            let playersSelected = [];
            $(document).on('click', '.display-players', function () {
                const playerSelected = $(this).parent();
                //playerSelected.fadeOut(400);
                const playerIdSelected = $(this).attr('id').split('_')[1];
                const areaPlayerSelected = $('#players-selected-area');
                if(playersSelected.indexOf(playerIdSelected) === -1) {
                    areaPlayerSelected.append(playerSelected);
                     playersSelected = [...playersSelected, playerIdSelected];
                     console.warn({add: playersSelected});
                     //playerSelected.fadeIn(400);
                }
            });
            $(document).on('click', 'div[id^="delete-team_"]', function (e) {
                e.stopPropagation();
                const playerSelected = $(this).parent().parent();
                const playerIdSelected = $(this).parent().attr('id').split('_')[1];
               $('div#area-players-availble').append(playerSelected);
                playersSelected = playersSelected.filter((elem) => { return playerIdSelected !== elem });
            });

            function showAllPlayersAvailable(){
                $('div[class="card-fut-mobile"]').each(function (elem) {
                    if($(this).is(':hidden')) {
                        $(this).fadeIn(2000);
                    }
                })
            }
            $(document).on('change', '#selectCoach', function () {
               const choiceCoach = $(this).val();
               showAllPlayersAvailable();
               console.log(choiceCoach);
               if(choiceCoach !== null || choiceCoach !== 'null') {
                   $('#error-coach').empty();
                   $('#selectCoach').css('border-color', 'green');
                   $(`#player_${choiceCoach}`).parent().fadeOut(200);
               }
            });



            function checkInfo(goTo){
                const cat = $('#selectCat').val().trim();
                const selectorCoach = $('#selectCoach');
                const selectorErrorCoach =  $('#error-coach');
                const coach = selectorCoach.val().trim();

                if(coach === '' || coach === null || coach === 'null') {
                    selectorCoach.css('border-color', 'red');
                    selectorErrorCoach.empty().append('<p class="error">Coach obligatoire</p>');
                    return false;
                }

                const selectorTeamName = $('#teamName');
                const teamName = selectorTeamName.val().trim();
                const selectorErrorTeam =  $('#error-team');



                if(teamName === '' || teamName === null || teamName === 'null') {
                    selectorTeamName.css('border-color', 'red');
                    selectorErrorTeam.empty().append('<p class="error">Nom d\'équipe obligatoire</p>');
                    return false;
                }

                if(playersSelected.length < 2){
                    $('#error-players').empty().append('<p class="error">Pas de joueur sélectionné dans l\'équipe</p>');
                    return false;
                }

                let data = {
                    coachUserId: coach,
                    groupId: "{{ session('groupId') }}",
                    catId: cat,
                    playersSelected: playersSelected.toString(),
                    teamName: teamName,
                };
                $.ajax({
                    url: '{{ route('store.team') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (data) {
                        if(data.ok){
                            if(goTo === 'manageTeam'){
                                window.location.href = '{{ route('home') }}'
                            } else {
                                window.location.href = '{{ route('home') }}'
                            }
                        }
                    }
                })


            }

            $(document).on('click', '#saveGoManageTeam', function (e) {
                //players selected
                checkInfo('manageTeam');

            });
            $(document).on('click', '#saveGoDashBoard', function (e) {
                checkInfo('dashBoard');
            });

            });
    </script>
@endsection