<?php

namespace App\Services\PushAll;

use GuzzleHttp\Client;

abstract class AbstractPushAll
{
    private $id;
    private $apiKey;
    protected $type;
    protected $apiUrl = "https://pushall.ru/api.php";

    public function __construct($apiKey, $selfId)
    {
        $this->apiKey = $apiKey;
        $this->id = $selfId;
    }

    public function send(string $title, string $text)
    {
        $client = new Client(['verify' => false]);

        return $client->request('POST', $this->apiUrl, [
            'form_params' => [
                "type" => $this->type,
                "id" => $this->id,
                "key" => $this->apiKey,
                "text" => $text,
                "title" => $title
            ]
        ]);
    }
}
