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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Composition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="compo">Composition</label>
                    <select class="form-control" name="compo" id="compo">
                        <option value="4-3-3">4-3-3</option>
                        <option value="4-4-2">4-4-2</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div id="wrapper-composition" class="container-fluid">
    <div id="stade">
        <div class="row">
            <div class="col-md-12">
                <h5>tzerfdsfsd</h5>
            </div>
        </div>
        <div class="row">
            <div id="icon-soccer-field" data-toggle="modal" data-target="#exampleModal" style="display: flex;justify-content: flex-end; padding-right: 1rem;" class="col-md-12">
                <div style="border: 2px solid #ccc; padding: .2rem;" class="pull-right">
                    <img style="width: 50px" src="{{ asset('images/icon_soccer_field.png') }}" alt="">
                </div>
            </div>
        </div>
        <div id="line-attaque">
            <div draggable="true" class="card-fut-mobile">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <!--<div class="infos-players-card-fut"> playerName </div>-->
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                    <div class="divider-yellow"></div>
                </div>
            </div>
            <div draggable="true" class="card-fut-mobile">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <!--<div class="infos-players-card-fut"> playerName </div>-->
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                    <div class="divider-yellow"></div>
                </div>
            </div>
        </div>
        <div id="line-middle">
            <div draggable="true" class="card-fut-mobile">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <!--<div class="infos-players-card-fut"> playerName </div>-->
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                    <div class="divider-yellow"></div>
                </div>
            </div>
            <div class="card-fut-mobile mar-top-2">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <!--<div class="infos-players-card-fut"> playerName </div>-->
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                    <div class="divider-yellow"></div>
                </div>
            </div>
            <div class="card-fut-mobile mar-top-2">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <!--<div class="infos-players-card-fut"> playerName </div>-->
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                    <div class="divider-yellow"></div>
                </div>
            </div>
            <div id="test-swap" class="card-fut-mobile">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <!--<div class="infos-players-card-fut"> playerName </div>-->
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                    <div class="divider-yellow"></div>
                </div>
            </div>
        </div>
        <div  id="line-defense">
            <div id="def_1" class="card-fut-mobile">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <!--<div class="infos-players-card-fut"> playerName </div>-->
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                    <div class="divider-yellow"></div>
                </div>
            </div>
            <div draggable="true" id="def_2" class="card-fut-mobile mar-top-2">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <!--<div class="infos-players-card-fut"> playerName </div>-->
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                    <div class="divider-yellow"></div>
                </div>
            </div>
            <div id="def_3" class="card-fut-mobile mar-top-2">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <!--<div class="infos-players-card-fut"> playerName </div>-->
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                    <div class="divider-yellow"></div>
                </div>
            </div>
            <div id="def_4" class="card-fut-mobile">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <!--<div class="infos-players-card-fut"> playerName </div>-->
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                    <div class="divider-yellow"></div>
                </div>
            </div>
        </div>
        <div id="line-goal-keeper">
            <div class="card-fut-mobile">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <!--<div class="infos-players-card-fut"> playerName </div>-->
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                    <div class="divider-yellow"></div>
                </div>
            </div>
        </div>
        <div id="container-bottom" style="">
            <div style="" id="bottom-bar-display-team-left">
            <h4>REMPLACANT(S)</h4>
                <div id="line-remplacant">
                     <div id="remp_1" class="card-fut-mobile">
                        <div class="display-players">
                            <div id="note-player">80</div>
                            <div id="delete-team_">x</div>
                            <div class="wrapper-img-player">
                                <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                            </div>
                            <!--<div class="infos-players-card-fut"> playerName </div>-->
                            <div  class="infos-position-player">
                            </div>
                            <div class="infos-capacities-right"></div>
                            <div class="divider-yellow"></div>
                        </div>
                    </div>
                </div>
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
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script type="text/javascript">
        $(function () {

            // Sortable.mount(swap());
            const classNameToTest = new RegExp('mar-top-2') ;
            const marTop2 = 'mar-top-2';
            const att = document.getElementById('line-attaque');
            const mid = document.getElementById('line-middle');
            const def = document.getElementById('line-defense');
            const rem = document.getElementById('line-remplacant');
            const goal = document.getElementById('line-goal-keeper');
            const lineMiddle = $('#line-middle');
            const lineAttaque = $('#line-attaque');

            $('#compo').change(function () {
                const compo = $('#compo').val();
                switch (compo) {
                    case '4-3-3':
                        changeCompo(compo);
                        break;
                    case '4-4-2':
                        changeCompo(compo);
                        break
                }
            });

            function changeCompo(compo) {
                if(compo === '4-3-3') {
                    const nbLineMiddle = lineMiddle.children('.card-fut-mobile').length;
                    const elemAdd = $('div#line-middle div.card-fut-mobile:nth-child(2)');
                    if(nbLineMiddle === 4) {
                        elemAdd.appendTo('#line-attaque');
                        $('#line-attaque .card-fut-mobile:nth-child(1)').addClass(marTop2);
                    }
                } else if (compo === '4-4-2') {
                    const nbPlayerLineAttaque = lineAttaque.children('.card-fut-mobile').length;
                    if(nbPlayerLineAttaque === 3) {
                        const elemDownLine = $('div#line-attaque div.card-fut-mobile:nth-child(2)');
                        elemDownLine.insertAfter($('div#line-middle div.card-fut-mobile:nth-child(1)'));
                        $('#line-middle div.card-fut-mobile:nth-child(2)').addClass(marTop2);
                    }
                }
            }

            const sortableAtt = Sortable.create(att, {
                group: {
                  name:'team',
                  swap: true,
                  swapClass: 'wrapper-card-fut'
                },
                animation: 300,
                ghostClass: 'blue-background-class',
                draggable: ".card-fut-mobile",
                swapThreshold: 1,
                swap: true,

            });
            const sortableMid = Sortable.create(mid, {
                group: {
                  name:'team',
                    swap: true,
                    swapClass: 'wrapper-card-fut'
                },
                animation: 300,
                ghostClass: 'blue-background-class',
                draggable: ".card-fut-mobile",
                swapThreshold: 1,
                swap: true,
                onEnd: function (event) {
                    const checkClass = event.clone.className;
                    console.warn({event: event});
                    console.log(checkClass);
                    if(!classNameToTest.test(checkClass) && classNameToTest.test(event.swapItem.className)) {
                        event.clone.classList.add('mar-top-2');
                    }
                }
            });
            const sortableDef = Sortable.create(def, {
                group: {
                  name:'team',
                    swap: true,
                    swapClass: 'wrapper-card-fut'
                },
                animation: 300,
                ghostClass: 'blue-background-class',
                draggable: ".card-fut-mobile",
                swapThreshold: 1,
                swap: true,
                onMove: function (event) {
                }
            });
            const sortableRem = Sortable.create(rem, {
                group: {
                  name:'team',
                    swap: true,
                    swapClass: 'wrapper-card-fut'
                },
                animation: 300,
                ghostClass: 'blue-background-class',
                draggable: ".card-fut-mobile",
                swapThreshold: 1,
                swap: true,
                onMove: function (event) {
                    if(event.from.id === 'line-remplacant') {
                        toggleRem($('#container-bottom'), true);
                    }
                },
                onEnd: function (event) {
                    const checkClass = event.item.className;
                    if(!classNameToTest.test(checkClass) && classNameToTest.test(event.swapItem.className)) {
                        event.item.classList.add('mar-top-2');
                    }
                }
            });

            const sortableGoal = Sortable.create(goal, {
                group: {
                    name:'team',
                    swap: true,
                    swapClass: 'wrapper-card-fut'
                },
                animation: 300,
                ghostClass: 'blue-background-class',
                draggable: ".card-fut-mobile",
                swapThreshold: 1,
                swap: true,
            });






            function toggleRem(elem, drag) {
                if(drag === true){
                    if(/180px/.test(elem[0].style.bottom)) {
                        const pr = new Promise(() => {
                            elem.animate({
                                bottom: '0',
                            }, 10);
                        });
                    }
                } else if ( drag === 'up' ){
                    elem.animate({
                        bottom: '180',
                    }, 1);
                }
                else{
                    if(/180px/.test(elem[0].style.bottom)) {
                        elem.animate({
                            bottom: '0',
                        }, 1);
                    }else{
                        elem.animate({
                            bottom: '180',
                        }, 1);
                    }
                }

            }


            /*const el = document.querySelector('.card-fut-mobile');

            el.addEventListener("touchstart", handleStart, false);
            /*el.addEventListener("touchend", handleEnd, false);
            el.addEventListener("touchcancel", handleCancel, false);
            el.addEventListener("touchleave", handleEnd, false);
            el.addEventListener("touchmove", handleMove, false);

            function handleStart(e) {
                // Handle the start of the touch
                this.style.opacity = '0.4';
                console.warn('JE BOUGe', e);
                this.style.opacity = '0.4';

                dragSrcEl = this;

               //  e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/html', this.innerHTML);
            }

            function handleMove(e) {
                // Handle the start of the touch
                this.style.opacity = '0.8';
                console.warn({thisMove: this});
                console.warn('jed fd fd', e);
                // e.dataTransfer.effectAllowed = 'move';
                // e.dataTransfer.setData('text/html', this.innerHTML);
            }


            function handleDragStart(e) {
                  // this / e.target is the source node.
            }

            var cols = document.querySelectorAll('#line-defense .card-fut-mobile');
            [].forEach.call(cols, function(col) {
                col.addEventListener('dragstart', handleDragStart, false);
                console.log(col);
            });*/


            $('#container-bottom').on('click', function () {
                toggleRem($(this));
            });
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