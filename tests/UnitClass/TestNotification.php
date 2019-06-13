<?php

namespace dustinhsiao21\LineNotify\Tests\UnitClass;

use dustinhsiao21\LineNotify\LineMessage;
use Illuminate\Notifications\Notification;

class TestNotification extends Notification
{
    public function toLine($notifiable)
    {
        return (new LineMessage())->message('foo');
    }
}
