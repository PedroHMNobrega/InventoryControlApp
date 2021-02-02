<?php

namespace Estoque\Domain;

class ItemVendido
{
    private ?int $idVenda;
    private string $nomeProduto;
    private float $valorVenda;
    private int $quantidadeVendido;
    private int $idDoProduto;
    private \DateTimeImmutable $dataVenda;

    public function __construct(?int $idVenda, string $nomeProduto, float $valorVenda, int $quantidadeVendido, int $idDoProduto, string $dataVendaString)
    {
        $this->idVenda = $idVenda;
        $this->nomeProduto = $nomeProduto;
        $this->valorVenda = $valorVenda;
        $this->quantidadeVendido = $quantidadeVendido;
        $this->idDoProduto = $idDoProduto;
        $this->dataVenda = \DateTimeImmutable::createFromFormat('Y-m-d', $dataVendaString);
    }

    public function getNomeProduto(): string
    {
        return $this->nomeProduto;
    }

    public function getValorVenda(): float
    {
        return $this->valorVenda;
    }

    public function getQuantidadeVendido(): int
    {
        return $this->quantidadeVendido;
    }

    public function getDataVendaFormatada(): string
    {
        return $this->dataVenda->format('d/m/Y');
    }

    public function getDataVendaFormatadaParaDataBase(): string
    {
        return $this->dataVenda->format('Y-m-d');
    }

    public function getIdDoProduto(): int
    {
        return $this->idDoProduto;
    }

    public function getIdVenda(): ?int
    {
        return $this->idVenda;
    }
}