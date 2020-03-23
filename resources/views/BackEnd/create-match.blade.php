@extends('layouts.app')

@section('content')
<div id="choice-player-team" class="container-fluid bg-dark-fut">
    <h2 style="color: white; font-family: 'oswald', sans-serif" class="text-center">ORGANISER UN MATCH</h2>
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="row">
                <div class="col-md-4">
                    <h4 class="text-center"></h4>
                    <div>
                        <input type="text" id="find-player" class="form-control" >
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="toggleShowListPlayer">
                            <label class="custom-control-label" for="toggleShowListPlayer">Afficher la liste complète des joueurs</label>
                        </div>
                        <input type="text" id="find-player" class="form-control" placeholder="TROUVER UN JOUEUR ">
                    </div>
                    <ul id="list-player-group" style="padding: 0; list-style: none">
                        @if(!$players->isEmpty())
                            @foreach($players as $player)
                                <li style="cursor: pointer" class="idPlayer_{{$player->id}}">
                                    <div style="border-left: 0.25rem solid #f28701" class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div style="color: #eb5a09; font-size: x-large" id="player-name_{{$player->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $player->name }}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $player->surname }}</div>
                                                    <input type="hidden" id="playerId" value="{{ $player->id }}" >
                                                    <input type="hidden" id="note_{{ $player->id }}" value="{{ $player->rating_before_update }}" >
                                                    <input type="hidden" id="photo_{{ $player->id }}" value="{{ $player->filename }}" >
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        NOTE GLOBALE  <b id="note_player_{{$player->id}}">{{ $player->current_rating }}</b>
                                                    </div>
                                                    <div>
                                                        POSTE  <b id="poste_player_{{ $player->id }}">{{ $player->position }}</b>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    @if((int) $player->overall_average >= 5)
                                                        <i style="font-size: xx-large; color: green" class="fas fa-battery-three-quarters"></i>
                                                    @else
                                                        <i style="font-size: xx-large; color: red" class="fas fa-battery-quarter"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-8">
                    <h5 style="text-transform: uppercase;" class="text-center"><button   id="validate-teams" class="btn btn-success">VALIDER LES TEAM</button></h5>
                    <div class="tab-team-switch">
                        <div style="font-family: 'Anton', sans-serif; letter-spacing: 3px; margin-top: 8px;" class="first-select">
                            <h6 style="margin-block-start: 0; margin-block-end: 0;">FIRST TEAM</h6>
                        </div>
                        <div style="font-family: 'Anton', sans-serif; letter-spacing: 3px; margin-top: 8px;" class="second-select">
                            <h6 style="margin-block-start: 0; margin-block-end: 0;">SECOND TEAM</h6>
                        </div>
                    </div>
                    <div id="first-team">
                        <div id="first-team-place" class="display-players-selected">
                            <h4 style="color: #fff; font-size: x-large; font-family: 'Anton', sans-serif; padding-bottom: 2rem" class="text-center">FIRST TEAM</h4>
                        </div>
                    </div>
                    <div id="second-team">
                        <div id="second-team-place"  class="display-players-selected_2">
                            <h4 style="color: #fff; font-size: x-large; font-family: 'Anton', sans-serif; padding-bottom: 2rem" class="text-center">SECOND TEAM</h4>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<div id="wrapper-composition" class="container-fluid">
    <div class="stade">
        <div class="row">
            <div class="col-md-12">
                <h5>tzerfdsfsd</h5>
            </div>
        </div>
        <div id="container-bottom" style="display: flex; justify-content: space-between">
            <div style="" id="bottom-bar-display-team-left">
                <h4>dfgdg</h4>
            </div>
            <div style="" id="bottom-bar-display-team-right">
                <h4>dfgdg</h4>
            </div>
        </div>
    </div>
</div>
<div id="bottom-bar">
    <div style="border-right: 1px solid #ccc"><i class="fa fa-copy"></i></div>
    <div style="border-right: 1px solid #ccc"><i class="fa fa-copy"></i></div>
    <div style="border-right: 1px solid #ccc"><i class="fa fa-copy"></i></div>
    <div><i class="fa fa-copy"></i></div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/draggable.bundle.js"></script>

