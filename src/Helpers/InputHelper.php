<?php

namespace Estoque\Helpers;

class InputHelper
{
    public static function sanitizeVar(string $inputRaw): string
    {
        return filter_var($inputRaw, FILTER_SANITIZE_STRING);
    }

    public static function sanitizePost(): void
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    }

    public static function sanitizeGet(): void
    {
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    }
}