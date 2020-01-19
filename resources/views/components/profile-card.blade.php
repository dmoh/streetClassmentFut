<div id="{{ implode(', ', $player->statPlayer()->get()->pluck('user_id')->toArray()) }}" class="wrapper-card-fut">
    <div class="infos-left-fut">
        <p>{{ implode(', ', $player->statPlayer()->get()->pluck('current_rating')->toArray()) }}</p>
    </div>
    <div class="img-user-fut">
        @if(isset($photo))
            @if((int)implode(',', $player->statPlayer()->get()->pluck('user_id')->toArray()) == (int) implode(',', $photo->pluck('user_id')->toArray()))
                <img src="{{ asset('thumbs/'.$photo->filename ) }}" alt="{{ $player->name }}">
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
            <span>{{ implode(', ', $player->statPlayer()->get()->pluck('pace')->toArray()) }} VIT</span>
            <span>{{ implode(', ', $player->statPlayer()->get()->pluck('shoot')->toArray()) }} TIR</span>
            <span>{{ implode(', ', $player->statPlayer()->get()->pluck('passe')->toArray()) }} PAS</span>
        </div>
        <div class="infos-capacities-right">
            <span>DRI {{ implode(', ', $player->statPlayer()->get()->pluck('dribble')->toArray()) }}</span>
            <span>DEF {{ implode(', ', $player->statPlayer()->get()->pluck('defense')->toArray()) }}</span>
            <span>PHY {{ implode(', ', $player->statPlayer()->get()->pluck('physique')->toArray()) }}</span>
        </div>
    </div>
    <!--<div class="divider-blue"></div>-->
</div>
