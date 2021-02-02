<?php

namespace Estoque\Helpers;

trait FleshMessageTrait
{
    public function defineMessagem(string $type, string $message): void
    {
        $_SESSION['message_type'] = $type;
        $_SESSION['message'] = $message;
    }
}