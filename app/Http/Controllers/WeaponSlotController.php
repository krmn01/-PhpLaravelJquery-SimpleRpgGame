<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class WeaponSlotController extends Controller
{
    public function getWeapon(Request $request)
    {
        $user_id = $request->input('user_id');
        $weapon_statistics = DB::table('weapon_slots')
            ->where('user_id', $user_id)
            ->get();
        return response()->json($weapon_statistics);
    }

    public function sellWeapon(Request $request)
    {
        $user_id = Auth::id();
        $value = DB::table('weapon_slots')
            ->where('user_id', $user_id)
            ->select('value')
            ->first()->value;

        DB::table('user_statistics')
            ->where('user_id', $user_id)
            ->update(['gold' => DB::raw('gold + '.$value)]);

         DB::table('weapon_slots')
            ->where('user_id', $user_id)
             ->update([
                 'Name' => 'empty',
                 'dmg' => 1,
                 'imgPath' => '/weapons/empty.png',
                 'value' => 0
             ]);

    }

    public function buyWeapon(Request $request)
    {
        $user_id = Auth::id();
        $Name = $request->input('name');
        $img = $request->input('img');
        $gld = $request->input('gld');
        $value = $request->input('value');
        $dmg = $request->input('dmg');

        DB::table('user_statistics')
            ->where('user_id', $user_id)
            ->update([
                'gold' => $gld
            ]);

        DB::table('weapon_slots')
            ->where('user_id', $user_id)
            ->update([
                    'Name' => $Name,
                    'dmg' => $dmg,
                    'imgPath' => $img,
                    'value' => $value
            ]);

    }

}
