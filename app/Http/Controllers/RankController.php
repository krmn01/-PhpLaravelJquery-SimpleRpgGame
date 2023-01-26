<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RankController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $player_statistics = DB::table('user_statistics')->where('user_id', $user_id)->get();
        $name = $user->name;
        $proffesion = $user->proffesion;
        $player_rank = DB::table('users')
            ->join('user_statistics', 'users.id','=','user_statistics.user_id')
            ->join('weapon_slots', 'users.id','=','weapon_slots.user_id')
            ->select(
                'users.id',
                'users.name',
                'users.proffesion',
                'user_statistics.level',
                'user_statistics.intelligence',
                'user_statistics.strength',
                'user_statistics.vitality',
                'weapon_slots.dmg'
            )->orderBy('user_statistics.level','desc')
            ->get();

        return view('rank', compact('player_rank','user_id','proffesion','player_statistics','name'));
    }
}
