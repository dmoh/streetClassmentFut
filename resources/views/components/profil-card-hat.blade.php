<div id="{{ $player->stats_player_id }}" class="wrapper-card-fut @if($player->man_of_match == 1) wrapper-card-fut-gold @endif">
    <div class=" @if($player->man_of_match == 1) infos-left-fut-gold @else infos-left-fut @endif">
        <p>{{ $player->current_rating  }}</p>
        <p style="font-size: 1.1rem;   margin-top: -1rem;   text-align-last: center;   padding-top: .1rem;   border-top: 1px solid #a3e2d057"; >{{ $player->position }}</p>
    </div>
    <div class="current_form">
        @if($player->man_of_match == 1)
            <i style="font-size: x-large;color: #a58617;position: absolute;margin-left: 3.75rem;margin-top: 6.3rem;" class="fas fa-battery-full"></i>
        @elseif((int) $player->overall_average >= 5)
            <i style="font-size: x-large; color: #76fd76; position: absolute; margin-left: 3.9rem; margin-top: 7.3rem;" class="fas fa-battery-three-quarters"></i>
        @elseif((int) $player->overall_average < 5)
            <i style="font-size: x-large; position: absolute; margin-left: 3.9rem; margin-top: 7.3rem; color: #f52d00" class="fas fa-battery-quarter"></i>
        @endif
    </div>
    <div class=" @if($player->man_of_match == 1) img-user-fut-gold @else img-user-fut @endif">
        @if( $player->filename !== null )
            <img src="{{ asset('images/'.$player->filename ) }}" alt="{{ $player->name }}">
        @elseif($player->man_of_match == 1)
            <img src="{{ asset('images/silhouette-ldc-gold.png') }}" alt="{{ $player->name }}">
        @else
            <img src="{{ asset('images/silhouette-ldc.png') }}" alt="{{ $player->name }}">
        @endif
    </div>
    <div class=" @if($player->man_of_match == 1) name-fut-gold @else name-fut @endif">
        <h5 style="font-weight: bold"> {{ $player->name }}</h5>
    </div>
    <div id="display-player-info">
        <div class=" @if($player->man_of_match == 1) infos-capacities-left-gold @else infos-capacities-left @endif">
            <span><b>{{ $player->pace  !== null ? $player->pace : 'N/A' }}</b> VIT</span>
            <span><b>{{ $player->shoot  !== null ? $player->shoot : 'N/A' }}</b> TIR</span>
            <span><b>{{ $player->passe  !== null ? $player->passe : 'N/A' }}</b> PAS</span>
        </div>
        <div class=" @if($player->man_of_match == 1) infos-capacities-right-gold @else infos-capacities-right @endif">
            <span>DRI <b>{{ $player->dribble  !== null ? $player->dribble : 'N/A' }}</b></span>
            <span>DEF <b>{{ $player->defense  !== null ? $player->defense : 'N/A' }}</b></span>
            <span>PHY <b>{{ $player->physique !== null ? $player->physique : 'N/A'  }}</b></span>
        </div>
    </div>
    @if($player->man_of_match == 1)
        <div style="position: absolute;margin-top: 2.67rem;text-align: center;color: gold;font-size: x-large;margin-left: 3rem;font-family: 'Oswald', sans-serif;">HOMME DU MATCH</div>
    @endif
<!--<div class="divider-blue"></div>-->
</div>
