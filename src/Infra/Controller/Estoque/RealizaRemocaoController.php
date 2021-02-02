<?php

namespace Estoque\Infra\Controller\Estoque;

use Estoque\Application\GerenciarProduto;
use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\FleshMessageTrait;
use Estoque\Helpers\InputHelper;
use Estoque\Helpers\RedirectTrait;
use Estoque\Infra\Controller\Controller;

class RealizaRemocaoController implements Controller
{
    use FleshMessageTrait;
    use RedirectTrait;

    private RepositorioEstoque $repositorioEstoque;
    private RepositorioVendas $repositorioVendas;
    private GerenciarProduto $gerenciarProduto;

    public function __construct(RepositorioEstoque $repositorioEstoque, RepositorioVendas $repositorioVendas)
    {
        $this->repositorioEstoque = $repositorioEstoque;
        $this->repositorioVendas = $repositorioVendas;
        $this->gerenciarProduto = new GerenciarProduto($this->repositorioEstoque);
    }

    public function processRequest(): void
    {
        InputHelper::sanitizeGet();

        $id = $_GET['id'];
        if($this->gerenciarProduto->remover($id)) {
            $this->defineMessagem('sucesso', 'Produto Editado Com Sucesso!');
            $this->redirect('/estoque');
        } else {
            $this->defineMessagem('erro', 'Erro ao Remover Produto. Tente Novamente.');
            $this->redirect('/editarProduto?id=' . $id);
        }
    }
}