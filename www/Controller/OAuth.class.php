<?php

namespace App\Controller;

class OAuth {
    private $token;
    private $urlOAuth;
    private $urlInfo;
    private $client_id;
    private $client_secret;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function google ()
    {
        $this->urlOAuth = URL_API_OAUTH_GOOGLE;
        $this->urlInfo = URL_API_INFO_GOOGLE;
        $this->client_id = PUBLIC_KEY_GOOGLE;
        $this->client_secret = PRIVATE_KEY_GOOGLE;
    }

    public function facebook ()
    {

    }

    private function getToken ()
    {
        $params = [
            'code' => $this->token,
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => REDIRECT_URI,
            'grant_type' => 'authorization_code'
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_NOBODY => false,
            CURLOPT_URL =>  $this->urlOAuth,
            CURLOPT_POSTFIELDS => $params,
        ]);
        $data = curl_exec($curl);

        if ($data === false) die('Une erreur de traitement est survenue, merci de réessayer plus tard');
        else {
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
                $response = json_decode($data);
                $this->token = $response->access_token;
            } else die('La connexion a échoué');
        }
        curl_close($curl);
    }

    private function getInfo ()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
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
        ]);
        $data = curl_exec($curl);

        if ($data === false) die('Une erreur de traitement est survenue, merci de réessayer plus tard');
        else {
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
                $response = json_decode($data);
                var_dump($response);
            } else die('La connexion a échoué');
        }
        curl_close($curl);
    }
}