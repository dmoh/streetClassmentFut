@extends('layouts.app')

@section('content')
<div class="container">
    <div style="margin-top: 1rem" class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tableau de bord</div>
                <div class="card-body">
                    <label for="groupChoice">Choisissez un groupe</label>
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
