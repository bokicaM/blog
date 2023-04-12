<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WebServiceController extends Controller
{
    public function callWebService()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.restful-api.dev/objects');
        $data = json_decode($response->getBody(), true);
        return view('api', compact('data'));
    }

    public function showData()
    {
        $client = new Client();
        $response = $client->get('https://api.restful-api.dev/objects');
        $data = json_decode($response->getBody(), true);
        return view('api', compact('data'));
    }

}
