<?php

namespace App\Http\Controllers;

use App\Http\Actions\DeleteFavoriteFromSession;
use App\Http\Actions\GetJokesFavorite;
use App\Http\Actions\GetJokesRandom;
use App\Http\Actions\SaveDataToSession;
use App\Http\Clients\GuzzleClient;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JokesController extends Controller
{

    public function __construct(
        protected GetJokesRandom $getJokesRandom,
        protected GetJokesFavorite $getJokesFavorite,
        protected SaveDataToSession $saveDataToSession,
        protected DeleteFavoriteFromSession $deleteFavoriteFromSession
    ){}

    public function index()
    {
        return view('index', [
            'jokes'=> ($this->getJokesRandom)(),
            'favorites' => ($this->getJokesFavorite)()
        ]);
    }

    public function save(Request $request)
    {
        if (($this->saveDataToSession)($request) === true){
            return redirect('/');
        } else {
            return redirect('/')->with('failed', 'U hebt al 10 favorieten gekozen of u komt over 10 favorieten');
        }
    }

    public function destroy(int $jokeId)
    {
        ($this->deleteFavoriteFromSession)($jokeId);
        return redirect('/');
    }

    public function destroyAll()
    {
        Session::forget('favorite');
        return redirect('/')->with('success', 'Alle favorieten zijn verwijderd');
    }
}
