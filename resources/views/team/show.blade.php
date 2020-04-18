@extends('layouts.app')

@section('content')
    <section class="container-fluid">

        <div style='width:100%; display: grid; grid-template-areas: "header header header" "listPlayer listPlayer statsPlayer"' class="">
            <div style="grid-area: header; text-align: center" id="listPlayers">
                <h1 style="padding: 1rem; font-family: Anton, sans-serif; text-transform: uppercase">{{ $teamName[0]->name  }}</h1>
            </div>
            <div id="list-player-team" style="grid-area: listPlayer; display: flex; flex-direction: column">
                @foreach($players as $player)
                    <div class="rowTablePlayerTeam @if($loop->first) active-row-player @endif " style=" @if($loop->first) border-top: 1px solid #eaeaea; @endif">
                        <div id="infos">
                            <input type="hidden" class="position-player" value="{{$player->position}}">
                            <input type="hidden" class="current-rating-player" value="{{$player->current_rating}}">
                            <input type="hidden" class="skill-player" value="{{$player->skill}}">
                            <input type="hidden" class="strong-foot-player" value="{{$player->strong_foot}}">
                            <input type="hidden" class="actual-form-player" value="{{$player->overall_average}}">
                        </div>
                        @include('components.mini-card', ['noDeleteButton' => true,
                         'hideName' => true,
                         'showIconSkill' => true,
                         'dispositionTeam' => true,
                        ])
                        <div style="width: 100%;display: flex;flex-direction:column;padding: .5rem;" class="stats">
                            <div style=" font-size: x-large; font-family: oswald, sans-serif; padding-bottom: .1rem;" class="player-name">{{strtoupper($player->name)}}

                            </div>
                            <div style="display: flex" class="player-capacties-name">
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">VIT</div>
                                    <div class="pace-number-capacity" class="players-capacities-number">{{ $player->pace }}</div>
                                </div>
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">TIR</div>
                                    <div class="shoot-number-capacity" class="players-capacities-number">{{ $player->shoot }}</div>
                                </div>
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">PAS</div>
                                    <div class="passe-number-capacity" class="players-capacities-number">{{ $player->passe }}</div>
                                </div>
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">DRI</div>
                                    <div class="dribble-number-capacity" class="players-capacities-number">{{ $player->dribble }}</div>
                                </div>
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">DEF</div>
                                    <div class="defense-number-capacity" class="players-capacities-number">{{ $player->defense }}</div>
                                </div>
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">PHY</div>
                                    <div class="physique-number-capacity" class="players-capacities-number">{{ $player->physique }}</div>
                                </div>
                            </div>
                        </div>
                        <div style="justify-self: end; align-self: center; margin-right: 1rem;">
                            <span><i class="fa fa-chevron-right"></i></span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="grid-area: statsPlayer; display: flex; flex-direction: column" id="showplayer">
                @foreach($players as $player)
                    @if($loop->first)
                        @include('components.profil-card-hat', ['noMarginTop' => true, 'goldCard' => true ])
                        <div style="width: 100%;background-color: #8686866b;color: white;">
                            <div style="display: flex;flex-direction: column;align-self: center;justify-self: center;margin: 1rem;" class="poste-player-team">
                                <div style="padding: .2rem;  background: #a9a834;">
                                    <div class="row">
                                        <div style="text-align: center; font-size: x-large; font-family: oswald;" class="col-md-6">
                                            <div>POSTE</div>
                                        </div>
                                        <div style="text-align: center; font-size: x-large; font-family: oswald;" class="col-md-6">
                                            <div id="position-player-active">{{ strtoupper($player->position) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex;flex-direction: column;align-self: center;justify-self: center;margin: 1rem;" class="poste-player-team">
                                <div style="padding: .2rem;  background: #a9a834;">
                                    <div class="row">
                                        <div style="text-align: center; font-size: x-large; font-family: oswald;" class="col-md-6">
                                            <div>NOTE GLOBALE</div>
                                        </div>
                                        <div style="text-align: center; font-size: x-large; font-family: oswald;" class="col-md-6">
                                            <div id="current-rating-player-active">{{ strtoupper($player->current_rating)  }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex;flex-direction: column;align-self: center;justify-self: center;margin: 1rem;" class="poste-player-team">
                                <div style="padding: .2rem;  background: #a9a834;">
                                    <div class="row">
                                        <div style="text-align: center; font-size: x-large; font-family: oswald;" class="col-md-6">
                                            <div>POINT FORT</div>
                                        </div>
                                        <div style="text-align: center; font-size: x-large; font-family: oswald;" class="col-md-6">
                                            <div id="skill-player-active">{{ strtoupper($player->skill) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex;flex-direction: column;align-self: center;justify-self: center;margin: 1rem;" class="poste-player-team">
                                <div style="padding: .2rem;  background: #a9a834;">
                                    <div class="row">
                                        <div style="text-align: center; font-size: x-large; font-family: oswald;" class="col-md-6">
                                            <div>PIED FORT</div>
                                        </div>
                                        <div style="text-align: center; font-size: x-large; font-family: oswald;" class="col-md-6">
                                            <div id="strong-foot-player-active">{{ strtoupper($player->strong_foot) == 'RIGHT' ? 'DROIT' : 'GAUCHE'  }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex;flex-direction: column;align-self: center;justify-self: center;margin: 1rem;" class="poste-player-team">
                                <div style="padding: .2rem;  background: #a9a834;">
                                    <div class="row">
                                        <div style="text-align: center; font-size: x-large; font-family: oswald;" class="col-md-6">
                                            <div>FORME ACTUELLE</div>
                                        </div>
                                        <div style="text-align: center; font-size: x-large; font-family: oswald;" class="col-md-6">
                                            <div id="actual-form-player-active">
                                                <div style="margin-top: -0.3rem">
                                                    @if((int) $player->overall_average > 5)
                                                        <span><i class="fa fa-chevron-circle-up"></i></span>
                                                    @else
                                                        <span><i style="color: red" class="fa fa-chevron-circle-down"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <iframe src="https://hautesavoie-paysdegex.fff.fr/competitions/?id=363428&poule=1&phase=1&type=ch&tab=ranking#module-club" width="350px" height="600px" frameborder="0">
                </iframe>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function () {
            function showProfilPlayerSelected(){

            }
            $(document).on('click', '.rowTablePlayerTeam', function () {
               const rowSelected = $(this);
               const selectedShowPlayer = $(`#showplayer`);
               const infosPlayer = `div#infos`;
               const classElementSelected = $(this).attr('class');
               if(!/active-row-player/.test(classElementSelected)){
                   $(`#list-player-team`).find('div[class*="active-row-player"]')
                       .removeClass('active-row-player');
                   rowSelected.addClass('active-row-player');
                   const notePlayer = rowSelected.find('div#note-player').text();
                   $('#current-rating').empty().text(notePlayer);
                   const namePlayer = rowSelected.find('div.player-name').text();
                   $('#player-name-card').empty().text(namePlayer);
                   const postePlayer = rowSelected.find('div.infos-position-left-player').text();
                   $('#poste-player').empty().text(postePlayer);
                   const paceCapacity = rowSelected.find('div.pace-number-capacity').text();
                   $('#pace-capacity-player').empty().text(paceCapacity);
                   const shootCapacity = rowSelected.find('div.shoot-number-capacity').text();
                   $('#shoot-capacity-player').empty().text(shootCapacity);
                   const passeCapacity = rowSelected.find('div.passe-number-capacity').text();
                   $('#passe-capacity-player').empty().text(passeCapacity);
                   const dribbleCapacity = rowSelected.find('div.dribble-number-capacity').text();
                   $('#dribble-capacity-player').empty().text(dribbleCapacity);
                   const defenseCapacity = rowSelected.find('div.defense-number-capacity').text();
                   $('#defense-capacity-player').empty().text(defenseCapacity);
                   const physiqueCapacity = rowSelected.find('div.physique-number-capacity').text();
                   $('#physique-capacity-player').empty().text(physiqueCapacity);

                    const positionPlayer = rowSelected.find(infosPlayer).find('input[class="position-player"]').val();
                    $(`#position-player-active`).empty().text(positionPlayer);
                    const currentRatingPlayer = rowSelected.find(infosPlayer).find('input[class="current-rating-player"]').val();
                    $(`#current-rating-player-active`).empty().text(currentRatingPlayer);
                   const skillPlayer = rowSelected.find(infosPlayer).find('input[class="skill-player"]').val();
                   $(`#skill-player-active`).empty().text(skillPlayer);
                   let strongFootPlayer = rowSelected.find(infosPlayer).find('input[class="strong-foot-player"]').val();
                   if(strongFootPlayer === 'left') {
                       strongFootPlayer = 'GAUCHE';
                   } else {
                       strongFootPlayer = 'DROIT';
                   }
                   $(`#strong-foot-player-active`).empty().text(strongFootPlayer);
                   const acualFormPlayer = rowSelected.find(infosPlayer).find('input[class="actual-form-player"]').val();
                   $(`#actual-form-player-active`).empty().text(acualFormPlayer);

               }
            });


            $.ajax({
                url: '',
                type: 'GET',
                data: {},
                success: function(data){
                    console.log(data);
                }
            })
        });
    </script>
@endsection