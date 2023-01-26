<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperienceController extends Controller
{


    public function updateExperience(Request $request)
    {
        $user_id = $request->input('user_id');
        $experience = $request->input('experience');
        $gold = $request->input('gold');

        DB::table('user_statistics')
            ->where('user_id', $user_id)
            ->update([
                'currentExp' => DB::raw($experience),
                'gold' => DB::raw($gold),
            ]);

        return response()->json(['success'=>'Experience updated successfully.']);
    }

    public function updateLevel(Request $request)
    {
        $user_id = $request->input('user_id');
        $experience = $request->input('experience');
        $lvl = $request->input('level');

        DB::table('user_statistics')
            ->where('user_id', $user_id)
            ->update([
                'currentExp' => DB::raw($experience),
                'level' => DB::raw($lvl),
            ]);

        return response()->json(['success'=>'Lvl updated successfully.']);
    }

}
