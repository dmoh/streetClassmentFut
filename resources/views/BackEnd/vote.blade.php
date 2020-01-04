@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-list-players">
        <div class="container">
            <div class="col-md-12">

            @foreach($matchs as $match)

                @foreach($match->statsMatchs()->get()->toArray() as $stat)
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="infos-player">
                                        <table style="margin-bottom: 3rem; border-top: 2px solid #ccc" class="table">
                                            <thead>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    DATE DU MATCH
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($stat['match_date'])) }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    NOTE (Obtenue)
                                                </td>
                                                <td>{{ $stat['rating'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    BUTS
                                                </td>
                                                <td>{{ $stat['goals'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Passes décisives
                                                </td>
                                                <td>{{ $stat['assists'] }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection