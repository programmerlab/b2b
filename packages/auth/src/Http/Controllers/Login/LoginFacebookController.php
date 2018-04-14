<?php

namespace Ribrit\Auth\Http\Controllers\Login;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use League\OAuth1\Client\Credentials\CredentialsException;
use Ribrit\Auth\Http\Controllers\AuthController;
use Ribrit\Auth\Http\Requests\Login\Facebook\LoginFacebookRelatedRequest as RelatedRequest;
use Ribrit\Mars\Database\Contracts\User\UserContract;

class LoginFacebookController extends AuthController
{
    public function __construct(UserContract $contract)
    {
        parent::__construct();

        if (tenant_site('facebook_active') != 'yes') {
            abort(500);
        }

        $this->contract = $contract;
    }

    public function getIndex()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function getRelated(RelatedRequest $request)
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $exception) {
            return redirect(route_action('index'));
        } catch (CredentialsException $exception) {
            return redirect(route_action('index'));
        } catch (ClientException $exception) {
            return redirect(route_action('index'));
        } catch (InvalidStateException $exception) {
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
        return $this->contract->userFacebook($request, $user);
    }
}