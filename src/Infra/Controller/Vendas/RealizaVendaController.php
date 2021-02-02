<?php

namespace Estoque\Infra\Controller\Vendas;

use Estoque\Application\GerenciarVenda;
use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\InputHelper;
use Estoque\Helpers\RedirectTrait;
use Estoque\Infra\Controller\Controller;

class RealizaVendaController implements Controller
{
    use RedirectTrait;

    private RepositorioEstoque $repositorioEstoque;
    private RepositorioVendas $repositorioVendas;
    private GerenciarVenda $gerenciarVenda;

    public function __construct(RepositorioEstoque $repositorioEstoque, RepositorioVendas $repositorioVendas)
    {
        $this->repositorioEstoque = $repositorioEstoque;
        $this->repositorioVendas = $repositorioVendas;
        $this->gerenciarVenda = new GerenciarVenda($this->repositorioVendas, $this->repositorioEstoque);
    }

    public function processRequest(): void
    {
        InputHelper::sanitizePost();

        if (isset($_POST['acao'])) {
            $this->gerenciarVenda->adicionar($_POST);
        }
        $this->redirect("/estoque");
    }
}