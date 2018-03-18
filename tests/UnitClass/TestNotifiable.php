<?php

namespace dustinhsiao21\LineNotify\Tests\UnitClass;

class TestNotifiable
{
    use \Illuminate\Notifications\Notifiable;

    const TOKEN = 'thisisforlinenotifytoken';

    /**
     * @return int
     */
    public function routeNotificationForLine()
    {
        return self::TOKEN;
    }
}
