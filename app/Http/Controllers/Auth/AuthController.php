<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Services\UserService;
use App\Services\ConnectionService;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $userService;
    protected $connectionService;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService, ConnectionService $connectionService)
    {
        //$this->middleware('guest', ['except' => 'logout']);

        $this->userService = $userService;
        $this->connectionService = $connectionService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $this->middleware('guest', ['except' => 'logout']);

        return $this->userService->create($data);
    }

    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->scopes(['ads_management'])->redirect();

    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(ConnectionService $connectionService, $provider)
    {

        $connectionService->addConnection(Socialite::driver($provider)->user(),$provider);

        return redirect()->action('HomeController@index');

    }
}
