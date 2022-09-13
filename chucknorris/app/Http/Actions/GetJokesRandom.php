<?php

namespace App\Http\Actions;

use App\Http\Clients\GuzzleClient;

class GetJokesRandom
{
    public function __construct(protected GuzzleClient $guzzleClient,)
    {}

    public function __invoke()
    {
        return $this->guzzleClient->send('http://api.icndb.com/jokes/random/10');
    }
}
