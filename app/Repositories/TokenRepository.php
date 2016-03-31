<?php

namespace App\Repositories;

use App\Token;




class TokenRepository{

    public function __construct()
    {

    }

    /**
     *
     *
     * @return Collection
     */
    public function getToken($provider)
    {
        $tokenCollection = Token::where('provider',$provider)->first();

        return $tokenCollection;
    }

    public function updateToken(Token $tokenCollection, $token)
    {
        $tokenCollection->token = $token;

        $tokenCollection->save();

        return $tokenCollection;
    }


}