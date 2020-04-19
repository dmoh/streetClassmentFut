<li style="cursor: pointer" class="idPlayer_ @isset($player) {{ $player->id}} @endisset">
    <div style="border-left: 0.25rem solid #f28701" class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div style="color: #eb5a09; font-size: x-large" id="player-name_ @isset($player) {{ $player->id}} @endisset " class="text-xs font-weight-bold text-primary text-uppercase mb-1">@isset($player){{ $player->name }} @endisset</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">@isset($player){{ $player->surname }}@endisset</div>
                    <input type="hidden" id="playerId" value="@isset($player){{ $player->id }}@endisset" >
                    <input type="hidden" id="note_ @isset($player){{ $player->id }}@endisset" value="@isset($player){{ $player->rating_before_update }}@endisset" >
                    <input type="hidden" id="photo_ @isset($player){{ $player->id }}@endisset" value="@isset($player){{ $player->filename }}@endisset" >
                </div>
                <div class="col">
                    <div>
                        NOTE GLOBALE  <b id="note_player_ @isset($player){{ $player->id}}@endisset">@isset($player){{ $player->current_rating }}@endisset</b>
                    </div>
                    <div>
                        POSTE  <b id="poste_player_ @isset($player) {{ $player->id }} @endisset "> @isset($player) {{ $player->position }} @endisset </b>
                    </div>
                </div>
                <div class="col-auto">
                    @isset($player)
                        @if((int) $player->overall_average >= 5)
                            <i style="font-size: xx-large; color: green" class="fas fa-battery-three-quarters"></i>
                        @else
                            <i style="font-size: xx-large; color: red" class="fas fa-battery-quarter"></i>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
</li>