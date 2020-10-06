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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        $data = array(
            'password' => $this->request->input('password'),
            'email' => $this->request->input('email')
        );

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
            CURLOPT_POSTFIELDS => $data,
        ));

        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        if (isset($response->access_token))
        {
            Storage::disk('local')->put('id_token', $response->access_token);

            $api = 'http://usercontrolgabebruno.herokuapp.com/api/user/me';
            $user = $this->getCurl($api);
            Session::put('user', $user);

            return redirect()->route('home', ['user' => $user]);
        }
        else
        {
            return redirect()->route('login')->withErrors("Email or password wrong, try again!");
        }
    }

    public function logout()
    {
        Session::remove('user');
        Storage::delete('id_token');

        return redirect()->route('login')->withErrors("You've been disconnected.");
    }

}
