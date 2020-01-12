@extends('layouts.app')

@section('content')
<div class="container-fluid bg-dark-fut">
    <h2 class="text-center">Organisé un match</h2>
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    <div class="tab-content" id="pills-tabContent">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="text-center"></h4>
                    <div class="form-group">
                        <input type="text" id="find-player" class="form-control" placeholder="chercher ">
                    </div>
                    <ul style="list-style: none">
                        @if(!$players->isEmpty())
                            @foreach($players as $player)
                                <li style="cursor: pointer" class="idPlayer_{{$player->id}}">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div id="player-name_{{$player->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $player->name }}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $player->surname }}</div>
                                                    <input type="hidden" id="playerId" value="{{ $player->id }}" >
                                                    <input type="hidden" id="note_{{ $player->id }}" value="{{ $player->rating_before_update }}" >
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                    <h5 style="text-transform: uppercase;" class="text-center"><button  id="validate-teams" class="btn btn-success">VALIDER LES TEAM</button></h5>
                    <div class="tab-team-switch">
                        <div class="first-select"><h6>FIRST TEAM</h6></div>
                        <div class="second-select"><h6>SECOND TEAM</h6></div>
                    </div>
                    <div id="first-team">
                        <div id="first-team-place" class="display-players-selected">
                            <h4 class="text-center">FIRST TEAM</h4>
                        </div>
                    </div>
                    <div id="second-team">
                        <div id="second-team-place" class="display-players-selected_2">
                            <h4 class="text-center">SECOND TEAM</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            const secondPlaceTeam = $('#second-team');
            secondPlaceTeam.hide();
            let playersTeam= {
                team1 :[],
                team2 :[]
            };
            const firstSelect = $('.first-select');
            const secondSelect = $('.second-select');
            const firstPlaceTeam = $('#first-team');
            $(document).on('click', 'li[class^="idPlayer_"]', function () {
                const id = $(this).attr('class').split('_')[1];
                let playerName = $(`#player-name_${id}`).text().trim();
                if(playerName.length > 5){
                    playerName = playerName.substring(0, 5);
                }
                console.log(playersTeam);
                const notePlayer = $(`#note_${id}`).val();
                const displayerPlayer = $('.display-players-selected');
                const displayerPlayerTeam2 = $('.display-players-selected_2');
                const cardHtml =
                    '<div class="display-players">' +
                      '<div id="note-player">92</div>'+
                        '<div id="delete-team_' + id + '">x</div>' +
                    '<img src="{{ asset('images/halifa-2.png') }}" alt="' + playerName + '">' +
                    '<div style="margin-top: 9.2rem;' +
                    'text-transform: uppercase;' +
                    'color: black;' +
                    'margin-left: .5rem;' +
                    'font-weight: bold;" class="infos-players-card-fut">'+ playerName +'</div>'+
                    '<div  class="infos-position-player">' +
                    '<span>MILIEU</span>' +
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

                if(playersTeam.team1.length < 1 || playersTeam.team2.length < 1){
                    console.log("ERROR TEAM NUMBER");
                }else{
                    console.log(playersTeam);
                    //todo manque la date du match
                    $.ajax({
                        url: "{{ route('store.match') }}",
                        data: {players: playersTeam},
                        type:'POST',
                        dataType: 'json'
                    })
                    .done( (data) => {
                        window.location.href = "{{ route('matchs.list')  }}"
                    });
                }
            });


           // $(document).on('click', '#pills-profile-tab', )
        });
    </script>
@endsection