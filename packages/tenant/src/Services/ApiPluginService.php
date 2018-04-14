<?php

namespace Ribrit\Tenant\Services;

use GuzzleHttp\Client;

class ApiPluginService extends PluginService
{
    /**
     * Hizmet servisi
     *
     * @var
     */
    protected $client;

    /**
     * İşlem yapılacak adres
     *
     * @var string
     */
    protected $uri = '';

    public function __construct()
    {
        $this->client = new Client();
    }
}