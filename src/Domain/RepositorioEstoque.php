<?php

namespace Estoque\Domain;

interface RepositorioEstoque
{
    public function __construct(string $tableName, \PDO $conexao);
    public function quantidadeDeItensDisponiveis(): int;
    public function quantidadeDeItensEmFalta(): int;
    public function valorTotalEmEstoque(): float;
    public function itensDisponiveis(): array;
    public function itensEmFalta(): array;
    public function buscarItensPorNome(string $criterio): array;
    public function pegarItemPeloId(string $id): ?ItemEstoque;
    public function editarItem(string $id, array $columns): bool;
    public function removerItem(string $id): bool;
    public function adicionarItem(ItemEstoque $item): bool;
}