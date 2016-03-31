<?php

namespace App\Services;

use App\Repositories\ConnectionRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ConnectionService{

    protected $connectionRepository;

    public function __construct(ConnectionRepository $connectionRepository)
    {
        $this->connectionRepository = $connectionRepository;
    }

    public function addConnection($socialiteUser, $provider)
    {
        $socialiteUser->token_updated_at = date('Y-m-d H:i:s');
        $socialiteUser->token_expires_at = Carbon::now()->addDays(60);
        $socialiteUser->social_id = $socialiteUser->id;
        $socialiteUser->provider = $provider;

        $socialiteUser->user_id = Auth::id();;


        $this->connectionRepository->create($socialiteUser);
    }

    public function getTokenbyUser($user)
    {

        $connection = $this->connectionRepository->getTokenbyUser($user);

        return $connection->token;

    }
}