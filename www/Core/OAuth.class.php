<?php

namespace App\Core;

class OAuth
{
    private $token;
    private $urlOAuth;
    private $urlInfo;
    private $client_id;
    private $client_secret;
    private $response;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function google()
    {
        $this->urlOAuth = URL_API_OAUTH_GOOGLE;
        $this->urlInfo = URL_API_INFO_GOOGLE;
        $this->client_id = PUBLIC_KEY_GOOGLE;
        $this->client_secret = PRIVATE_KEY_GOOGLE;
        $this->getToken(REDIRECT_URI_GOOGLE);
        $this->getInfo();

        return $this->response;
    }

    public function facebook()
    {
        $this->urlOAuth = URL_API_OAUTH_FACEBOOK;
        $this->urlInfo = URL_API_INFO_FACEBOOK;
        $this->client_id = PUBLIC_KEY_FACEBOOK;
        $this->client_secret = PRIVATE_KEY_FACEBOOK;
        $this->getToken(REDIRECT_URI_FACEBOOK);
        $this->getInfo();

        return $this->response;
    }

    private function getToken(string $redirect_uri)
    {
        $params = [
            'code' => $this->token,
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $redirect_uri,
            'grant_type' => 'authorization_code'
        ];

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_POST => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_NOBODY => false,
                CURLOPT_URL =>  $this->urlOAuth,
                CURLOPT_POSTFIELDS => $params,
            ]
        );
        $data = curl_exec($curl);

        if ($data === false) {
            die('Une erreur de traitement est survenue, merci de réessayer plus tard');
        } else {
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
                $response = json_decode($data);
                $this->token = $response->access_token;
            } else {
                die('La récupération du Token a échoué');
            }
        }
        curl_close($curl);
    }

    private function getInfo()
    {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL => $this->urlInfo,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => [
                    "Authorization: Bearer {$this->token}"
                ],
            ]
        );
        $data = curl_exec($curl);

        if ($data === false) {
            die('Une erreur de traitement est survenue, merci de réessayer plus tard');
        } else {
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
                $this->response = json_decode($data);
            } else {
                die('La récupération des informations a échoué');
            }
        }
        curl_close($curl);
    }
}
