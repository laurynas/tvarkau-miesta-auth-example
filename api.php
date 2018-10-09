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

    public function revokeToken()
    {
        $params = ['token' => $this->token->getToken()];
        $options = ['body' => http_build_query($params)];

        return $this->request('POST', 'oauth/revoke', $options);
    }

    protected function request($method, $path, $options = array())
    {
        $uri = $this->uri($path);
        $request = $this->provider->getAuthenticatedRequest($method, $uri, $this->token, $options);
        $response = $this->provider->getResponse($request);

        return json_decode($response->getBody());
    }

    protected function uri($path) {
        return $this->base_uri . $path;
    }
}
