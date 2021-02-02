<?php

namespace Estoque\Helpers;

trait RedirectTrait
{
    private function redirect(string $location): void
    {
        header("Location: " . INCLUDE_PATH . $location , true, 302);
        exit();
    }
}