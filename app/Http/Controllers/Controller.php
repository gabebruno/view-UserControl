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
        $url = 'https://usercontrolgabebruno.herokuapp.com/api';
        $url_local = 'localhost:8001/api';

        $url = $url.'/'.$api;
        $url_local = $url_local.'/'.$api;


        $token = Storage::get('id_token');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
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
        $url = 'https://usercontrolgabebruno.herokuapp.com/api';
        $url_local = 'localhost:8001/api';

        $url = $url.'/'.$api;
        $url_local = $url_local.'/'.$api;

        $method != 'LOGIN'  ?  $token = Storage::get('id_token') : $method = 'POST';

        if(isset($data->id) || $data == null) {
            $header = array(
                'Authorization: Bearer '.$token,
                'Content-Type: application/json',
                'Accept: application/json'
            );
        }
        else
            $header = array('Content-Type: application/json');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $header,

            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        ));

        $method == 'POST' ? curl_setopt($curl, CURLOPT_POST, true) : null;
        $method == 'POST' ? curl_setopt($curl, CURLOPT_PUT, true) : null;

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }


    public function cleanData($form)
    {

        $response['id'] = isset($form->id) ? $form->id : null;
        $response['name'] = isset($form->name) ? $form->name : null;
        $response['email'] = isset($form->email) ? $form->email : null;
        $response['address'] = isset($form->address) ? $form->address : null;
        $response['phone'] = isset($form->phone) ? $form->phone : null;
        $response['cpf'] = isset($form->cpf) ? $form->cpf : null;
        $response['permission'] = isset($form->permission) ? $form->permission : null;
        $response['password'] = isset($form->password) ? $form->password : null;

        return $response;
    }

}
