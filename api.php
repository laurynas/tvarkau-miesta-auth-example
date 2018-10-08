<?php

class API
{
    public $base_uri = 'https://api.tvarkaumiesta.lt/';

    public function __construct($oauthProvider, $accessToken)
    {
        $this->provider = $oauthProvider;
        $this->token = $accessToken;
    }

    public function getCurrentUser()
    {
        return $this->request('GET', 'me')->user;
    }

    protected function request($method, $path, $params = array())
    {
        $uri = $this->uri($path);
        $request = $this->provider->getAuthenticatedRequest($method, $uri, $this->token);
        $response = $this->provider->getResponse($request);

        return json_decode($response->getBody());
    }

    protected function uri($path) {
        return $this->base_uri . $path;
    }
}
