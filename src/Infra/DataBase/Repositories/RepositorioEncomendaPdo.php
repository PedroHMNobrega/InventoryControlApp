<?php

namespace Estoque\Infra\DataBase\Repositories;

use Estoque\Domain\Encomenda;
use Estoque\Domain\RepositorioEncomenda;

class RepositorioEncomendaPdo implements RepositorioEncomenda
{
    private string $tableName;
    private \PDO $conexao;

    public function __construct(string $tableName, \PDO $conexao)
    {
        $this->tableName = $tableName;
        $this->conexao = $conexao;
    }

    public function editar(int $id, array $columns): bool
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

    public function adicionar(Encomenda $encomenda): bool
    {
        $sql = "INSERT INTO `$this->tableName`
                VALUES (null, :nome, :status, :order_id)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('nome', $encomenda->getNome());
        $stmt->bindValue('status', $encomenda->getStatus());
        $stmt->bindValue('order_id', $encomenda->getOrderId());

        if($stmt->execute()) return true;
        return false;
    }

    public function getProximoOrderId(): int
    {
        $order_id = $this->conexao->prepare("SELECT MAX(order_id) FROM `$this->tableName`");
        $order_id->execute();
        $order_id = $order_id->fetchColumn();
        return $order_id+1;
    }

    public function remover(int $id): bool
    {
        $sql = $this->conexao->prepare("DELETE FROM `$this->tableName` WHERE id = ?");
        if($sql->execute([$id])) return true;
        return false;
    }

    public function selecionarOrdenado(): array
    {
        $encomendasPdo = $this->conexao->prepare("SELECT * FROM `$this->tableName` ORDER BY `order_id`");
        $encomendasPdo->execute();
        $encomendasPdo = $encomendasPdo->fetchAll();
        return $this->getEncomendasFromDataBase($encomendasPdo);
    }

    public function pegaUltimo(): Encomenda
    {
        $encomendaPdo = $this->conexao->prepare("SELECT * FROM `$this->tableName` ORDER BY id DESC LIMIT 1");
        $encomendaPdo->execute();
        $encomendaPdo = $encomendaPdo->fetchAll();
        return $this->getEncomendasFromDataBase($encomendaPdo)[0];
    }

    private function getEncomendasFromDataBase(array $encomendasPdo): array
    {
        /** @var Encomenda[] $encomendas */
        $encomendas = [];
        foreach ($encomendasPdo as $key => $encomenda) {
            $encomendas[] = new Encomenda(
                $encomenda['id'],
                $encomenda['nome'],
                $encomenda['status'],
                $encomenda['order_id']
            );
        }
        return $encomendas;
    }
}