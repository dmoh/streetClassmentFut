<div id="{{ $player->user_id }}" class="wrapper-card-fut">
    <div class="infos-left-fut">
        <p>{{ $player->current_rating }}</p>
        <p style="font-size: 1.1rem;   margin-top: -1rem;   text-align-last: center;   padding-top: .1rem;   border-top: 1px solid #a3e2d057"; >{{ $player->position }}</p>
    </div>
    <div class="current_form">
        @if((int) $player->overall_average >= 5)
            <i style="font-size: x-large; color: #76fd76; position: absolute; margin-left: 3.9rem; margin-top: 7.3rem;" class="fas fa-battery-three-quarters"></i>
        @else
            <i style="font-size: x-large; position: absolute; margin-left: 3.9rem; margin-top: 7.3rem; color: #f52d00" class="fas fa-battery-quarter"></i>
        @endif
    </div>
    <div class="img-user-fut">
        @if($player->filename !== null)
            @if((int)$player->user_id == (int)  $player->user_id)
                <img src="{{ asset('thumbs/'.$player->filename) }}" alt="{{ $player->name }}">
            @else
                <img src="{{ asset('images/silhouette-ldc.png') }}" alt="{{ $player->name }}">
            @endif
        @else
            <img src="{{ asset('images/silhouette-ldc.png') }}" alt="{{ $player->name }}">
        @endif
    </div>
    <div class="name-fut">
        <h5 style="font-weight: bold"> {{ $player->name }}</h5>
    </div>
    <div id="display-player-info">
        <div class="infos-capacities-left">
            <span><b>{{ $player->pace }}</b> VIT</span>
            <span><b>{{ $player->shoot }}</b> TIR</span>
            <span><b>{{ $player->passe }}</b> PAS</span>
        </div>
        <div class="infos-capacities-right">
            <span>DRI {{ $player->dribble }}</span>
            <span>DEF {{ $player->defense }}</span>
            <span>PHY {{ $player->physique }}</span>
        </div>
    </div>
    <!--<div class="divider-blue"></div>-->
</div>
