<?php

namespace Estoque\Infra\DataBase\Repositories;

use Estoque\Domain\ItemEstoque;
use Estoque\Domain\RepositorioEstoque;

class RepositorioEstoquePdo implements RepositorioEstoque
{
    private string $tableName;
    private \PDO $conexao;

    public function __construct(string $tableName, \PDO $conexao)
    {
        $this->tableName = $tableName;
        $this->conexao = $conexao;
    }

    public function quantidadeDeItensDisponiveis(): int
    {
        $itens = $this->conexao->prepare("SELECT SUM(quantidade) FROM `$this->tableName` WHERE quantidade > 0");
        $itens->execute();
        return $itens->fetch()[0];
    }

    public function quantidadeDeItensEmFalta(): int
    {
        $falta = $this->conexao->prepare("SELECT * FROM `$this->tableName` WHERE quantidade = 0");
        $falta->execute();
        return $falta->rowCount();
    }

    public function valorTotalEmEstoque(): float
    {
        $total = $this->conexao->prepare("SELECT SUM(valor * quantidade) FROM `$this->tableName`");
        $total->execute();
        $total = $total->fetch()[0];
        return is_null($total) ? 0 : $total;
    }

    /** @return ItemEstoque[] */
    public function itensDisponiveis(): array
    {
        $itensPdo = $this->conexao->prepare("SELECT * FROM `$this->tableName` WHERE quantidade > 0 ORDER BY nome");
        $itensPdo->execute();
        $itensPdo = $itensPdo->fetchAll();
        return $this->getItensEstoqueFromDataBase($itensPdo);
    }

    /** @return ItemEstoque[] */
    public function itensEmFalta(): array
    {
        $itensPdo = $this->conexao->prepare("SELECT * FROM `$this->tableName` WHERE quantidade = 0 ORDER BY nome");
        $itensPdo->execute();
        $itensPdo = $itensPdo->fetchAll();
        return $this->getItensEstoqueFromDataBase($itensPdo);
    }

    /** @return ItemEstoque[] */
    public function buscarItensPorNome(string $criterio): array
    {
        $itensPdo = $this->conexao->prepare("SELECT * FROM `$this->tableName` WHERE nome LIKE CONCAT('%', ?, '%') ORDER BY nome");
        $itensPdo->execute([$criterio]);
        $itensPdo = $itensPdo->fetchAll();
        return $this->getItensEstoqueFromDataBase($itensPdo);
    }

    public function pegarItemPeloId(string $id): ?ItemEstoque
    {
        $sql = $this->conexao->prepare("SELECT * FROM `$this->tableName` WHERE id = ?");
        $sql->execute([$id]);
        $itemPdo = $sql->fetch();

        if($itemPdo == false) {
            return null;
        }
            
        return new ItemEstoque(
            $itemPdo['id'],
            $itemPdo['nome'],
            $itemPdo['descricao'],
            $itemPdo['valor'],
            $itemPdo['quantidade'],
            $itemPdo['img']
        );
    }

    public function editarItem(string $id, array $columns): bool
    {
        $query = "UPDATE `$this->tableName` SET ";
        foreach($columns as $name => $value) {
            $query .= $name.' = ?,';
            $itens[] = $value;
        }
        $query = rtrim($query, ',');
        $query .= " WHERE id = ?";
        $itens[] = $id;
        $sql = $this->conexao->prepare($query);
        if($sql->execute($itens)) return true;
        return false;
    }

    public function removerItem(string $id): bool
    {
        $sql = $this->conexao->prepare("DELETE FROM `$this->tableName` WHERE id = ?");
        if($sql->execute([$id])) return true;
        return false;
    }

    public function adicionarItem(ItemEstoque $item): bool
    {
        $sql = "INSERT INTO `$this->tableName` 
                VALUES (null, :nome, :descricao, :valor, :quantidade, :img)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('nome', $item->getNome());
        $stmt->bindValue('descricao', $item->getDescricao());
        $stmt->bindValue('valor', $item->getValor());
        $stmt->bindValue('quantidade', $item->getQuantidade());
        $stmt->bindValue('img', $item->getImagePath());
        if($stmt->execute()) return true;
        return false;
    }

    /**
     * @param array $itensPdo
     * @return ItemEstoque[]
     */
    private function getItensEstoqueFromDataBase(array $itensPdo): array
    {
        /** @var ItemEstoque[] $itens */
        $itens = [];
        foreach ($itensPdo as $key => $item) {
            $itens[] = new ItemEstoque(
                $item['id'],
                $item['nome'],
                $item['descricao'],
                $item['valor'],
                $item['quantidade'],
                $item['img']
            );
        }
        return $itens;
    }
}