<!DOCTYPE html>
@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/addStatistic.js') }}"></script>
<script src="{{ asset('js/calculateComplexStats.js') }}"></script>
<script src="{{ asset('js/Weapon.js') }}"></script>
<script >
    const csrf_token = "{{ csrf_token() }}";
</script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="dark-mode">
            <div class="card">
                <div class="card-header bg-dark"  style="color: #99968b;">{{ __('Profil Użytkownika') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <!--name-->
                        <h1 class="text-center mx-auto">{{ $name }}</h1>
                        <!--avatar-->
                        <div class="text-center mx-auto">
                            <img alt="" class="img-thumbnail" src="{{ asset('/storage/'.$player_statistics->first()->avatarPath)}}"/>
                        </div>
                        <br>
                        <!--lvl-->
                        <div class="col-md-8 text-center mx-autotext-center mx-auto">
                        <h4 class="text-center mx-auto">Poziom: {{$player_statistics->first()->level}}</h4>
                        <div class="progress" style="height: 30px;">

                            <div class="progress-bar bg-warning" title="{{ $player_statistics->first()->currentExp }} / {{ $expToNextLvl }}" role="progressbar" style="width: {{ ($player_statistics->first()->currentExp / $expToNextLvl) * 100 }}%" aria-valuenow="{{ $player_statistics->first()->currentExp }}" aria-valuemin="0" aria-valuemax="{{ $expToNextLvl }}">
                            </div>
                        </div>
                        </div>
                        <br>
                        <div class="col-md-8 text-center mx-autotext-center mx-auto">
                            <div id="weaponSlot">

                                    <img alt="" id="weapon" class="img-thumbnail" src="{{ asset('/storage/'. $weapon_slot->first()->imgPath)}}"/>

                            </div>
                        </div>
                        <br>
                        <!-- Wyswietlenie ilosci zlota i profesji-->
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <table class="table table-responsive">
                                    <tr>
                                        <td><img alt="" src="{{ asset('/storage/'.'other/goldCoin.png')}}"/></td>
                                        <td><span id="gold">{{$player_statistics->first()->gold}}</span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Profesja:</td>
                                        <td><span id="prof">{{$proffesion}}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--
                        <div class="text-center mx-autotext-center mx-auto">
                        <div class="text-center mx-autotext-center mx-auto">
                            <label class="col-lg-1"><img src="{{ asset('/storage/'.'other/goldCoin.png')}}"/></label>
                            <label class="col-lg-1"><h3 class="text-center mx-auto"><span id="gold">{{$player_statistics->first()->gold}}</span></h3></label>
                        </div>
                        <br>
                            <div class="text-center mx-autotext-center mx-auto">
                                <label class="col-sm-4"><h4>Profesja: <span id="prof">{{$proffesion}}</span></h4></label>
                            </div>
-->
                            <!-- Statystyki -->
                            <div class="row justify-content-center">
                            <div class="col-auto"><br>
                            <table class="table table-responsive">
                                <tr style="border-bottom:hidden;">
                                    <td class="bg-success">Inteligencja</td>
                                    <td class="bg-success"><span id="intelligence">{{$player_statistics->first()->intelligence}}</span></td>
                                    <td>
                                        @csrf
                                        <button type="button" class="btn btn-primary btn-sm" onclick="addStat(
                                            parseInt($('#intelligence').text()),
                                            parseInt($('#gold').text()),
                                            1,
                                            {{$player_statistics->first()->user_id}}),
                                            $('#prof').text()
                                        ">+</button>
                                    </td>
                                    <td>

                                    </td>
                                    <td id="mageDmg" style="display:none;">Obrażenia:</td>
                                    <td><span id="mageDmgMin" style="display:none;"></span></td>
                                    <td id="mageSep" style="display:none;">- </td>
                                    <td><span id="mageDmgMax" style="display:none;"></span></td>
                                </tr>
                                <tr style="border-bottom:hidden;">
                                    <td class="bg-primary">Siła</td>
                                    <td class="bg-primary"><span id="strength"> {{$player_statistics->first()->strength}}</span></td>
                                    <td>
                                        @csrf
                                        <button type="button" class="btn btn-primary btn-sm" onclick="addStat(
                                            parseInt($('#strength').text()),
                                            parseInt($('#gold').text()),
                                            2,
                                            {{$player_statistics->first()->user_id}}),
                                            $('#prof').text()
                                        ">+</button>
                                    </td>
                                    <td>

                                    </td>
                                    <td id="knightDmg" style="display:none;">Obrażenia:</td>
                                    <td><span id="knightDmgMin" style="display:none;"></span></td>
                                    <td id="knightSep" style="display:none;">-</td>
                                    <td><span id="knightDmgMax" style="display:none;"></span></td>
                                </tr>
                                <tr style="border-bottom:hidden;">
                                    <td class="bg-danger">Witalność</td>
                                    <td class="bg-danger"><span id="vitality">{{$player_statistics->first()->vitality}}</span></td>
                                    <td>
                                        @csrf
                                        <button type="button" class="btn btn-primary btn-sm" onclick="addStat(
                                                parseInt($('#vitality').text()),
                                                parseInt($('#gold').text()),
                                                3,
                                                {{$player_statistics->first()->user_id}}),
                                                $('#prof').text()
                                                ">+</button>
                                    </td>
                                    <td>

                                    </td>
                                    <td>Punkty Hp:</td>
                                    <td><span id="healthPts"></span></td>
                                    <td> </td>
                                    <td></td>
                                </tr>
                            </table>
                            </div>
                            </div>
                       <!--     <div class="text-center mx-autotext-center mx-auto">
                        <br>
                       <div class="row">
                            <div>
                                <label class="col-sm-4"><h4>Inteligencja: <span id="intelligence">{{$player_statistics->first()->intelligence}}</span></h4></label>
                                @csrf
                                <label class="col-sm-4" ><button type="button" class="btn btn-primary btn-sm" onclick="addStat(
                                parseInt($('#intelligence').text()),
                                parseInt($('#gold').text()),
                                 1,
                                 {{$player_statistics->first()->user_id}}),
                                 $('#prof').text()
                                 ">+</button></label>
                            <br>
                        </div>
                        </div>
                       <div class="row">
                           <div>
                               <label class="col-sm-4"><h4>Siła:<span id="strength"> {{$player_statistics->first()->strength}}</span></h4></label>
                               @csrf
                               <label class="col-sm-4" ><button type="button" class="btn btn-primary btn-sm" onclick="addStat(
                                parseInt($('#strength').text()),
                                parseInt($('#gold').text()),
                                 2,
                                 {{$player_statistics->first()->user_id}}),
                                 $('#prof').text()
                                 ">+</button></label>
                               <br>
                           </div>
                       </div>
                       <div class="row">
                           <div>
                               <label class="col-sm-4"><h4>Witalność: <span id="vitality">{{$player_statistics->first()->vitality}}</span></h4></label>
                               @csrf
                               <label class="col-sm-4" ><button type="button" class="btn btn-primary btn-sm" onclick="addStat(
                                 parseInt($('#vitality').text()),
                                parseInt($('#gold').text()),
                                 3,
                                 {{$player_statistics->first()->user_id}}),
                                 $('#prof').text()
                                 ">+</button></label>
                               <br>
                           </div>
                       </div>
                    </div> weaponName,weaponDmg,weaponImg,weaponVal,player_id -->


                        <script>
                            $(window).on("load", function(){
                                calculateDmgAndHp(
                                    $('#prof').text(),
                                    parseInt($('#intelligence').text()),
                                    parseInt($('#strength').text()),
                                    parseInt($('#vitality').text()),
                                    true,{{$player_statistics->first()->user_id}});
                                    showWeapon( {{$player_statistics->first()->user_id}});
                            });

                            </script>

                    <br>
                        <!--usuniecie uzytkownika-->
                        <div class="col-md-8 text-center mx-autotext-center mx-auto">

                            <form id="delete-form" method="POST" action="/delete-user">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" id="delete-user-btn">Usuń konto</button>
                            </form>
                        </div>

                        <script>
                            $('#delete-user-btn').on('click', function() {
                                Swal.fire({
                                    title: 'Czy na pewno chcesz usunąć konto?',
                                    text: "Usunięcie jest nieodwracalne.",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Tak,jestem pewien',
                                    cancelButtonText: 'Anuluj'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#delete-form').submit();
                                    }
                                });
                            });
                        </script>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
