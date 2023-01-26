<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $player_statistics = DB::table('user_statistics')->where('user_id', $user_id)->get();
        $weapon_slot = DB::table('weapon_slots')->where('user_id', $user_id)->get();
        $proffesion = $user->proffesion;


        return view('shop', compact('player_statistics', 'proffesion','weapon_slot','user_id'));
    }
}
