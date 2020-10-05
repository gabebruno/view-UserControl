<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function login()
    {

        $email = $this->request->input('email');
        $password = $this->request->input('password');

        $api = 'http://usercontrolgabebruno.herokuapp.com/api/auth/login';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'password' => $password,'email' => $email),
        ));

        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        if (isset($response->access_token))
        {
            Storage::disk('local')->put('id_token', $response->access_token);
            $user = $this->get_user();
            Session::put('user', $user);
            return view('home', [$user]);
        }
        else{
            return view('login/unauthorized');
        }


    }

    public function get_user()
    {
        $api = 'http://usercontrolgabebruno.herokuapp.com/api/user/me';
        $token = Storage::get('id_token');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token
            ),
        ));

        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        return $response;
    }

    public function logout()
    {
        Session::remove('user');
        Storage::delete('id_token');

        return view('login/logout');
    }

}
