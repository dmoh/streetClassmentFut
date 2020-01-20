<div id="{{ $player->stats_player_id }}" class="wrapper-card-fut">
    <div class="infos-left-fut">
        <p>{{ $player->current_rating  }}</p>
        <p style="font-size: 1.1rem;   margin-top: -1rem;   text-align-last: center;   padding-top: .1rem;   border-top: 1px solid #a3e2d057"; >{{ $player->position }}</p>
    </div>
    <div class="img-user-fut">
        @if( $player->filename !== null )
            <img src="{{ asset('thumbs/'.$player->filename ) }}" alt="{{ $player->name }}">
        @else
            <img src="{{ asset('images/silhouette-ldc.png') }}" alt="{{ $player->name }}">
        @endif
    </div>
    <div class="name-fut">
        <h5 style="font-weight: bold"> {{ $player->name }}</h5>
    </div>
    <div id="display-player-info">
        <div class="infos-capacities-left">
            <span>{{ $player->pace  !== null ? $player->pace : 'N/A' }} VIT</span>
            <span>{{ $player->shoot  !== null ? $player->shoot : 'N/A' }} TIR</span>
            <span>{{ $player->passe  !== null ? $player->passe : 'N/A' }} PAS</span>
        </div>
        <div class="infos-capacities-right">
            <span>DRI {{ $player->dribble  !== null ? $player->dribble : 'N/A' }}</span>
            <span>DEF {{ $player->defense  !== null ? $player->defense : 'N/A' }}</span>
            <span>PHY {{ $player->physique !== null ? $player->physique : 'N/A'  }}</span>
        </div>
    </div>

<!--<div class="divider-blue"></div>-->
</div>
