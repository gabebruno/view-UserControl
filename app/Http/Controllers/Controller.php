<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function getCurl($api)
    {
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

    public function postCurl($api, $data, $method)
    {
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
            CURLOPT_CUSTOMREQUEST => ($method),
            CURLOPT_POSTFIELDS => ($data),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

}
