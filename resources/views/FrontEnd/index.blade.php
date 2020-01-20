@extends('layouts.app')


@section('content')
    <div class="container-fluid bg-list-players">
        <div class="row">
            <div class="col-md-12">
                <div id="nav-hats">
                    <div id="hats_">LEGENDE</div>
                    <div id="hats_1 " class="active-hat">CHAPEAU 1</div>
                    <div id="hats_2">CHAPEAU 2</div>
                    <div id="hats_3">CHAPEAU 3</div>
                    <div id="hats_4">CHAPEAU 4</div>
                </div>
            </div>
        </div>
        <div class="divider"></div>

        <div id="expose-place-player" class="container">
            <!--<h2 class="text-center color-white font-xx-large marg-top">LISTE DES JOUEURS</h2>-->
            <div class="row section-expose-player_1">
                @foreach($players as $player)
                        <div class="col-md-3 col-sm-6">
                            @include('components.profil-card-hat')
                        </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $(function () {
            $(document).on('click', 'div[id^="hats_"]', function () {
                //todo request find others hats
                const hatId = $(this).attr('id').split('_')[1];
                $('div[id^="hats_"]').each(function (elem) {
                   $(this).removeClass('active-hat');
                });
                $(this).addClass('active-hat');
                const sectionSelected = $(`.section-expose-player_${hatId}`);
                const containerPlayers= $(`#expose-place-player`);

                console.log(sectionSelected);

                let addPlayerCardHtml = '';

                if(sectionSelected.length === 0){
                    $('div[class^="row section-expose"]').each(function (elem) {
                        $(this).hide(1000);
                    });
                    //create element
                    containerPlayers.hide();
                    containerPlayers.append(`<div class="row section-expose-player_${hatId}"></div>`);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('show-hat-player') }}',
                        type: 'POST',
                        data: {showHat: hatId},
                        dataType:'json',
                        success: function (data) {
                            if(data.length > 0){
                                for (let i = 0; i < data.length ; i++) {
                                    addPlayerCardHtml += `
                               <div id="${ data[i].user_id }" class="wrapper-card-fut">
                                    <div class="infos-left-fut">
                                    <p>${ data[i].current_rating }</p>
                                    <p style="font-size: 1.1rem;   margin-top: -1rem;   text-align-last: center;   padding-top: .1rem;   border-top: 1px solid #a3e2d057"; >
                                        ${ data[i].position }
                                    </p>
                                    </div>
                                    <div class="img-user-fut">
                                   <img src="{{ asset('images/silhouette-ldc.png') }}" alt="${ data[i].name }">
                                   </div>
                                   <div class="name-fut">
                                       <h5 style="font-weight: bold"> ${ data[i].name }</h5>
                                    </div>
                                   <div id="display-player-info">
                                       <div class="infos-capacities-left">
                                           <span>${ data[i].pace === null ? "N/A" : data[i].pace  } VIT</span>
                                            <span>${ data[i].shoot === null ? "N/A" : data[i].shoot  } TIR</span>
                                            <span>${ data[i].passe === null ? "N/A" : data[i].passe  } PAS</span>
                                        </div>
                                        <div class="infos-capacities-right">
                                            <span>DRI ${ data[i].dribble === null ? "N/A" : data[i].dribble  }</span>
                                            <span>DEF ${ data[i].defense === null ? "N/A" : data[i].defense  }</span>
                                            <span>PHY ${ data[i].physique === null ? "N/A" : data[i].physique  }</span>
                                        </div>
                                    </div>
                                   <!--<div class="divider-blue"></div>-->
                                </div>

                                `
                                }//endFor
                                $(`.section-expose-player_${hatId}`).append(addPlayerCardHtml);
                                containerPlayers.show(3000);
                            }else {
                                $(`.section-expose-player_${hatId}`).append('<div class="col-md-12"><h5 class="text-center no-player">AUCUN JOUEUR DANS CE CHAPEAU</h5><div>');
                                containerPlayers.show(2000);
                            }
                        }
                    });
                }else {
                    console.log('je passe ma ');
                    $('div[class^="row "]').each(function (elem) {
                        const idSection= parseInt($(this).attr('class').split('_')[1]);
                        if(parseInt(idSection) !== parseInt(hatId)){
                            $(this).hide(1000);
                        }else{
                              $(this).show(1000);
                        }
                    });

                }

            });

            $(document).on('click', '.wrapper-card-fut', function () {
               const id = parseInt($(this).attr('id'));
                let urlRoute = `{{ route('consultation.showProfile',":id" ) }}`;
                urlRoute = urlRoute.replace(':id', parseInt(id));
               window.location.assign(urlRoute);
            });

           /* $('.wrapper-card-fut').on('click', function (event) {
                var _this = $(this);
                var id = parseInt(_this.attr('id'));
                event.preventDefault();
                console.log(id);
            });*/
        });
    </script>
@endsection