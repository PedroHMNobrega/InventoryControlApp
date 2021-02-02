<?php

namespace Estoque\Infra\DataBase\Repositories;

use Estoque\Domain\ItemVendido;
use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;

class RepositorioVendasPdo implements RepositorioVendas
{
    private string $tableName;
    private \PDO $conexao;

    public function __construct(string $tableName, \PDO $conexao)
    {
        $this->tableName = $tableName;
        $this->conexao = $conexao;
    }

    /** @return ItemVendido[] */
    public function todasAsVendas(): array
    {
        $vendasPdo = $this->conexao->prepare("SELECT * FROM `$this->tableName` ORDER BY `data` DESC, id DESC");
        $vendasPdo->execute();
        $vendasPdo = $vendasPdo->fetchAll();
        return $this->getVendasFromDataBase($vendasPdo);
    }

    /** @return ItemVendido[] */
    public function vendasDoMes(): array
    {
        $vendasPdo = $this->conexao->prepare("SELECT * FROM `$this->tableName` WHERE MONTH(`data`) = MONTH(CURRENT_DATE()) AND YEAR(`data`) = YEAR(CURRENT_DATE()) ORDER BY `data` DESC, `id` DESC");
        $vendasPdo->execute();
        $vendasPdo = $vendasPdo->fetchAll();
        return $this->getVendasFromDataBase($vendasPdo);
    }

    public function valorVendidoTotal(): float
    {
        $totalVendido = $this->conexao->prepare("SELECT SUM(valor) FROM `$this->tableName`");
        $totalVendido->execute();
        $totalVendido = $totalVendido->fetch()[0];
        return is_null($totalVendido) ? 0 : $totalVendido;
    }

    public function valorVendidoMesAtual(): float
    {
        $totalVendido = $this->conexao->prepare("SELECT SUM(valor) FROM `$this->tableName`  WHERE MONTH(`data`) = MONTH(CURRENT_DATE()) AND YEAR(`data`) = YEAR(CURRENT_DATE())");
        $totalVendido->execute();
        $totalVendido = $totalVendido->fetch()[0];
        return is_null($totalVendido) ? 0 : $totalVendido;
    }

    public function valorVendidoPorMes(): array
    {
        $valores = [];
        for($i = 1; $i <= 12; $i++) {
            $valor = $this->valorVendidoMes($i);
            if($valor) {
                $valores[] = (int)$valor;
            } else {
                $valores[] = 0;
            }
        }
        return $valores;
    }

    public function valorVendidoMes(int $mes): float
    {
        $totalVendido = $this->conexao->prepare("SELECT SUM(valor) FROM `$this->tableName`  WHERE MONTH(`data`) = ? AND YEAR(`data`) = YEAR(CURRENT_DATE())");
        $totalVendido->execute([$mes]);
        $totalVendido = $totalVendido->fetch()[0];
        return is_null($totalVendido) ? 0 : $totalVendido;
    }

    public function adicionarVenda(ItemVendido $item): bool
    {
        $sql = "INSERT INTO `$this->tableName` 
                VALUES (null, :nome, :valor, :quantidade, :id_produto, :data)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('nome', $item->getNomeProduto());
        $stmt->bindValue('valor', $item->getValorVenda());
        $stmt->bindValue('quantidade', $item->getQuantidadeVendido());
        $stmt->bindValue('id_produto', $item->getIdDoProduto());
        $stmt->bindValue('data', $item->getDataVendaFormatadaParaDataBase());
        if($stmt->execute()) return true;
        return false;
    }

    public function remover(string $idVenda, string $idProduto, int $quantidade, RepositorioEstoque $repositorioEstoque): bool
    {
        $sql = $this->conexao->prepare("DELETE FROM `$this->tableName` WHERE id = ?");
        if($sql->execute([$idVenda])) {
            $produto = $repositorioEstoque->pegarItemPeloId($idProduto);
            if(!is_null($produto)) {
                $quantidade = $produto->getQuantidade() + $quantidade;
                $repositorioEstoque->editarItem($idProduto, ['quantidade' => $quantidade]);
            }
            return true;
        }
        return false;
    }

    /**
     * @param \PDOStatement $vendasPdo
     * @return ItemVendido[]
     */
    private function getVendasFromDataBase(array $vendasPdo): array
    {
        /** @var ItemVendido[] $vendas */
        $vendas = [];
        foreach ($vendasPdo as $key => $venda) {
            $vendas[] = new ItemVendido(
                $venda['id'],
                $venda['nome'],
                $venda['valor'],
                $venda['quantidade'],
                $venda['id_produto'],
                $venda['data']
            );
        }
        return $vendas;
    }
}