<?php

namespace dustinhsiao21\LineNotify\Test;

use Mockery;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase;
use Illuminate\Notifications\Notification;
use dustinhsiao21\LineNotify\LineMessage;
use dustinhsiao21\LineNotify\LineChannel;
use dustinhsiao21\LineNotify\Tests\UnitClass\TestNotifiable;
use dustinhsiao21\LineNotify\Tests\UnitClass\TestNotification;

class LineChannelTest extends TestCase
{
    private $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = Mockery::mock(client::class);
    }

    /** @test */
    public function testSend()
    {
        $response = new Response(200);
        $this->client->shouldReceive('post')
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

        $channel = new LineChannel($this->client);
        $channel->send(new TestNotifiable(), new TestNotification());
    }

    /**
    * @expectedException Exception
    * @test
    */
    public function testSendFail()
    {
        $response = new Response(500);
        $this->client->shouldReceive('post')
            ->once()
            ->andReturn($response);

        $channel = new LineChannel($this->client);
        $channel->send(new TestNotifiable(), new TestNotification());
    }
}
