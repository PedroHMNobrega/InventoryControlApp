<?php

namespace Estoque\Infra\Controller\Vendas;

use Estoque\Application\GerenciarVenda;
use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\FleshMessageTrait;
use Estoque\Helpers\InputHelper;
use Estoque\Helpers\RedirectTrait;
use Estoque\Infra\Controller\Controller;

class RealizaRemocaoVendaController implements Controller
{
    use FleshMessageTrait;
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
        InputHelper::sanitizeGet();

        if (isset($_GET['delete'])) {
            if ($this->gerenciarVenda->remover($_GET['delete'], $_GET['qnt'], $_GET['id'])) {
                $this->defineMessagem('sucesso', 'Venda Deletada com Sucesso!');
            } else {
                $this->defineMessagem('erro', 'Erro ao Deletar a Venda. Tente Novamente.');
            }
        }
        $this->redirect('/vendas');
    }
}