@section('script')
    <script type="text/javascript">
        $(function () {

            const validateTeam = $('#validate-teams');
            const isMobile =  (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));

            if(isMobile) {

            }

            const group = {groupId: "{{ session('groupId') }}", groupName: "{{ session('groupName') }}"};
            const secondPlaceTeam = $('#second-team');
            secondPlaceTeam.hide();
            let playersTeam= {
                team1 :[],
                team2 :[]
            };
            const firstSelect = $('.first-select');
            const secondSelect = $('.second-select');
            const firstPlaceTeam = $('#first-team');



            $(document).on('click', '#toggleShowListPlayer', function () {
                if($(this).is(':checked')){
                    $('li[class^="idPlayer_"]').fadeIn();
                } else {
                    $('li[class^="idPlayer_"]').fadeOut();
                }
            });
            $(document).on('keyup', '#find-player', function () {
               let name = $(this).val().trim();
               if(name.length > 0) {
                   name = name.substring(0, name.length);
                   // $('div[id^="player-name_"]').show();
                   $('li[class^="idPlayer_"]').each(function (elem) {
                       const idPlayer = $(this).attr('class').split('_')[1];
                       const nameToCompare = $(`div[id="player-name_${idPlayer}"]`).text().trim().substring(0, name.length);
                       const reg = new RegExp( '^' + nameToCompare + '(\\s*)', 'i');
                       console.warn(reg);
                       if(reg.test(name)){
                           $(`li[class="idPlayer_${idPlayer}"]`).fadeIn();
                       }else{
                           $(this).fadeOut();
                       }
                   });
               } else {
                   $('li[class^="idPlayer_"]').fadeOut();
               }
            });
            $(document).on('click', 'li[class^="idPlayer_"]', function () {
                const id = $(this).attr('class').split('_')[1];
                let playerName = $(`#player-name_${id}`).text().trim();
                if(playerName.length > 3){
                    playerName = playerName.substring(0, 3);
                }

                const postePlayer = $(`#poste_player_${id}`).text().trim();
                console.log(playersTeam);
                const notePlayer =  $(`#note_player_${id}`).text().trim();
                const displayerPlayer = $('.display-players-selected');
                const displayerPlayerTeam2 = $('.display-players-selected_2');
                let photo = $(`#photo_${id}`).val().trim();
                let renderPhoto = "{{ asset('images/:image') }}";
                if(photo === ''){
                    photo = 'silhouette-ldc-yellow.png';
                }
                renderPhoto = renderPhoto.replace(':image', photo);


                const cardHtml =
                    '<div class="display-players">' +
                      '<div id="note-player">'+ notePlayer +'</div>'+
                        '<div id="delete-team_' + id + '">x</div>' +
                        '<div class="wrapper-img-player">'+
                            '<img src="' + renderPhoto + '" alt="' + playerName + '">' +
                        '</div>'+
                    '<div class="infos-players-card-fut">'+ playerName +'</div>'+
                    '<div  class="infos-position-player">' +
                    '<span>'+ postePlayer +'</span>' +
                    /* '<span>'+notePlayer+' DEF</span>' +
                     '<span>'+notePlayer+' DEF</span>' + */
                    '</div>' +
                    '<div class="infos-capacities-right"></div>' +
                    '<div class="divider-yellow"></div>' +
                    '</div>';
                team = {playerid: id};

                if(firstPlaceTeam.is(':visible')){

                    playersTeam['team1'].push(team);
                    displayerPlayer.append(cardHtml);
                }else{
                    displayerPlayerTeam2.append(cardHtml);
                    playersTeam['team2'].push(team);

                }
                if(playersTeam.team1.length > 1 && playersTeam.team2.length > 1){
                }
                $(`.idPlayer_${id}`).hide(400);
            });

            firstSelect.addClass('active-section');

            firstSelect.click(function () {
                firstSelect.addClass('active-section');
                secondSelect.removeClass('active-section');
                secondPlaceTeam.fadeOut(400);
                firstPlaceTeam.show(400);
            });

            secondSelect.click(function () {
                firstSelect.removeClass('active-section');
                secondSelect.addClass('active-section');
                firstPlaceTeam.fadeOut(200);
                secondPlaceTeam.show(400);
            });


            $(document).on('click', 'div[id^="delete-team_"]', function () {
                $(this).parent().fadeOut();
                const id = $(this).attr('id').split('_')[1];
                $(`.idPlayer_${id}`).show(400);
                if(firstPlaceTeam.is(':visible')){
                   playersTeam.team1 = playersTeam.team1.filter((elem) => {
                       return parseInt(elem.playerid) !== parseInt(id);
                   });
                }else{
                    playersTeam.team2 = playersTeam.team2.filter((elem) => {
                        return parseInt(elem.playerid) !== parseInt(id);
                    });
                }

            });


            $(document).on('click', '#validate-teams', function () {
                // todo check if is ok
                $('#choice-player-team').hide();
                $('#wrapper-composition').show();
                if(playersTeam.team1.length < 1 || playersTeam.team2.length < 1){
                    console.log("ERROR TEAM NUMBER");
                }else{
                    console.log(playersTeam);

                    //todo manque la date du match
                    /*$.ajax({
                        data: {players: playersTeam},
                        type:'POST',
                        dataType: 'json'
                    })
                    .done( (data) => {
                        url = url.replace(':id', data.idMatch);
                        window.location.assign(url);
                    });*/
                }
            });


           // $(document).on('click', '#pills-profile-tab', )
        });
    </script>
@endsection