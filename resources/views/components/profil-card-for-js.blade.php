<div id="" class="wrapper-card-fut">
    <div class="infos-left-fut">
        <p></p>
    </div>
    <div class="img-user-fut">
        @if(@isset($photo))
            @if((int) $player->user_id == (int) $photo->user_id )
                <img src="{{ asset('thumbs/'.$photo->filename ) }}" alt="{{ $player->name }}">
            @else
                <img src="{{ asset('images/halifa-2.png') }}" alt="{{ $player->name }}">
            @endif
        @else
            <img src="{{ asset('images/halifa-2.png') }}" alt="{{ $player->name }}">
        @endif

    </div>
    <div class="name-fut">
        <h5 style="font-weight: bold"> {{ $player->name }}</h5>
    </div>
    <div id="display-player-info">
        <div class="infos-capacities-left">
            <span>{{ $player->pace  }} VIT</span>
            <span>{{ $player->shoot  }} TIR</span>
            <span>{{ $player->passe  }} PAS</span>
        </div>
        <div class="infos-capacities-right">
            <span>DRI {{ $player->dribble  }}</span>
            <span>DEF {{ $player->defense  }}</span>
            <span>PHY {{ $player->physique  }}</span>
        </div>
    </div>

    <!--<div class="divider-blue"></div>-->
</div>