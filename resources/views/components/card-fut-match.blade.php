<div class="wrapper-card-fut">
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
        <span>{{ $player->goals }} DEF</span>
        <span>{{ $player->goals }} SHO</span>
        <span>{{ $player->goals }} PRE</span>
    </div>
    <div class="infos-capacities-right">
        <span>BUT {{ $player->goals }}</span>
        <span>PUI 76</span>
        <span>DRI 74</span>
    </div>
</div>
