<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Fight;

/*
 * 'player1Hp',
        'player2Hp',
        'player1MaxHp',
        'player2MaxHp',
        'player1DmgMin',
        'player2DmgMin',
        'player1DmgMax',
        'player2DmgMax',
        'player2lvl',  /// do wyliczania ew. nagrody
        'playerAttacks',
        'user_id'
 *
 */

class FightController extends Controller
{
    //

    public function add(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $p1hp = $request->input('p1hp');
        $p2hp = $request->input('p2hp');
        $p1maxhp = $request->input('p1maxhp');
        $p2maxhp = $request->input('p2maxhp');
        $p1dmg = $request->input('p1dmg');
        $p2dmg = $request->input('p2dmg');
        $p1maxdmg = $request->input('p1maxdmg');
        $p2maxdmg = $request->input('p2maxdmg');
        $p2lvl = $request->input('p2lvl');
        $patck = $request->input('patck');

        $fight = new Fight;
        $fight->player1Hp = $p1hp;
        $fight->player2Hp = $p2hp;
        $fight->player1MaxHp = $p1maxhp;
        $fight->player2MaxHp = $p2maxhp;
        $fight->player1DmgMin = $p1dmg;
        $fight->player2DmgMin = $p2dmg;
        $fight->player1DmgMax = $p1maxdmg;
        $fight->player2DmgMax = $p2maxdmg;
        $fight->player2lvl = $p2lvl;
        $fight->playerAttacks = $patck;
        $fight->user_id = $user_id;

        $fight->save();

        return response()->json(['message' => 'Fight added!'], 200);
    }


    public function get()
    {
        $user_id = Auth::id();
        $user_fight = DB::table('fights')
            ->where('user_id', $user_id)
            ->get();

        return response()->json($user_fight);
    }

    public function deleteDb()
    {
        $user_id = Auth::id();
        $user_fight=DB::table('fights')
            ->where('user_id', $user_id)
            ->delete();

        return response()->json(['success'=>'Fight deleted successfully.']);
    }

    public function update(Request $request)
    {
        $user_id = Auth::id();
        $p1hp = $request->input('p1hp');
        $p2hp = $request->input('p2hp');
        $patck = $request->input('patck');

        DB::table('fights')
            ->where('user_id', $user_id)
            ->update([
                'player1Hp' => $p1hp,
                'player2Hp' => $p2hp,
                'playerAttacks' => $patck
            ]);
        return response()->json(['success'=>'Fight updated successfully.']);
    }

}
