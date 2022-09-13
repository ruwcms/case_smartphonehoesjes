<?php

namespace App\Http\Clients;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GuzzleClient
{
    public function send(string $url)
    {
        try {
            $client = new Client();
            $response = $client->request('GET', $url);
            return json_decode($response->getBody()->getContents());

        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
