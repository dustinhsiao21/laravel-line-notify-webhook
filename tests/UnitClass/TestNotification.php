<?php

namespace dustinhsiao21\LineNotify\Tests\UnitClass;

use Illuminate\Notifications\Notification;
use dustinhsiao21\LineNotify\LineMessage;

class TestNotification extends Notification
{
    public function toLine($notifiable)
    {
        return (new LineMessage())->message('foo');
    }
}