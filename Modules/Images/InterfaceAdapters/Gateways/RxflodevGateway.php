<?php

namespace Modules\Images\InterfaceAdapters\Gateways;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class RxflodevGateway
{
    private $client;

    private const BASE_URL = 'https://test.rxflodev.com';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function postImage(string $base64): string
    {
        $response = $this->client->request('POST', static::BASE_URL, [
            'form_params' => [
                'imageData' => $base64,
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]
        ])->getBody()->getContents();

        $response = json_decode($response, true);

        if (isset($response['status']) && $response['status'] == 'success' && !empty($response['url'])) {
            if (!Session::exists('uploadedImages')) {
                Session::put('uploadedImages', []);
            }

            Session::push('uploadedImages', $response['url']);

            return $response['url'];
        }
    }

    private function constructUrl(string $resource): string
    {
        return static::BASE_URL . $resource;
    }

}
