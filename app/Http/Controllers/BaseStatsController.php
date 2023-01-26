<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseStatsController extends Controller
{
    public function addStatistic(Request $request)
    {
        $user_id = $request->input('user_id');
        $statName = $request->input('statName');
        $gold = $request->input('gold');

        DB::table('user_statistics')
            ->where('user_id', $user_id)
            ->update([
                $statName => DB::raw($statName . '+ 1'),
                'gold' => DB::raw($gold),
            ]);

        return response()->json(['success'=>'Stat updated successfully.']);
    }
    public function getUpdatedStatistics()
    {
        $user_id = Auth::id();
        $user_statistics = DB::table('user_statistics')
            ->where('user_statistics.user_id', $user_id)
            ->join('weapon_slots', 'weapon_slots.user_id','=','user_statistics.user_id')
            ->get();
        return response()->json($user_statistics);
    }

}
