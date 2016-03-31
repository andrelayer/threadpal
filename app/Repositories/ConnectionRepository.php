<?php

namespace App\Repositories;


use App\Connection;

use DB;

class ConnectionRepository{

    public function create($socialiteUser)
    {
        return Connection::create((array)$socialiteUser);
    }

    public function getTokenbyUser($user)
    {

        return Connection::where('user_id',$user->id)->first();

    }

}