<?php

namespace App\Services;


use App\Repositories\KeywordRepository;
use App\Services\TokenService;



class KeywordService{


    protected $keywordRepository;
    protected $tokenService;

    public function __construct(KeywordRepository $keywordRepository, TokenService $tokenService)
    {
        $this->keywordRepository = $keywordRepository;
        $this->tokenService = $tokenService;
    }

    public function search($keyword)
    {
        $tokenCollection = $this->tokenService->getToken('facebook');

        return $this->keywordRepository->search($keyword, $tokenCollection->token);
    }
}