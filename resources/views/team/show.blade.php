@extends('layouts.app')

@section('content')
    <section class="container-fluid">

        <div style='width:100%; display: grid; grid-template-areas: "header header header" "listPlayer listPlayer statsPlayer"' class="">
            <div style="grid-area: header" id="listPlayers">
                test
            </div>
            <div style="grid-area: listPlayer; display: flex; flex-direction: column">
                @foreach($players as $player)
                    <div class="rowTablePlayerTeam" style=" @if($loop->first) border-top: 1px solid #eaeaea; @endif">
                        @include('components.mini-card', ['noDeleteButton' => true, 'hideName' => true, 'showIconSkill' => true, 'dispositionTeam' => true, 'hidePoste' => true ])
                        <div style="width: 100%;display: flex;flex-direction:column;padding: .5rem;" class="stats">
                            <div style=" font-size: x-large; font-family: oswald, sans-serif; padding-bottom: .1rem;" class="player-name">{{strtoupper($player->name)}}</div>
                            <div style="display: flex" class="player-capacties-name">
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">VIT</div>
                                    <div class="players-capacities-number">{{ $player->pace }}</div>
                                </div>
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">TIR</div>
                                    <div class="players-capacities-number">{{ $player->shoot }}</div>
                                </div>
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">PAS</div>
                                    <div class="players-capacities-number">{{ $player->passe }}</div>
                                </div>
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">DRI</div>
                                    <div class="players-capacities-number">{{ $player->dribble }}</div>
                                </div>
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">DEF</div>
                                    <div class="players-capacities-number">{{ $player->defense }}</div>
                                </div>
                                <div style="display: flex; flex-direction: column" class="mr-1">
                                    <div class="title-capacities-player">PHY</div>
                                    <div class="players-capacities-number">{{ $player->physique }}</div>
                                </div>
                            </div>
                        </div>
                        <div style="justify-self: end; align-self: center; margin-right: 1rem;">
                            <span><i class="fa fa-chevron-right"></i></span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="grid-area: statsPlayer" id="showplayer">

            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection