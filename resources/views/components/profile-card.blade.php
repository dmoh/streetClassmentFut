<div id="{{ implode(', ', $player->statPlayer()->get()->pluck('user_id')->toArray()) }}" class="wrapper-card-fut">
    <div class="infos-left-fut">
        <p>85</p>
    </div>
    <div class="img-user-fut">
        <img src="{{ asset('images/halifa-2.png') }}" alt="{{ $player->name }}">
    </div>
    <div class="name-fut">
        <h5>{{ $player->name }}</h5>
    </div>
    <div class="infos-capacities-left">
        <span>{{ implode(', ', $player->statPlayer()->get()->pluck('goals')->toArray()) }} DEF</span>
        <span>{{ implode(', ', $player->statPlayer()->get()->pluck('goals')->toArray()) }} SHO</span>
        <span>{{ implode(', ', $player->statPlayer()->get()->pluck('goals')->toArray()) }} PRE</span>
    </div>
    <div class="infos-capacities-right">
        <span>BUT {{ implode(', ', $player->statPlayer()->get()->pluck('assists')->toArray()) }}</span>
        <span>PUI 76</span>
        <span>DRI 74</span>
    </div>
    <!--<div class="divider-blue"></div>-->
</div>
