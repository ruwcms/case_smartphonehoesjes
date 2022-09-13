<?php

namespace App\Http\Actions;

use App\Http\Clients\GuzzleClient;
use Illuminate\Support\Facades\Session;

class GetJokesFavorite
{
    public function __construct(protected GuzzleClient $guzzleClient,)
    {}

    public function __invoke()
    {
        $list = [];
        if(Session::exists('favorite')){
            foreach(Session::get('favorite') as $favoriteId){
                $response = $this->guzzleClient->send("http://api.icndb.com/jokes/$favoriteId");
                $list[] = $response->value;
            }
        }

        return $list;
    }
}
