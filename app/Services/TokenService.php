<?php

namespace App\Services;


use Illuminate\Support\Facades\Auth;
use App\Repositories\TokenRepository;
use App\Token;



class TokenService{


protected $tokenRepository;


    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    /**
     *
     *
     * @return Collection
     */
    public function getToken($provider)
    {
        return $this->tokenRepository->getToken($provider);
    }

    public function updateToken(Token $tokenCollection, $token)
    {
        return $this->tokenRepository->updateToken($tokenCollection, $token);
    }


}