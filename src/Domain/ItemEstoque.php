<?php

namespace Estoque\Domain;

class ItemEstoque
{
    private ?int $id;
    private string $nome;
    private string $descricao;
    private float $valor;
    private int $quantidade;
    private ?string $imagePath;

    public function __construct(?int $id, string $name, string $descricao, float $valor, int $quantidade, ?string $imagePath)
    {
        $this->id = $id;
        $this->nome = $name;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->quantidade = $quantidade;
        $this->imagePath = $imagePath;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }
}