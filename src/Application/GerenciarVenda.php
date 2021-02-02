<?php

namespace Estoque\Application;

use Estoque\Domain\ItemVendido;
use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\FleshMessageTrait;
use Estoque\Helpers\RedirectTrait;

class GerenciarVenda
{
    use FleshMessageTrait;
    use RedirectTrait;

    private RepositorioVendas $repositorioVendas;
    private RepositorioEstoque $repositorioEstoque;

    public function __construct(RepositorioVendas $repositorioVendas, RepositorioEstoque $repositorioEstoque)
    {
        $this->repositorioVendas = $repositorioVendas;
        $this->repositorioEstoque = $repositorioEstoque;
    }

    public function remover(string $idVenda, int $quantidade, string $idProduto): bool
    {
        //TODO: Implementar Trasacao PDO
        return $this->repositorioVendas->remover($idVenda, $idProduto, $quantidade, $this->repositorioEstoque);
    }

    public function adicionar(array $dados): void
    {
        $id = $dados['id_produto'];
        $produto = $this->repositorioEstoque->pegarItemPeloId($id);

        if ($dados['quantidade'] > $produto->getQuantidade()) {
            $this->defineMessagem('erro', 'Quantidade Adicionada Maior que o Estoque. Tente Novamente.');
            $this->redirect("/venderProduto?id=" . $id);
        }

        if ($dados['valor'][0] == 'R') {
            $dados['valor'] = $this->ajustaValor($dados['valor']);
        }

        $valor = $dados['valor'] * $dados['quantidade'];
        $data = date('Y-m-d');
        $item = new ItemVendido(
            null,
            $dados['nome'],
            $valor,
            $dados['quantidade'],
            $dados['id_produto'],
            $data,
        );

        if (!$this->repositorioVendas->adicionarVenda($item)) {
            $this->defineMessagem('erro', 'Erro ao Confirmar a Venda. Tente Novamente!');
            $this->redirect("/venderProduto?id=" . $id);
        }

        $quantidadeAtual = $produto->getQuantidade() - $_POST['quantidade'];
        $this->repositorioEstoque->editarItem($id, ['quantidade' => $quantidadeAtual]);
        $this->defineMessagem('sucesso', 'Venda Realizada Com Sucesso!');
    }

    private function ajustaValor(string $valor): string
    {
        $valor = preg_replace('/[.R$]/', '', $valor);
        return str_replace(',', '.', $valor);
    }
}