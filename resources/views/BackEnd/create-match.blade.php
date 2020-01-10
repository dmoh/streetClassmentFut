@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-list-players">
        <h2 class="text-center">Organisé un match</h2>
        <div class="row">
            <div class="col-md-4">
                <h4 class="text-center">Première équipe</h4>
                <div class="form-group">
                    <input type="text" id="find-player" class="form-control" placeholder="chercher ">
                </div>
            </div>
            <div class="col-md-8">
                <p>TERRAIN DISPLAY</p>
                <div class="display-players-selected">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <ul style="list-style: none">
                    @if(!$players->isEmpty())
                        @foreach($players as $player)
                            <li style="cursor: pointer" class="idPlayer_{{$player->id}}">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $player->name }}</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $player->surname }}</div>
                                                <input type="hidden" id="playerId" value="{{ $player->id }}" >
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $(document).on('click', 'li[class^="idPlayer_"]', function () {
                const id = $(this).attr('class').split('_')[1];
                $('.display-players-selected').append(id);
                $(`.idPlayer_${id}`).fadeOut(400);
            });
        });
    </script>
@endsection