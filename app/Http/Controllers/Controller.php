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

        $url = $url.'/'.$api;

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

        $url = $url.'/'.$api;

        if ($method == 'LOGIN')
        {
            $method = 'POST';
            $header = array('Content-Type: application/json');
        }
        else
        {
            $token = Storage::get('id_token');
            $header = array(
                'Authorization: Bearer '.$token,
                'Content-Type: application/json',
                'Accept: application/json'
            );
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $header,
        ));

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
