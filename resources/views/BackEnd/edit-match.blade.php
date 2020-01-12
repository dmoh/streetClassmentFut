@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-dark-fut">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">
                        MATCH {{  date('d/m/Y', strtotime($match->get('match_date')))}}
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-responsive">
                        <tbody>
                            @foreach($players as $player)
                                <tr>
                                    <td>{{ $player->name }}</td>
                                    <td>{{ $player->overall_average }}</td>
                                    <td>CHAPEAU 1</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection