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
                            <h4 style="color: #fff; font-size: x-large; font-family: 'Anton', sans-serif; padding-bottom: 2rem" class="text-center">FIRST TEAM <b id="countTeam1"></b></h4>
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
                        <option value="null">-Sélectionner-</option>
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
                <div id="top-bar-compo">
                    <div style="display: flex">
                        <span style="padding-left: 3px; color: #cccccc; font-family: Oswald, sans-serif; text-transform: uppercase">Dispositif <b style="font-size: small" id="bold-compo"></b></span>
                    </div>
                    <div>
                        <button class="btn btn-outline-warning" id="backSelectPlayers">
                            Retour aux choix des joueurs
                        </button>
                        <button id="validate-composition" class="btn btn-outline-primary" id="backSelectPlayers">
                            VALIDER LA COMPO
                        </button>
                    </div>
                    <div id="icon-soccer-field" data-toggle="modal" data-target="#exampleModal" style="display: flex;justify-content: flex-end; padding-right: 1rem;" class="col-md-12">
                        <div style="border: 2px solid #ccc; padding: .2rem;" class="pull-right">
                            <img style="width: 30px" src="{{ asset('images/icon_soccer_field.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
        <div id="line-attaque">
           <!-- <div class="card-fut-mobile mr-5">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x
                        <span class="position-player-field">
                            AG
                        </span>
                    </div>
                    <div class="wrapper-img-player">
                        <img src="{ asset("images/boulaye-photo.png") }}" alt="  playerName  ">
                    </div>
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                </div>
            </div>
            <div class="link-player" style=></div>
            <div class="card-fut-mobile">
                <div class="display-players">
                    <div id="note-player">77</div>
                    <div id="delete-team_">x
                        <span class="position-player-field">
                            BU
                        </span>
                    </div>
                    <div class="wrapper-img-player">
                        <img src="{ asset("images/nadir-photo.png") }}" alt="  playerName  ">
                    </div>
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                </div>
            </div>-->
        </div>
        <div class="" id="line-middle">
                <!--<div class="card-fut-mobile margin-top-less-4">
                    <div class="display-players">
                        <div id="note-player">91</div>
                        <div id="delete-team_">x
                            <span class="position-player-field">
                            MG
                        </span>
                        </div>
                        <div class="wrapper-img-player">
                            <img src="{ asset("images/bruno.png") }}" alt="  playerName  ">
                        </div>
                        <div  class="infos-position-player">
                        </div>
                        <div class="infos-capacities-right"></div>
                    </div>
                </div>
                <div class="card-fut-mobile mar-top-2">
                    <div class="display-players">
                        <div id="note-player">92</div>
                        <div id="delete-team_">x
                            <span class="position-player-field">
                            MDC
                        </span>
                        </div>
                        <div class="wrapper-img-player">
                            <img src="{ asset("images/sofk.png") }}" alt="  playerName  ">
                        </div>
                        <div  class="infos-position-player">
                        </div>
                        <div class="infos-capacities-right"></div>
                    </div>
                </div>
                <div class="card-fut-mobile mar-top-2">
                    <div class="display-players">
                        <div id="note-player">81</div>
                        <div id="delete-team_">x
                            <span class="position-player-field">
                            MDC
                        </span>
                        </div>
                        <div class="wrapper-img-player">
                            <img src="{ asset("images/sertan-photo.png") }}" alt="  playerName  ">
                        </div>
                        <div  class="infos-position-player">
                        </div>
                        <div class="infos-capacities-right"></div>
                    </div>
                </div>
                <div id="test-swap" class="card-fut-mobile margin-top-less-4">
                    <div class="display-players">
                        <div id="note-player">80</div>
                        <div id="delete-team_">x
                            <span class="position-player-field">
                            MD
                        </span>
                        </div>
                        <div class="wrapper-img-player">
                            <img src="{ asset("images/flo.png") }}" alt="  playerName  ">
                        </div>
                        <div  class="infos-position-player">
                        </div>
                        <div class="infos-capacities-right"></div>
                    </div>
                </div>
                <div class="link-player-att-middle-right"></div>-->
            </div>
        <div  id="line-defense">
            <!--<div id="def_1" class="card-fut-mobile">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                </div>
            </div>
            <div id="def_2" class="card-fut-mobile mar-top-2">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                </div>
            </div>
            <div id="def_3" class="card-fut-mobile mar-top-2">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                </div>
            </div>
            <div id="def_4" class="card-fut-mobile">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                </div>
            </div>-->
        </div>
        <div id="line-goal-keeper">
           <!-- <div class="card-fut-mobile">
                <div class="display-players">
                    <div id="note-player">80</div>
                    <div id="delete-team_">x</div>
                    <div class="wrapper-img-player">
                        <img src="{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                    </div>
                    <div  class="infos-position-player">
                    </div>
                    <div class="infos-capacities-right"></div>
                </div>
            </div>-->
        </div>
        <div id="container-bottom" style="">
            <div style="" id="bottom-bar-display-team-left">
            <h4 id="title-substitute">remplaçant(s)</h4>
                <div id="line-remplacant">
                     <!--<div id="remp_1" class="card-fut-mobile">
                        <div class="display-players">
                            <div id="note-player">80</div>
                            <div id="delete-team_">x</div>
                            <div class="wrapper-img-player">
                                <img src="{ asset("images/silhouette-ldc-yellow.png") }}" alt="  playerName  ">
                            </div>
                            <div  class="infos-position-player">
                            </div>
                            <div class="infos-capacities-right"></div>
                        </div>
                    </div>-->
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
            const lineDefense = $('#line-defense');
            const lineGoal = $('#line-goal-keeper');
            const wrapperComposition = $('#wrapper-composition');
            const selectorfirstCardMiddleLeft = $('div#line-middle div.card-fut-mobile:nth-child(1)');
            const selectorfirstCardAttaqueLeft = $('div#line-attaque div.card-fut-mobile:nth-child(1)');
            const choicePlayerTeam = $('#choice-player-team');
            const lineRemplacant = $('#line-remplacant');
            const containerBottom = $('#container-bottom');

            /*
            * Mesure la distance entre deux div card-fut

            setTimeout(() => {
                console.warn('MESSURE 2', $('div#line-attaque div.card-fut-mobile:nth-child(3)')[0].offsetLeft);
                const adjacent  = selectorfirstCardMiddleLeft[0].offsetTop - selectorfirstCardAttaqueLeft[0].offsetTop;
                const oppose = selectorfirstCardAttaqueLeft[0].offsetLeft - selectorfirstCardMiddleLeft[0].offsetLeft;
                const oposeCarre = oppose * oppose;
                const adjacentCarre = adjacent * adjacent;
                const widthLink = (Math.round(Math.sqrt(oposeCarre + adjacentCarre)) - 5);

                $('.link-player-att-middle').css('width', widthLink + 'px');
                function calcAngleDegrees(x, y) {
                    return Math.round(((Math.atan2(y, x) * 180 / Math.PI) * 2) - 10);
                }
                $(`<style>.link-player-att-middle:after {transform: rotateZ(${calcAngleDegrees(oppose, adjacent)}deg) }</style>`).appendTo('.link-player-att-middle');
            }, .001 );*/



            function hideLink() {
                $('div[class*=link-player]').fadeOut();
            }

            const compoBase = '4-4-2';
            $('#bold-compo').text(compoBase);
            $('#compo').change(function () {
                const compo = $('#compo').val();
                if(compo !== 'null') {
                    switch (compo) {
                        case '4-3-3':
                            hideLink();
                            changeCompo(compo);
                            break;
                        case '4-4-2':
                            hideLink();
                            changeCompo(compo);
                            break
                    }
                }
            });

            function changeCompo(compo) {
                if(compo === '4-3-3') {
                    const nbLineMiddle = lineMiddle.children('.card-fut-mobile').length;
                    const elemAdd = $('div#line-middle div.card-fut-mobile:nth-child(2)');
                    if(nbLineMiddle === 4) {
                        $('#bold-compo').text(compo);
                        elemAdd.appendTo('#line-attaque');
                        $('#line-attaque .card-fut-mobile:nth-child(1)').addClass(marTop2);
                    }
                } else if (compo === '4-4-2') {
                    const nbPlayerLineAttaque = lineAttaque.children('.card-fut-mobile').length;
                    if(nbPlayerLineAttaque === 3) {
                        $('#bold-compo').text(compo);
                        const elemDownLine = $('div#line-attaque div.card-fut-mobile:nth-child(3)');
                        elemDownLine.insertAfter(selectorfirstCardMiddleLeft);
                        $('#line-middle div.card-fut-mobile:nth-child(2)').addClass(marTop2);
                    }
                }
            }


            let heightBase = 0;
            let heightContainerCard = 0;

            function initDraggable() {
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
                        const itemCurrent = event.item;
                        const swapItem = event.swapItem;
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
                            toggleRem(containerBottom, true);
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
            }
            function toggleRem(elem, drag) {
                const heightContainerBottom = $('#bottom-bar-display-team-left').outerHeight();
                const titleSub = $('#title-substitute');
                const heightH4Title = titleSub.outerHeight(true);
                const padHeightTitle = titleSub.offset().top;
                if(drag === true){
                    const t = heightContainerCard + 'px';
                    if(elem[0].style.bottom === t ) {
                        elem.animate({
                            bottom: '0px',
                            height: heightBase,
                        }, 1);
                    }
                } else if (drag === 'up' ){
                    elem.animate({
                        bottom: heightContainerBottom,
                    }, 1);
                } else if (drag === 'init') {
                    setTimeout(() => {
                        const heightContainerBottom = document.getElementById('bottom-bar-display-team-left').offsetHeight;
                        const titleSub = $('#title-substitute');
                        const heightH4Title = titleSub.outerHeight(true);
                        const padHeightTitle = titleSub.outerHeight(true);
                        heightContainerCard = heightContainerBottom;
                        heightBase = padHeightTitle + 8;
                        const h = heightH4Title + 7;
                        elem.animate({
                            height: padHeightTitle + 8,
                            bottom: 0
                        });

                        setTimeout(() => {
                            initDraggable();
                        }, 200);
                    }, 2000);
                } else {
                    if(elem[0].style.bottom === '0px' || elem[0].style.bottom === 0 ) {
                        elem.animate({
                            bottom: heightContainerBottom,
                            height: '0px'
                        }, 1);
                    }else{
                        elem.animate({
                            height: heightBase,
                            bottom: '0px'
                        }, 200);
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
            containerBottom.on('click', function () {
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
            let countTeamPlayer1 = 0;
            const countTeam1 = $('#countTeam1');
            $(document).on('click', 'li[class^="idPlayer_"]', function () {
                const id = $(this).attr('class').split('_')[1];
                let playerName = $(`#player-name_${id}`).text().trim();
                if(playerName.length > 3){
                    playerName = playerName.substring(0, 3);
                }
                const postePlayer = $(`#poste_player_${id}`).text().trim();
                const notePlayer =  $(`#note_player_${id}`).text().trim();
                const displayerPlayer = $('.display-players-selected');
                const displayerPlayerTeam2 = $('.display-players-selected_2');
                let photo = $(`#photo_${id}`).val().trim();
                let renderPhoto = "{{ asset('images/:image') }}";
                if(photo === '' || /.png|.jpg|.jpeg|.pdf|.gif/i.test(photo)){
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
                    '</div>' +
                    '<div class="infos-capacities-right"></div>' +
                    '<div class="divider-yellow"></div>' +
                    '</div>';
                const team = {
                    playerid: id,
                    notePlayer: notePlayer,
                    photoPath: renderPhoto,
                    playerName: playerName,
                    postePlayer: postePlayer
                };
                if(firstPlaceTeam.is(':visible')){
                    playersTeam['team1'].push(team);
                    countTeamPlayer1++;
                    countTeam1.empty().html(`( ${countTeamPlayer1} )`);
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


            function generatorCard(
                marginClass,
                notePlayer,
                positionPlayer,
                photoPath,
                playerName
            ) {
                return `
                <div class="card-fut-mobile ${marginClass}">
                    <div class="display-players">
                        <div id="note-player">${notePlayer}</div>
                        <div id="delete-team_">x
                            <span class="position-player-field">
                                ${positionPlayer}
                            </span>
                        </div>
                        <div class="wrapper-img-player">
                            <img src="${photoPath}" alt="${playerName}">
                        </div>
                        <div  class="infos-position-player">
                        </div>
                        <div class="infos-capacities-right"></div>
                    </div>
                </div>`;
            }


            $(document).on('click', 'div[id^="delete-team_"]', function () {
                $(this).parent().fadeOut();
                const id = $(this).attr('id').split('_')[1];
                $(`.idPlayer_${id}`).show(400);
                if(firstPlaceTeam.is(':visible')){
                   countTeamPlayer1--;
                   countTeam1.empty().append(`( ${countTeamPlayer1} )`);
                   playersTeam.team1 = playersTeam.team1.filter((elem) => {
                       return parseInt(elem.playerid) !== parseInt(id);
                   });
                }else{
                    playersTeam.team2 = playersTeam.team2.filter((elem) => {
                        return parseInt(elem.playerid) !== parseInt(id);
                    });
                }

            });

            $(document).on('click', '#backSelectPlayers', function () {
                wrapperComposition.fadeOut(600);
                choicePlayerTeam.fadeIn();

            });

            $(document).on('click', '#validate-teams', function () {
                // todo check if is ok
                $('#choice-player-team').hide();
                //$('#wrapper-composition').show();
                if(playersTeam.team1.length < 1 || playersTeam.team2.length < 1){
                    alert("ERROR TEAM NUMBER");
                }else{

                    console.warn({playerTeam: playersTeam.team1});
                    // todo attention aux categorie
                    if(playersTeam.team1.length >= 11) {
                        const arrPlayer = playersTeam.team1;
                        lineAttaque.empty();
                        lineMiddle.empty();
                        lineDefense.empty();
                        lineGoal.empty();
                        // compo 11
                        const firstAttPlayer = generatorCard(
                            'mr-5',
                            arrPlayer[0].notePlayer,
                            arrPlayer[0].postePlayer,
                            arrPlayer[0].photoPath,
                            arrPlayer[0].playerName,
                        );
                        const secondAttPlayer = generatorCard(
                            '',
                            arrPlayer[1].notePlayer,
                            arrPlayer[1].postePlayer,
                            arrPlayer[1].photoPath,
                            arrPlayer[1].playerName,
                        );
                        // const linkAttPlayer = `<div class="link-player" style=></div>`;
                        lineAttaque.append(
                            firstAttPlayer +
                          //  linkAttPlayer +
                            secondAttPlayer
                        );

                        const firstMidPlayer = generatorCard(
                            'margin-top-less-4',
                            arrPlayer[2].notePlayer,
                            arrPlayer[2].postePlayer,
                            arrPlayer[2].photoPath,
                            arrPlayer[2].playerName,
                        );
                        const secondMidPlayer = generatorCard(
                            'margin-top-2',
                            arrPlayer[3].notePlayer,
                            arrPlayer[3].postePlayer,
                            arrPlayer[3].photoPath,
                            arrPlayer[3].playerName,
                        );
                        const thirdMidPlayer = generatorCard(
                            'margin-top-2',
                            arrPlayer[4].notePlayer,
                            arrPlayer[4].postePlayer,
                            arrPlayer[4].photoPath,
                            arrPlayer[4].playerName,
                        );
                        const fourthMidPlayer = generatorCard(
                            'margin-top-less-4',
                            arrPlayer[5].notePlayer,
                            arrPlayer[5].postePlayer,
                            arrPlayer[5].photoPath,
                            arrPlayer[5].playerName,
                        );
                        const linkMidRight = `<div class="link-player-att-middle-right"></div>`;

                        lineMiddle.append(
                            [firstMidPlayer,
                            secondMidPlayer,
                            thirdMidPlayer,
                            fourthMidPlayer]
                           // linkMidRight]
                        );

                        const firstDefPlayer = generatorCard(
                            'margin-top-less-4',
                            arrPlayer[6].notePlayer,
                            arrPlayer[6].postePlayer,
                            arrPlayer[6].photoPath,
                            arrPlayer[6].playerName,
                        );
                        const secondDefPlayer = generatorCard(
                            'margin-top-2',
                            arrPlayer[7].notePlayer,
                            arrPlayer[7].postePlayer,
                            arrPlayer[7].photoPath,
                            arrPlayer[7].playerName,
                        );
                        const thirdDefPlayer = generatorCard(
                            'margin-top-2',
                            arrPlayer[8].notePlayer,
                            arrPlayer[8].postePlayer,
                            arrPlayer[8].photoPath,
                            arrPlayer[8].playerName,
                        );
                        const fourthDefPlayer = generatorCard(
                            'margin-top-less-4',
                            arrPlayer[9].notePlayer,
                            arrPlayer[9].postePlayer,
                            arrPlayer[9].photoPath,
                            arrPlayer[9].playerName,
                        );


                        lineDefense.append(
                            [firstDefPlayer,
                            secondDefPlayer,
                            thirdDefPlayer,
                            fourthDefPlayer]
                        );

                        const goalPlayer = generatorCard(
                            '',
                            arrPlayer[10].notePlayer,
                            arrPlayer[10].postePlayer,
                            arrPlayer[10].photoPath,
                            arrPlayer[10].playerName,
                        );

                        lineGoal.append(goalPlayer);
                        if(typeof arrPlayer[11] !== "undefined") {

                           const substituePlayers = arrPlayer.splice(11, arrPlayer.length);
                           let players = '';
                            for (let i = 0; i < substituePlayers.length; i++) {
                                players += generatorCard(
                                    '',
                                    substituePlayers[i].notePlayer,
                                    substituePlayers[i].postePlayer,
                                    substituePlayers[i].photoPath,
                                    substituePlayers[i].playerName,
                                )
                            }
                            lineRemplacant.empty().append(players);
                            // containerBottom.css('bottom', toggleRem(containerBottom, 'init'));
                            toggleRem(containerBottom, 'init');
                            containerBottom.show();
                        } else {
                          containerBottom.hide();
                        }

                        setTimeout(() => {
                            wrapperComposition.show();
                        }, 10);


                    }

                    // u10&u11 u12&u13
                    if(playersTeam.length >= 8 &&  playersTeam.length <= 10) {
                        // compo 11
                    }


                    // u6&u7 u8&u9
                    if(playersTeam.length > 3 && playersTeam.length <= 7) {

                    }
                    console.log(playersTeam);


                }
            });


            $(document).on('click', '#validate-composition', function () {
                //todo manque la date du match
                $.ajax({
                    url: "{{ route('store.match') }}",
                    data: {players: playersTeam},
                    type:'POST',
                    dataType: 'json'
                })
                .done( (data) => {
                    let pathMatch = '{{ route('show.match', ':id') }}';
                    pathMatch = pathMatch.replace(':id', data.idMatch);
                    window.location.assign(pathMatch);
                });
            });
        });
    </script>
@endsection