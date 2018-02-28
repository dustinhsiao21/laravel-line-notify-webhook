<?php

namespace DH21\LineNotify\Test;

use Orchestra\Testbench\TestCase;
use DH21\LineNotify\LineMessage;

class MessageTest extends TestCase
{
    protected $message;

    public function setUp()
    {
        parent::setUp();
        $this->message = new LineMessage();
    }

    /** @test */
    public function testMessage()
    {
        $expected = 'foo';
        $message = $this->message->message($expected);
        $this->assertEquals($expected, $message->message);
    }
}

