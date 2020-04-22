<div class="card-fut-mobile">
    <div id="@if(!isset($changeIdPlayer))player_{{ $player->user_id }}@else player_{{ $player->stat_real_player_id }} @endif" class="display-players">
        <div style=" @isset($dispositionTeam) margin-top: 2rem; @endisset "id="note-player">{{ $player->current_rating ? $player->current_rating : 'N/N'  }}</div>
        @if(!isset($noDeleteButton))
            <div @isset($showAge) style="margin-top: 9.2rem" @endisset id="delete-team_">x</div>
        @endif
        <div class="wrapper-img-player">
            @if($player->filename != null)
                <img src="{{ asset("images/" . $player->filename) }}" alt="{{ $player->name }}">
                @else
                <img src="{{ asset("images/silhouette-ldc-yellow.png") }}" alt="{{ $player->name }}">
            @endif
        </div>
        @if(!isset($hidePoste))
            <div>
                <div style="position: absolute; width: 100%; color: black; font-size: small; font-weight: bolder; text-align: center;"
                     class="infos-position-left-player">
                    {{ strtoupper($player->position) }}
                </div>
            </div>
        @endif
        @if(!isset($hideName))
            <div style="width: 100%; text-align: center; margin-top: 100px; position: initial" class="infos-capacities-right">
                {{ strtoupper($player->name) }}
            </div>
        @endif
        @isset($showAge)
            <div style="position: absolute;width: 100%;text-align: center;bottom: -24px;font-family: Oswald, sans-serif;"  class="infos-age">
                {{ strtoupper($player->age) }} ans
            </div>
        @endisset
        @isset($showIconSkill)
            @if($player->skill == 'BUTEUR')
                <div style="position: absolute; width: 100%; text-align: center; bottom: .4rem;">
                    <i class="fa fa-bullseye"></i>
                </div>
            @elseif($player->skill == 'AGRESSIF')
                <div style="position: absolute; width: 100%; text-align: center; bottom: .4rem;">
                    <i class="fa fa-hammer"></i>
                </div>
            @elseif($player->skill == 'VITESSE')
                <div style="position: absolute; width: 100%; text-align: center; bottom: .4rem;">
                    <i class="fa fa-fighter-jet"></i>
                </div>
            @elseif($player->skill == 'MENEUR DE JEU')
                <div style="position: absolute; width: 100%; text-align: center; bottom: .4rem;">
                    <i class="fa fa-bullseye"></i>
                </div>
            @elseif($player->skill == 'TECHNIQUE')
                <div style="position: absolute; width: 100%; text-align: center; bottom: .4rem;">
                    <i class="fa fa-bullseye"></i>
                </div>
            @elseif($player->skill == 'LEADER')
                <div style="position: absolute; width: 100%; text-align: center; bottom: .4rem;">
                    <i class="fa fa-bullseye"></i>
                </div>
            @elseif($player->skill == 'COSTAUD')
                <div style="position: absolute; width: 100%; text-align: center; bottom: .4rem;">
                    <i class="fa fa-dumbbell"></i>
                </div>
            @elseif($player->skill == 'PASSEUR')
                <div style="position: absolute; width: 100%; text-align: center; bottom: .4rem;">
                    <i class="fa fa-drafting-compass"></i>
                </div>
            @endif
        @endisset
    </div>
</div>