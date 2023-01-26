<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $player_statistics = DB::table('user_statistics')->where('user_id', $user_id)->get();
        $weapon_slot = DB::table('weapon_slots')->where('user_id', $user_id)->get();
        $name = $user->name;
        $proffesion = $user->proffesion;
        $expToNextLvl = ($player_statistics->first()->level)*($player_statistics->first()->level)*15;

        return view('home', compact('player_statistics', 'name','proffesion','expToNextLvl','weapon_slot'));
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $user->delete();
        return redirect('/home')->with('success', 'User deleted successfully');
    }

}
