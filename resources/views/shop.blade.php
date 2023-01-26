@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/Weapon.js') }}"></script>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark"  style="color: #99968b;">{{ __('Sklep') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div id="prof" style="display: none;">{{$proffesion}}</div>
                        <h1 class="text-center mx-auto">Przedmioty na sprzedaż:</h1>

                        <div class="row justify-content-center">
                            <div class="col-auto" id="playerRank">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td id="item1"></td>
                                        <td id="name1" style="display: none;"></td>
                                        <td id="dmg1" style="display: none;"></td>
                                        <td id="value1" style="display: none;"></td>

                                        <td id="item2"></td>
                                        <td id="name2" style="display: none;"></td>
                                        <td id="dmg2" style="display: none;"></td>
                                        <td id="value2" style="display: none;"></td>

                                        <td id="item3"></td>
                                        <td id="name3" style="display: none;"></td>
                                        <td id="dmg3" style="display: none;"></td>
                                        <td id="value3" style="display: none;"></td>
                                    </tr>

                                    </tbody>
                                </table>
                                <script>shopWeapons(
                                        {{$player_statistics->first()->level}},
                                        {{$player_statistics->first()->gold}},
                                        {{$player_statistics->first()->user_id}},
                                        {{$weapon_slot->first()->value}}
                                    )</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
