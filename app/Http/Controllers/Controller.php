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
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function postCurl($api, $data, $method)
    {
        $token = Storage::get('id_token');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $api,
            CURLOPT_CUSTOMREQUEST => ($method),
            CURLOPT_POST => true,
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
