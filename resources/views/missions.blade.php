@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/missions.js') }}"></script>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark"  style="color: #99968b;">{{ __('Zadania') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div id="missionLabel" class="text-center" style="display: none;">
                            <span id="missionTime"></span>
                        </div>

                        <div id="missionView" style="display: none;">

                            <form>
                                <div class="form-group">
                                    <div class="col-auto text-center mx-auto"> <label><b>Wybierz zadanie:</b></label>
                                    <div class="form-check col-auto text-center mx-auto">
                                        <input class="form-check-input" type="radio" name="missionRadios" id="mission1Radio" value="mission1"
                                               onchange="setTimeLimit(
                                               this.value,
                                               {{$player_statistics->first()->level}},
                                               {{$player_statistics->first()->user_id}},
                                               {{$player_statistics->first()->currentExp}},
                                                {{$player_statistics->first()->gold}}),
                                                false,
                                                0
                                               ">
                                        <label class="form-check-label" for="mission1Radio">Łatwe zadanie (10s)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="missionRadios" id="mission2Radio" value="mission2"
                                               onchange="setTimeLimit(
                                               this.value,
                                               {{$player_statistics->first()->level}},
                                               {{$player_statistics->first()->user_id}},
                                               {{$player_statistics->first()->currentExp}},
                                                {{$player_statistics->first()->gold}}),
                                                 false,
                                                0
                                               ">
                                        <label class="form-check-label" for="mission2Radio">Średnie zadanie (20s)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="missionRadios" id="mission3Radio" value="mission3"
                                               onchange="setTimeLimit(
                                               this.value,
                                               {{$player_statistics->first()->level}},
                                               {{$player_statistics->first()->user_id}},
                                               {{$player_statistics->first()->currentExp}},
                                               {{$player_statistics->first()->gold}}),
                                                false,
                                                0
                                               ">
                                        <label class="form-check-label" for="mission3Radio">Trudne zadanie (30s)</label>
                                    </div>
                                    </div>
                                </div>
                                @csrf
                                <script type="text/javascript">
                                    const csrf_token = "{{ csrf_token() }}";
                                </script>
                                <br>
                                <div class="col-auto text-center mx-auto">
                                <button class="btn btn-primary" id="startMissionBtn" disabled>Rozpocznij Zadanie</button></div>
                            </form>
                        </div>
                          <br>
                         <div id="cancelBtn" class="text-center mx-autotext-center mx-auto" style="display: none;">
                            <button class="btn btn-primary btn-lg" id="cancelMission">Anuluj</button>
                         </div>
                            <script>
                            changeMissionVisibility(
                                {{$player_statistics->first()->level}},
                                {{$player_statistics->first()->user_id}},
                                {{$player_statistics->first()->currentExp}},
                                {{$player_statistics->first()->gold}}
                            );
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
