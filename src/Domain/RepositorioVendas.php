<?php

namespace Estoque\Domain;

interface RepositorioVendas
{
    public function __construct(string $tableName, \PDO $conexao);
    public function todasAsVendas(): array;
    public function vendasDoMes(): array;
    public function valorVendidoTotal(): float;
    public function valorVendidoMesAtual(): float;
    public function valorVendidoPorMes(): array;
    public function valorVendidoMes(int $mes): float;
    public function adicionarVenda(ItemVendido $itemVendido): bool;
    public function remover(string $idVenda,
                            string $idProduto,
                            int $quantidade,
                            RepositorioEstoque $repositorioEstoque): bool;
}