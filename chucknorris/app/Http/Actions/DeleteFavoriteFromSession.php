<?php

namespace App\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DeleteFavoriteFromSession
{
    public function __invoke(int $id): void
    {
        if(Session::exists('favorite')) {

            $favorites = Session::get('favorite');

            $list = array_filter((array)$favorites, function($favorite) use ($id){
               return  $favorite !== (string)$id;
            });
            Session::put('favorite', $list);
            Session::save();
        }
    }
}
