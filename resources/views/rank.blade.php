@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{ asset('js/Fight.js') }}"></script>
<script src="{{ asset('js/calculateComplexStats.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark"  style="color: #99968b;">{{ __('Ranking') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div id="prof" style="display: none;">{{$proffesion}}</div>
                            <div class="row justify-content-center">
                                <div class="col-auto" id="playerRank">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <td><b>Lp.</b></td>
                                                <td><b>Nazwa</b></td>
                                                <td><b>Profesja</b></td>
                                                <td><b>Poziom</b></td>
                                                <td><b>Inteligencja</b></td>
                                                <td><b>Siła</b></td>
                                                <td><b>Witalność</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @foreach($player_rank as $currentPlayer)
                                                <tr>

                                                    <td>{{$i}}.</td>
                                                    <td>{{$currentPlayer->name}}</td>
                                                    <td id="pr{{$i}}">{{$currentPlayer->proffesion}}</td>
                                                    <td>{{$currentPlayer->level}}</td>
                                                    <td>{{$currentPlayer->intelligence}}</td>
                                                    <td>{{$currentPlayer->strength}}</td>
                                                    <td>{{$currentPlayer->vitality}}</td>
                                                    @if($currentPlayer->id != $user_id)
                                                      <td> <button class="btn btn-primary" id="attackBtn" onclick="

                                                        //const stats = [dmgMin, dmgMax, hp];
                                                       //startFight(p1hp, p1maxhp, p2hp, p2maxhp, p1mindmg, p1maxdmg, p2mindmg, p2maxdmg, p2lvl, patck,p2_id,p1_id,prof1,int1,str1,vit1,prof2,int2,str2,vit2, continuing)
                                                        startFight(
                                                            0,0,
                                                            0,0,
                                                            0,0,
                                                            0,0,
                                                            {{$currentPlayer->level}},
                                                            1,
                                                            {{$currentPlayer->id}},
                                                            {{$user_id}},
                                                            $('#prof').text(),
                                                            {{$player_statistics->first()->intelligence}},
                                                            {{$player_statistics->first()->strength}},
                                                            {{$player_statistics->first()->vitality}},
                                                             $('#pr'+{{$i}}).text(),
                                                             {{$currentPlayer->intelligence}},
                                                             {{$currentPlayer->strength}},
                                                             {{$currentPlayer->vitality}},

                                                            false
                                                            );

                                                      ">Zaatakuj</button></td>
                                                    @endif
                                                @php $i+=1; @endphp
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="playerFight" style="display: none;">
                                    <div class="col-auto">
                                    <div class="text-center mx-auto"><h2>Gracz</h2></div>
                                    <div class='form-group'>
                                        <div class='progress' id="progress1"></div>
                                    </div>
                                    <div class="text-center mx-auto"><h2>Przeciwnik</h2></div>
                                    <div class='form-group'>
                                        <div class='progress' id="progress2"></div>
                                    </div>
                                    </div>
                                    <div class="text-center mx-auto" id="player1attack"></div>
                                    <div class="text-center mx-auto" id="player2attack"></div>
                                </div>
                                <script>
                                    changeRankVisibility();
                                </script>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
