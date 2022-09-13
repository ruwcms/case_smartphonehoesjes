<?php

namespace App\Http\Actions;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SaveDataToSession
{
    public function __invoke(Request $request): bool
    {
        if($request->session()->exists('favorite')) {

            $exsistsJokes = $request->session()->get('favorite');

            if((count($exsistsJokes) + count($request->input('joke'))) < 11){
                $newJokes = array_merge($request->input('joke'),(array)$exsistsJokes);
                $request->session()->put('favorite', array_unique($newJokes));
            }else{
                return false;
            }
        } else {
            $request->session()->put('favorite', $request->input('joke'));
        }
        $request->session()->save();
        return true;
    }
}
