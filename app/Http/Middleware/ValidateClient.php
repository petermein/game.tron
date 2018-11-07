<?php

namespace App\Http\Middleware;

use App\Exceptions\TronException;
use App\Models\User;
use App\Traits\HashIds;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use League\OAuth2\Server\Exception\OAuthServerException;

class ValidateClient
{
    use HashIds;

    /**
     * @var Guard
     */
    private $auth;

    protected $header = 'x-client-token';

    /**
     * ValidateClient constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     * @throws OAuthServerException
     * @throws TronException
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        /** @var User $user */
        if ($user = $this->auth->user()) {
            if (!$request->hasHeader($this->header)) {
                throw new TronException('Missing client header');
            }

            $token = $request->header($this->header);

            if (empty($id = $this->decode($token))) {
                throw new TronException('Invalid client header');
            }

            $user->setCurrentGameClientId($id);
            $user->currentGameClient()->touchLastContact();
            $user->team->touchLastContact();
        } else {
            throw new TronException('No logged in user');
        }

        return $next($request);
    }
}
