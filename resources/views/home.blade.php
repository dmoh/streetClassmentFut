@extends('layouts.app')

@section('content')
<div id="home" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(count($groups) > 1)
                    <div class="card-header">CHOIX DU GROUPE</div>
                    <div class="card-body">
                        <select name="groupChoice" id="groupChoice" class="form-control">
                                @if(session('groupName'))
                                    <option value="{{ session('groupId') }}">{{ session('groupName') }}</option>
                                @else
                                    <option value="null">-Sélectionnez un groupe-</option>
                                @endif
                                @foreach($groups as $group)
                                    @if((int) $group->group_id != (int) session('groupId'))
                                        <option  value="{{$group->id}}">{{$group->group_name}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                @else
                    <div class="card-header">{{ $groups[0]->group_name }}</div>
                    <div class="card-body">
                    </div>
                @endif
            </div>
        </div>
         <!--hasRoleCoach !}  #}-->
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>GESTION DE L'équipe</h5>
                </div>
                <div class="card-body">
                    <div class="card-part-left">

                    </div>
                    <div class="card-part-right">
                        test
                    </div>
                </div>
            </div>
        </div>
        <!-- End HasRoleCoach -->

        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>MON PROFIL</h5>
                </div>
                <div class="card-body">
                    <div class="card-part-left">
                        test
                    </div>
                    <div class="card-part-right">
                        test
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('create.team')  }}" class="btn btn-block btn-primary">
                Créer une équipe
            </a>
        </div>
    </div>
    @if(!empty($teams))
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div  class="card-header">{{ count($teams) == 1 ? strtoupper('MON équipe') : strtoupper('Mes équipes') }}</div>
                    <div class="card-body">
                        <ul>
                            @foreach($teams as $team)
                                <li>
                                    <div class="selectTeam">
                                        <a href="{{ route('show.team', ['id' => $team->id]) }}">{{ $team->name }}</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">GESTION </div>
                <div class="card-body">
                    <select name="groupChoice" id="groupChoice" class="form-control">
                        @if(session('groupName'))
                            <option value="{{ session('groupId') }}">{{ session('groupName') }}</option>
                        @else
                            <option value="null">-Sélectionnez un groupe-</option>
                        @endif
                        @foreach($groups as $group)
                            @if(session('groupId') != $group->id)
                                <option value="{{$group->id}}">{{$group->group_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>GESTION DE L'équipe</h5>
                </div>
                <div class="card-body">
                    <div class="card-part-left">

                    </div>
                    <div class="card-part-right">
                        test
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>MON PROFIL</h5>
                </div>
                <div class="card-body">
                    <div class="card-part-left">
                        test
                    </div>
                    <div class="card-part-right">
                        test
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">CHOIX DU GROUPE</div>
                <div class="card-body">
                    <select name="groupChoice" id="groupChoice" class="form-control">
                        @if(session('groupName'))
                            <option value="{{ session('groupId') }}">{{ session('groupName') }}</option>
                        @else
                            <option value="null">-Sélectionnez un groupe-</option>
                        @endif
                        @foreach($groups as $group)
                            @if(session('groupId') != $group->id)
                                <option value="{{$group->id}}">{{$group->group_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>GESTION DE L'équipe</h5>
                </div>
                <div class="card-body">
                    <div class="card-part-left">

                    </div>
                    <div class="card-part-right">
                        test
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>MON PROFIL</h5>
                </div>
                <div class="card-body">
                    <div class="card-part-left">
                        test
                    </div>
                    <div class="card-part-right">
                        test
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">CHOIX DU GROUPE</div>
                <div class="card-body">
                    <select name="groupChoice" id="groupChoice" class="form-control">
                        @if(session('groupName'))
                            <option value="{{ session('groupId') }}">{{ session('groupName') }}</option>
                        @else
                            <option value="null">-Sélectionnez un groupe-</option>
                        @endif
                        @foreach($groups as $group)
                            @if(session('groupId') != $group->id)
                                <option value="{{$group->id}}">{{$group->group_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>GESTION DE L'équipe</h5>
                </div>
                <div class="card-body">
                    <div class="card-part-left">

                    </div>
                    <div class="card-part-right">
                        test
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>MON PROFIL</h5>
                </div>
                <div class="card-body">
                    <div class="card-part-left">
                        test
                    </div>
                    <div class="card-part-right">
                        test
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div style="margin-top: 1rem" class="row justify-content-center">
        <div class="col-md-8">
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(function () {
           $(document).on('change', '#groupChoice', function () {
               if($(this).val() !== 'null'){
                   const group = {groupId: $(this).val(), groupName: $(this)[0].selectedOptions[0].label};
                   $.ajax({
                      url: "{{ route('group.choice') }}",
                      type: 'POST',
                      data: group,
                      dataType: 'json',
                      success: function (data) {
                          console.log(data);
                      }
                   });
               }
           });
        });
    </script>
@endsection
