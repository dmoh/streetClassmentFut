@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        @if(!empty($groups))
                            @foreach($groups as $group)
                                <li>
                                    <div>
                                        {{-- display group --}}
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection