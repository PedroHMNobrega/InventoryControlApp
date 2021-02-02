<?php

namespace Estoque\Domain;

class Encomenda
{
    private ?int $id;
    private string $nome;
    private int $status;
    private int $order_id;

    public function __construct(?int $id, string $nome, int $status, int $order_id)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->status = $status;
        $this->order_id = $order_id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }
}