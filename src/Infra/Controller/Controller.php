<?php

namespace Estoque\Infra\Controller;

interface Controller
{
    public function processRequest(): void;
}