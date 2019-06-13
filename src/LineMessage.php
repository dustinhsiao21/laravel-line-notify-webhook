<?php

namespace dustinhsiao21\LineNotify;

class LineMessage
{
    public $message;

    /**
     * message.
     *
     * @param string $message
     *
     * @return void
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }
}
