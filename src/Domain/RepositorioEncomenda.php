<?php

namespace Estoque\Domain;

interface RepositorioEncomenda
{
    public function __construct(string $tableName, \PDO $conexao);
    public function editar(int $id, array $coluns): bool;
    public function adicionar(Encomenda $encomenda): bool;
    public function getProximoOrderId(): int;
    public function remover(int $id): bool;
    public function selecionarOrdenado(): array;
    public function pegaUltimo(): Encomenda;
}