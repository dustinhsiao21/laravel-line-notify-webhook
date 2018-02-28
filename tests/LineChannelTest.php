<?php

namespace DH21\LineNotify\Test;

use Mockery;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase;
use Illuminate\Notifications\Notification;
use DH21\LineNotify\LineMessage;
use DH21\LineNotify\LineChannel;
use DH21\LineNotify\Tests\UnitClass\TestNotifiable;
use DH21\LineNotify\Tests\UnitClass\TestNotification;

class LineChannelTest extends TestCase
{
    /** @test */
    public function testSend()
    {
        $response = new Response(200);
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('post')
            ->once()
            ->with(LineChannel::END_POINT, [
                'headers' => [
                    'Authorization' => 'Bearer ' .TestNotifiable::TOKEN,
                ],
                'form_params' => [
                    'message' => 'foo',
                ]
            ])
            ->andReturn($response);
        $channel = new LineChannel($client);
        $channel->send(new TestNotifiable(), new TestNotification());
    }

    /**
    * @expectedException Exception
    * @test
    */
    public function testSendFail()
    {
        $response = new Response(500);
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('post')
            ->once()
            ->andReturn($response);
        $channel = new LineChannel($client);
        $channel->send(new TestNotifiable(), new TestNotification());
    }
}
