<?php

namespace Estoque\Helpers;

trait MoneyFormatTrait
{
    private function toMoneyFormat(float $value): string
    {
        return 'R$ '.number_format($value, 2, ',', '.')    ;
    }
}