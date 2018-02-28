<?php

namespace DH21\LineNotify;

class LineMessage
{
    public $message;

    public function message(string $message)
    {
        $this->message = $message;
        return $this;
    }
}