<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class FileServerService{
    public $token;

    public function __construct(){
        $response = Http::post('http://181.143.216.68/oauth/token', [
            'grant_type'    => config('fileServer.grant_type'),
            'client_id'     => config('fileServer.client_id'),
            'client_secret' => config('fileServer.client_secret'),
        ]);
        $responseObject = $response->object();
        $this->token = "{$responseObject->token_type} {$responseObject->access_token}";
    }
}
