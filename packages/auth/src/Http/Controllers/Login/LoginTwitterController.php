<?php

namespace Ribrit\Auth\Http\Controllers\Login;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;
use League\OAuth1\Client\Credentials\CredentialsException;
use Ribrit\Auth\Http\Controllers\AuthController;
use Ribrit\Auth\Http\Requests\Login\Twitter\LoginTwitterRelatedRequest as RelatedRequest;
use Ribrit\Mars\Database\Contracts\User\UserContract;

class LoginTwitterController extends AuthController
{
    public function __construct(UserContract $contract)
    {
        parent::__construct();

        if (tenant_site('twitter_active') != 'yes') {
            abort(500);
        }

        $this->contract = $contract;
    }

    public function getIndex()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function getRelated(RelatedRequest $request)
    {
        try {
            $user = Socialite::driver('twitter')->user();
        } catch (Exception $exception) {
            return redirect(route_action('index'));
        } catch (CredentialsException $exception) {
            return redirect(route_action('index'));
        }

        if (!$authUser = $this->findOrCreateUser($request, $user)) {
            return redirect(route_name('homeGetIndex'))->withError([
                $this->getLangValue('error.mail')
            ]);
        }

        Auth::login($authUser, true);

        return redirect(route_name('homeGetIndex'))->withSuccess([
            $this->getLangValue('success.social')
        ]);
    }

    protected function findOrCreateUser($request, $user)
    {
        return $this->contract->userTwitter($request, $user);
    }
}