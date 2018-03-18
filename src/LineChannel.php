<?php

namespace dustinhsiao21\LineNotify;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class LineChannel
{
	protected $client;

	const END_POINT = 'https://notify-api.line.me/api/notify';

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function send($notifiable, Notification $notification)
	{
		if (!$token = $notifiable->routeNotificationFor('Line')){
			return;
		}

		$data = $notification->toLine($notifiable);

		$response = $this->client->post(self::END_POINT, [
			'headers' => [
				'Authorization' => 'Bearer ' . $token,
			],
			'form_params' => [
				'message' => $data->message,
			]
		]);

		if ($response->getStatusCode() >= 300 || $response->getStatusCode() < 200) {
            throw new \Exception($response->getBody()->getContents());
        }
	}
}

