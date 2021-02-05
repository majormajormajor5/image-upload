<?php

namespace Modules\Images\InterfaceAdapters\Gateways;

use GuzzleHttp\Client;

/**
 * Class RxflodevGateway
 * @package Modules\Images\InterfaceAdapters\Gateways
 */
class RxflodevGateway
{
    /**
     * @var Client
     */
    private $client;

    private const BASE_URL = 'https://test.rxflodev.com';

    /**
     * RxflodevGateway constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $base64
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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
            return $response['url'];
        }
    }
}
