<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use DateInterval;

use Illuminate\Support\Facades\DB;

class MissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function getFromDatabase()
    {
        $user_id = Auth::id();
        $user_mission = DB::table('missions')
            ->where('user_id', $user_id)
            ->get();

        return response()->json($user_mission);
    }

    public function deleteFromDatabase($id)
    {
        $user_mission = DB::table('missions')
            ->where('user_id', $id)
            ->delete();

        return response()->json(['success'=>'Mission deleted successfully.']);
    }

    public function index()
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $player_statistics = DB::table('user_statistics')->where('user_id', $user_id)->get();
       /* $user_mission = $this->getFromDatabase();
        $missionEnd = $user_mission.endTime;
        $missionStatus = $user_mission.status;*/
        $expToNextLvl = ($player_statistics->first()->level)*($player_statistics->first()->level)*15;
        return view('missions', compact('player_statistics','expToNextLvl'));
    }

    public function addToDatabase(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $missionTime = $request->input('time');
        $exp = $request->input('exp');
        $gold = $request->input('gold');

        $startTime = new DateTime();

        $endTime = new DateTime(date("Y-m-d H:i:s", strtotime($missionTime, $startTime->getTimestamp())));


        $mission = new Mission;
        $mission->startTime =$startTime;
        $mission->endTime = $endTime;
        $mission->exp = $exp;
        $mission->gold = $gold;
        $mission->status = false;
        $mission->user_id = $user_id;

        $mission->save();


       return response()->json(['message' => 'Mission added!'], 200);
    }


}
