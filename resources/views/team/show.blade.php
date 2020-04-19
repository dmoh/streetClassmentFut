@extends('layouts.app')

@section('content')
    <!-- MODAL START -->
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
    <div class="modal fade" id="modalInfos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">RETIRER UN JOUEUR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="FERMER">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="compo">Souhaitez-vous réellement retirer ce joueur de l'équipe ?</label>
                        <input type="hidden" id="delete-this-player" value="">
                        <!-- <select class="form-control" name="compo" id="compo">
                            <option value="null">-Sélectionner-</option>
                            <option value="4-3-3">4-3-3</option>
                            <option value="4-4-2">4-4-2</option>
                        </select>-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="yes-delete" class="btn btn-danger" data-dismiss="modal">OUI</button>
                    <button type="button" data-dismiss="modal" class="btn btn-primary">NON</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalSearchPlayer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un joueur à l'équipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="FERMER">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <input type="hidden" id="team-id" value="">
                        <label for="findThisPlayerByName">Nom du joueur</label>
                        <input type="text" autocomplete="off" class="form-control" id="findThisPlayerByName">
                    </div>
                    <button style="margin-top: .3rem;" id="btnFindThisPlayer" class="btn btn-primary">Rechercher</button>
                    <div id="reponse-player-available">

                    </div>
                </div>
                <!--<div class="modal-footer">
                    <button type="button" id="yes-delete" class="btn btn-danger" data-dismiss="modal">OUI</button>
                    <button type="button" data-dismiss="modal" class="btn btn-primary">NON</button>
                </div>-->
            </div>
        </div>
    </div>
    <!--  MODAL END -->
    <div style="" class="container-fluid bg-home">
        <div class="container">
            <div style=" " class="row sidebar-team-top">
                <div id="recap-nav-team" style="" class="nav-top-team col-md-4 active-nav-top">
                    <div style="text-align: center">
                        <span><i class="fa fa-poll"></i></span>
                        <div style="padding-top: .4rem">L'équipe</div>
                    </div>
                </div>
                <div id="matchs-nav-team" style="border-left: 1px solid #adadad;" class="nav-top-team col-md-4">
                    <div style="text-align: center">
                        <span><i class="fa fa-futbol"></i></span>
                        <div style="padding-top: .4rem">MATCHS</div>
                    </div>
                </div>
                <div id="joueurs-nav-team" style="border-left: 1px solid #adadad;" class="nav-top-team col-md-4">
                    <div style="text-align: center">
                        <span><i class="fa fa-users"></i></span>
                        <div style="padding-top: .4rem">MES JOUEURS</div>
                    </div>
                </div>
            </div>
        </div>
        <section style="" class="container">
            <div style='padding-top: .4rem; width:100%; display: grid; grid-template-areas: "header header header" "listPlayer listPlayer listPlayer"; background-color: #7b7b7b40;' class="">
                <div style="grid-area: header;  text-align: left" id="listPlayers">
                    <div style="display: flex;flex-direction: row;justify-content: space-between;padding: .4rem;">
                        <div>
                            <input type="hidden" id="team-info-id" value="{{$teamInfo[0]->team_id}}">
                            <h1 style="font-family: Anton, sans-serif;text-transform: uppercase;text-align: left;padding-bottom: 0;margin-bottom: 0;">{{ $teamInfo[0]->name  }}</h1>
                            <div style="font-size: x-large;font-family: 'oswald';color: #ffffff;text-transform: uppercase;/* margin-bottom: .5rem; */" class="infos-classement">
                                Classement 1er
                            </div>
                        </div>
                        <div>
                            @if(trim($teamInfo[0]->category_name) != '')
                                <div class="display-category-top">catégorie <b style="color: #ab2424;font-size: larger;">{{ $teamInfo[0]->category_name }}</b></div>
                            @endif
                            @if(trim($teamInfo[0]->coach_name) != '')
                                <div id="display-name-coach-top">COACH: <b style="color: #ab2424;font-size: larger;"><em>{{ $teamInfo[0]->coach_name }}</em></b></div>
                            @endif
                        </div>
                    </div>
                    <div class="matchs-resume">
                        <div class="text-center">
                            <h4 style="font-family: Anton, sans-serif; font-size: x-large" >MATCHS</h4>
                        </div>
                        <div style="margin-bottom: .1rem" class="table-responsive">
                            <table style="text-align: center" width="100%" class="table">
                                <tbody>
                                <tr>
                                    <td style="    border-top: 1px solid #ececec;     border-bottom: 1px solid #ececec;">
                                        <span>VICTOIRE <span class="badge badge-success">6</span><b></b></span>
                                    </td>
                                    <td style="    border-top: 1px solid #ececec;     border-bottom: 1px solid #ececec;">
                                        <span>NUL <span class="badge badge-warning">4</span><b></b></span>
                                    </td>
                                    <td style="    border-top: 1px solid #ececec;     border-bottom: 1px solid #ececec;">
                                        <span>DéFAITE <span class="badge badge-danger">3</span><b></b></span>
                                    </td>
                                    <td style="    border-top: 1px solid #ececec;     border-bottom: 1px solid #ececec;">
                                        <span>POINTS <span class="badge badge-info">15</span><b></b></span>
                                    </td>
                                </tr>
                                <!--<tr>
                                    <td colspan="" style="    border-top: 1px solid #ececec;     border-bottom: 1px solid #ececec;">
                                       <button class="btn btn-primary">Préparer le match suivant</button>
                                    </td>
                                    <td style="    border-top: 1px solid #ececec;     border-bottom: 1px solid #ececec;">
                                        <button class="btn btn-primary">HISTORIQUE</button>
                                    </td>
                                    <td style="    border-top: 1px solid #ececec;     border-bottom: 1px solid #ececec;">
                                        <button class="btn btn-primary">COMPOSITION</button>
                                    </td>
                                    <td style="    border-top: 1px solid #ececec;     border-bottom: 1px solid #ececec;">
                                        <button class="btn btn-primary">OBJECTIF</button>
                                    </td>
                                </tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="list-player-team" style="grid-area: listPlayer; display: flex; flex-direction: column;    border-top: 1px solid #ccc;padding-top: 0.3rem;">
                    <div class="row">
                        <div class="col-auto col-md-12">
                            <h1 style="font-family: Anton, sans-serif;" class="text-center">MES JOUEURS</h1>
                            <h4 class="text-center"><button style="display: none" id="addNewPlayerTeam" class="btn btn-primary">Intégrer un joueur</button></h4>
                        </div>
                    </div>

                    <div class="row">
                        <div id="listing-left-players" style="margin-right: 0" class="col-md-8">
                            @foreach($players as $player)
                                <div id="rowPlayerId_{{$player->id}}" class="rowTablePlayerTeam @if($loop->first) active-row-player border-top-for-first-row @endif  " style="">
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
                                            <div style="" class="display-flex-columns mr-1">
                                                <div class="title-capacities-player">VIT</div>
                                                <div class="pace-number-capacity" class="players-capacities-number">{{ $player->pace }}</div>
                                            </div>
                                            <div style="" class="display-flex-columns mr-1">
                                                <div class="title-capacities-player">TIR</div>
                                                <div class="shoot-number-capacity" class="players-capacities-number">{{ $player->shoot }}</div>
                                            </div>
                                            <div style="" class="display-flex-columns mr-1">
                                                <div class="title-capacities-player">PAS</div>
                                                <div class="passe-number-capacity" class="players-capacities-number">{{ $player->passe }}</div>
                                            </div>
                                            <div style="" class="display-flex-columns mr-1">
                                                <div class="title-capacities-player">DRI</div>
                                                <div class="dribble-number-capacity" class="players-capacities-number">{{ $player->dribble }}</div>
                                            </div>
                                            <div style="" class="display-flex-columns mr-1">
                                                <div class="title-capacities-player">DEF</div>
                                                <div class="defense-number-capacity" class="players-capacities-number">{{ $player->defense }}</div>
                                            </div>
                                            <div style="" class="display-flex-columns mr-1">
                                                <div class="title-capacities-player">PHY</div>
                                                <div class="physique-number-capacity" class="players-capacities-number">{{ $player->physique }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="justify-self: end; align-self: center; margin-right: 1rem;">
                                        <span><i style="font-size: .9rem;color: #5d5d5d;" class="fa fa-chevron-right"></i></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div style="margin-left: 0" class="col-12 col-md-4">
                            <div style="grid-area: statsPlayer; display: flex; flex-direction: column; position: relative" id="showplayer">
                                @foreach($players as $player)
                                    <div style="position: absolute;color: red;margin-left: 1rem;margin-top: 1rem;width: 30px;height: 30px;" class="deletePlayerOfTeam">
                            <span>
                                <input type="hidden" id="update-change-input-team-player" value="{{ $player->id }}">
                                <i id="update-change-team-player" style="color: #14e414; cursor:pointer;" title="Modifier" class="fa fa-user-circle"></i>
                            </span>
                                    </div>
                                    <div style="position: absolute;color: red;right: 1rem;margin-top: 1rem;width: 30px;height: 30px;" class="deletePlayerOfTeam">
                            <span>
                                <input type="hidden" id="delete-change-input-team-player" value="{{ $player->id }}">
                                <i id="delete-change-team-player" style="color: red; cursor:pointer;" title="Supprimer" class="fa fa-times-circle"></i>
                            </span>
                                    </div>
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
                    </div>
                </div>
            </div>
            <div id="graph-matchs">
                <div id="" style="margin-top: 1rem; border-top: 1px solid #cccccc" class="row">
                    <div class="col-md-12">
                        <h6 style=" padding: 1rem; font-size: x-large; text-transform: uppercase; font-family: 'oswald';" class="text-center">évolution des matchs</h6>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-md-12">
                        <div style="width: 100%;height: 400px;">
                            <canvas id="myAreaChart" ></canvas>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="newPlayer">Ajouter un joueur à cette équipe</label>
                        <input type="text" class="form-control" placeholder="Nom du joueur">
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('#addNewPlayerTeam').hide();
            function removeClassActiveRowPlayer(){
                $(`#list-player-team`).find('div[class*="active-row-player"]')
                    .removeClass('active-row-player');
            }
            function showProfilPlayerSelected(rowSelected, playerId){
                const infosPlayer = `div#infos`;
                $(`#update-change-input-team-player`).val(playerId);
                $(`#delete-change-input-team-player`).val(playerId);
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
            $(document).on('click', '.rowTablePlayerTeam', function () {
               const rowSelected = $(this);
               const playerId = $(this).attr('id').split('_')[1];
               const selectedShowPlayer = $(`#showplayer`);
               const classElementSelected = $(this).attr('class');
               if(!/active-row-player/.test(classElementSelected)){
                   removeClassActiveRowPlayer();
                   rowSelected.addClass('active-row-player');
                   showProfilPlayerSelected(rowSelected, playerId);
               }
            });

            $(document).on('click', 'i[id*="-change-team-player"]', function () {
               const idSelected = $(this).attr('id');
               const idPlayerSelected = $(this).attr('id').split('_')[1];
               if(/update/.test(idSelected)){

               }else{
                   //suppression
                   $(`#delete-this-player`).val(idPlayerSelected);
                   $(`#modalInfos`).modal('show');
               }
            });

            $(document).on('click', '#yes-delete', function () {
                const idToDelete = $(`#delete-change-input-team-player`).val();
                $.ajax({
                    url: "{{ route('deletePlayerTeam') }}",
                    type: 'POST',
                    data: {
                        rowIdTeamToDelete: idToDelete
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.ok === 'success') {
                            const row = $(`#rowPlayerId_${idToDelete}`);
                            const classElementSelected = row.attr('class');
                            if(/active-row-player/.test(classElementSelected)){
                                if(typeof row.next().attr('id') !== "undefined" ){
                                    row.next().addClass('active-row-player');
                                    const idNext = row.next().attr('id').split('_')[1];
                                    showProfilPlayerSelected(row.next(), idNext);
                                }else{
                                    row.prev().addClass('active-row-player');
                                    const idBefore = row.prev().attr('id').split('_')[1];
                                    showProfilPlayerSelected(row.prev(), idBefore);
                                }
                            }
                            row.fadeOut();
                        }
                    }
                });
            });
            $(document).on('click', '.nav-top-team', function () {
               const classNavSelected = $(this).attr('class');

               if(!/active-nav-top/.test(classNavSelected)){
                   $('.nav-top-team').each(function (elem) {
                       $(this).removeClass('active-nav-top');
                   });

                   $(this).addClass('active-nav-top');
                   const idNav = $(this).attr('id');
                   const sectionListPlayer = $(`#list-player-team`);
                   const sectionMatch = $(`.matchs-resume`);
                   const graphMatch = $(`#graph-matchs`);
                   const btnAddNewPlayerTeam = $('#addNewPlayerTeam');
                   switch (idNav){
                       case 'recap-nav-team':
                           sectionListPlayer.fadeIn();
                           sectionMatch.fadeIn();
                           graphMatch.fadeIn();
                           btnAddNewPlayerTeam.fadeOut();
                           break;
                       case 'matchs-nav-team':
                           sectionMatch.fadeIn();
                           graphMatch.fadeIn();
                           sectionListPlayer.fadeOut();
                           break;
                       case 'joueurs-nav-team':
                           sectionListPlayer.fadeIn();
                           btnAddNewPlayerTeam.fadeIn();
                           sectionMatch.fadeOut();
                           graphMatch.fadeOut();
                           break;
                   }
               }
            });

            $(document).on('click', '#addNewPlayerTeam', function () {
                $(`#team-id`).val($(`#team-info-id`).val());
                $(`#modalSearchPlayer`).modal('show');
            });
            const addPlayers = [];
            function showLoader(selector){
                selector.empty().append(`<img src="{{ asset('../images/loader.gif') }}" width="40px" height="40px"  alt="loader">`);
            }
            $(document).on('click', '#btnFindThisPlayer', function () {
                const responsePlayerAvailable = $(`#reponse-player-available`);
                const namePlayer = $('#findThisPlayerByName').val();
               if(namePlayer.length > 2 && /[0-9a-zA-Z.\-_ ]/.test(namePlayer)){
                   showProfilPlayerSelected(responsePlayerAvailable);
                   namePlayer.trim();
                   const teamId = $(`#team-info-id`).val();
                   $.ajax({
                      url: '{{ route('findPlayerName') }}',
                      data: {
                          teamId: teamId,
                          groupId: '{{ session("groupId")}}',
                          playerName: namePlayer
                      },
                      type: 'POST',
                      dataType: 'json',
                      success: function(data){
                          let cardHtml = '';
                          if(data.players){
                              for (let i = 0; i < data.players.length ; i++) {
                                  const item = data.players[i];
                                  addPlayers.push({
                                      playerId: item.stat_player_real_id,
                                      infos: item
                                  });
                                  cardHtml +=  `<div style="cursor: pointer;border-left: 0.25rem solid #f28701" id="player-selected_${item.stat_player_real_id}" class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <input type="hidden">
                                                    <div class="col mr-2">
                                                        <div style="color: #eb5a09; font-size: x-large" id="player-name_${item.stat_player_real_id}  " class="text-xs font-weight-bold text-primary text-uppercase mb-1">${item.name}</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">${item.surname}</div>
                                                        <input type="hidden" id="playerId" value="${item.stat_player_real_id}" >
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            NOTE GLOBALE  <b id="note_player_${item.stat_player_real_id}">${item.current_rating}</b>
                                                        </div>
                                                        <div>
                                                            POSTE  <b id="poste_player_${item.stat_player_real_id} ">  ${item.position} </b>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                      <i style="font-size: xx-large; color: red" class="fas fa-battery-quarter"></i>
                                      </div>
                                  </div>
                              </div>
                          </div>`;
                              }
                              responsePlayerAvailable.empty().append(cardHtml);
                          }
                      }
                   });
               }
            });

            $(document).on('click', 'div[id^="player-selected_"]', function () {
               $(`#modalSearchPlayer`).modal('hide');
               const playerId = parseInt($(this).attr('id').split('_')[1]);
               const arrayPlayer = addPlayers.filter((elem) => {
                  return  elem.playerId === playerId
               });
               const item = arrayPlayer[0].infos;
               removeClassActiveRowPlayer();
               $(`div[id^='rowPlayerId_']`).each(function () {
                       if($(this).hasClass('border-top-for-first-row')){
                           $(this).removeClass('border-top-for-first-row');
                       }
                });
               const rowPlayerHtml = `<div id="rowPlayerId_${item.stat_player_real_id}" class="rowTablePlayerTeam  active-row-player " style="">
                                    <div id="infos">
                                        <input type="hidden" class="position-player" value="${item.position}">
                                        <input type="hidden" class="current-rating-player" value="${item.current_rating}">
                                        <input type="hidden" class="skill-player" value="${item.skill}">
                                        <input type="hidden" class="strong-foot-player" value="${item.strong_foot}">
                                        <input type="hidden" class="actual-form-player" value="${item.overall_average}">
                                    </div>
                                    <div class="card-fut-mobile">
                                        <div id="player_${item.stat_player_real_id}" class="display-players">
                                    <div style=" margin-top: 2rem; "id="note-player">${item.current_rating}</div>
                                       <div class="wrapper-img-player">
                                       <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="${item.name}">
                                       </div>
                                       <div>
                                           <div style="position: absolute; width: 100%; color: black; font-size: small; font-weight: bolder; text-align: center;"
                                                class="infos-position-left-player">
                                            ${item.position}
                                       </div>
                                   </div>
                                       <div style="width: 100%; text-align: center; margin-top: 100px; position: initial" class="infos-capacities-right">
                                       </div>
                                       </div>
                                   </div>
                                  <div style="width: 100%;display: flex;flex-direction:column;padding: .5rem;" class="stats">
                                      <div style=" font-size: x-large; font-family: oswald, sans-serif; padding-bottom: .1rem;" class="player-name">${item.name.toUpperCase()}
                   </div>
                   <div style="display: flex" class="player-capacties-name">
                       <div style="" class="display-flex-columns mr-1">
                           <div class="title-capacities-player">VIT</div>
                           <div class="pace-number-capacity" class="players-capacities-number">${item.pace}</div>
                                            </div>
                                            <div style="" class="display-flex-columns mr-1">
                                                <div class="title-capacities-player">TIR</div>
                                                <div class="shoot-number-capacity" class="players-capacities-number">${item.shoot}</div>
                                            </div>
                                            <div style="" class="display-flex-columns mr-1">
                                                <div class="title-capacities-player">PAS</div>
                                                <div class="passe-number-capacity" class="players-capacities-number">${item.passe}</div>
                                            </div>
                                            <div style="" class="display-flex-columns mr-1">
                                                <div class="title-capacities-player">DRI</div>
                                                <div class="dribble-number-capacity" class="players-capacities-number">${item.dribble}</div>
                                            </div>
                                            <div style="" class="display-flex-columns mr-1">
                                                <div class="title-capacities-player">DEF</div>
                                                <div class="defense-number-capacity" class="players-capacities-number">${item.defense}</div>
                                            </div>
                                            <div style="" class="display-flex-columns mr-1">
                                                <div class="title-capacities-player">PHY</div>
                                                <div class="physique-number-capacity" class="players-capacities-number">${item.physique}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="justify-self: end; align-self: center; margin-right: 1rem;">
                                        <span><i style="font-size: .9rem;color: #5d5d5d;" class="fa fa-chevron-right"></i></span>
                                    </div>
                                </div>`;
                $(`#listing-left-players`).prepend(rowPlayerHtml);
                const newRow = $(`#rowPlayerId_${item.stat_player_real_id}`);
                newRow.addClass('border-top-for-first-row');
                showProfilPlayerSelected(newRow, playerId);
            });
        });
    </script>
    <script src="{{asset('js/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('js/Chart/chart-area.js')}}"></script>
    <script type="text/javascript">
        // Area Chart Example

        /*const arr = $('#arrLabelCharJs').val();
        const numChar = $('#labelCharJs').val();
        const arrChar = numChar.split(',');
        const label = arr.split(',');*/


        var ctx = document.getElementById("myAreaChart");
        //ctx.style.backgroundColor = "rgba(0,0,0, 0.3)";
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                // labels: label, // todo mettre les dates des matchs
                labels: [2,8,3,4,10,6,3,8,2,1], // todo mettre les dates des matchs
                datasets: [{
                    label: "Evolution des matchs",
                    lineTension: 0.3,
                    //backgroundColor: "rgba(52, 144, 220, 1)",
                    backgroundColor: "#4e4e4a",
                    // borderColor: "rgba(52, 144, 220, 1)",
                    borderColor: "#eceb13",
                    pointRadius: 3,
                    // pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBackgroundColor: "#fffd00",
                    //pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "#fffd00",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [0, 1, 4, 8, 4.6, 6.9, 8.9, 5, 3, 5, 7, 8.5], // todo mettre les notes dernières
                    // data: arrChar, // todo mettre les notes dernières
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            /*maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '$' + number_format(value);
                            }*/
                            beginAtZero: true,
                            steps: 1,
                            stepValue: 1,
                            max: 10

                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgba(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });

    </script>
@endsection