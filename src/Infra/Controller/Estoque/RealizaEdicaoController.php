<?php

namespace Estoque\Infra\Controller\Estoque;

use Estoque\Application\GerenciarProduto;
use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\FleshMessageTrait;
use Estoque\Helpers\InputHelper;
use Estoque\Helpers\RedirectTrait;
use Estoque\Infra\Controller\Controller;

class RealizaEdicaoController implements Controller
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
        InputHelper::sanitizePost();

        if(!isset($_POST['id'])) {
            $this->defineMessagem('erro', 'Ocorreu um Erro ao Editar o Produto. Tente Novamente!');
            $this->redirect("/estoque");
        }

        $this->gerenciarProduto->editar($_POST);
    }
}