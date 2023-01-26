<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserStatistics;

use App\Models\WeaponSlot;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string','min:3', 'max:25','unique:users'],
            'email' => ['required', 'string', 'email', 'max:33', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'proffesion' => ['required','string','in:mage,knight']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    /*
     * 'level',
        'currentExp',
        'intelligence',
        'strength',
        'vitality',
        'avatarPath',
        'user_id'
     */

    protected function create(array $data){

        $player_statistics = new UserStatistics;
        $player_statistics->level = 1;
        $player_statistics->currentExp = 0;
        $player_statistics->gold = 0;

        /// Statystyki rycerz
        if($data['proffesion']=="knight")
        {
            $player_statistics->intelligence = 1;
            $player_statistics->strength = 3;
            $player_statistics->vitality = 6;
            $player_statistics->avatarPath = "/avatars/knightAvatar.png";
        }else // statystyki maga
        {
            $player_statistics->intelligence = 6;
            $player_statistics->strength = 1;
            $player_statistics->vitality = 3;
            $player_statistics->avatarPath = "/avatars/magAvatar.png";
        }

        $weapon_slot = new WeaponSlot;
        $weapon_slot->name = "empty";
        $weapon_slot->dmg = 1; // musi być wartość > 0 poniewaz playerDmg jest mnożono przez tę wartość
        $weapon_slot->imgPath = "/weapons/empty.png";
        $weapon_slot->value = 0;


        $dataValidated = $this->validator($data)->validate(); //validating the data
        $validator = $this->validator($data);
        if($dataValidated) { //if validation is successful
            $user = new User([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'proffesion' => $data['proffesion'],
            ]);
            $user->save(); //saving the user
        } else {
            return redirect()->back()->withErrors($validator); //redirecting back with validation errors
        }

        $user->save();
        $user_id = $user->id;
        $weapon_slot->user_id  = $user_id;
        $player_statistics->user_id = $user_id;
        $player_statistics->save();
        $weapon_slot->save();
        return $user;

        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'proffesion' => $data['proffesion'],
        ]);*/
    }
}
