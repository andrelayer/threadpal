<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\ClientInterface;
use App\Services\TokenService;
use Illuminate\Support\Facades\Log;


class RefreshTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * The base Facebook Graph URL.
     *
     * @var string
     */
    protected $graphUrl = 'https://graph.facebook.com';


    protected $tokenService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TokenService $tokenService)
    {
        parent::__construct();
        $this->tokenService = $tokenService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tokenCollection = $this->tokenService->getToken('facebook');

        if(isset($tokenCollection))
        {
            $firstToken = $tokenCollection->token;

            $token = $this->exchangeToken($firstToken);

            $this->tokenService->updateToken($tokenCollection, $token);

        }else{

            $firstToken = env('FACEBOOK_TOKEN');

            $token = $this->exchangeToken($firstToken);

            $this->tokenService->saveToken('facebook', $token);
        }



        //Log::info($token);


    }

    protected function getHttpClient()
    {
        return new \GuzzleHttp\Client;
    }

    protected function getTokenUrl()
    {
        return $this->graphUrl.'/oauth/access_token';
    }

    public function exchangeToken($token)
    {
        $urlparams = [
            'grant_type' => 'fb_exchange_token',
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'fb_exchange_token' => $token,

        ];

        $response = $this->getHttpClient()->get($this->getTokenUrl(), ['query' => $urlparams]);

        return $this->parseAccessToken($response->getBody());
    }

    /**
     * {@inheritdoc}
     */
    protected function parseAccessToken($body)
    {
        parse_str($body);

        return $access_token;
    }
}
