@extends('layouts.app')


@section('content')
    <div class="container-fluid bg-list-players">
        <div class="container">
            <div class="row">
                @foreach($players as $player)
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('consultation.showProfile', implode(', ', $player->statPlayer()->get()->pluck('user_id')->toArray()) ) }}">
                            @include('components.profile-card')
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $(function () {
           /* $('.wrapper-card-fut').on('click', function (event) {
                var _this = $(this);
                var id = parseInt(_this.attr('id'));
                event.preventDefault();
                console.log(id);
            });*/
        });
    </script>
@endsection