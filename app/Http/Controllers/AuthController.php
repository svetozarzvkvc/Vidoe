<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\Country;
use App\Models\Playlist;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash as Hash;
use Mockery\Exception;
//use Illuminate\Auth\Events\Registered;

class AuthController extends GenesisController
{
    //
    public function index()
    {
        return view('pages.auth.register');
    }

    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(Auth::user()->hasVerifiedEmail()){
                $request->session()->regenerate();
                if (Auth::user()->role_id === 2) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->intended('/');
                }
                //return redirect()->intended('/');
            }else{
                Auth::logout();
                return redirect()->back()->withInput()->withErrors(['email' => 'You need to verify your email before logging in.']);
            }
        }

        return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function store(UserStoreRequest $request)
    {
        $data1 = $request->only('username','email','password');
        //dd(Hash::make($data1['password']));
        try {
            DB::beginTransaction();
            $userip = $request->ip();
            $client = new Client();

            //automatsko dohvatanje zemlje korsinikia na osnovu adrese
            //prekoracen broj besplatnih zahteva, moram da zakomentarisem


            //$response = $client->get("https://ipapi.co/{$userip}/json/");
            //$data = json_decode($response->getBody());

            //dd($data->country_name);
            //$country = "";
//            if ($data->ip == '127.0.0.1'){
//                //dd('je'); radi
//                $country = "Serbia";
//            }
//            else{
//                $country =  $data->country_name;
//            }
            //$countryId = Country::select('id')->where('name',$country)->first();


            $passs = Hash::make($data1['password']);
            $user = User::create([
               "username"=>$data1['username'],
               "email"=>$data1['email'],
                "password" => $passs,
                //"country_id"=>$countryId->id,
                "country_id"=>rand(1,150),
                'role_id'=>1
            ]);
            Playlist::insert([
                [
                    "name"=>"History",
                    "user_id"=>$user->id
                ],
                [
                    "name"=>"Liked videos",
                    "user_id"=>$user->id
                ]
            ]);
            DB::commit();

            $user->sendEmailVerificationNotification();

            return redirect()->back()->with('success-msg','Registration successful.
            Please verify your email before trying to login.
        You will be redirected to main page in couple of seconds.');
        }
        catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with('Server encountered an error '.$e->getMessage());
        }


    }
}
