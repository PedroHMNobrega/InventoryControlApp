<?php

namespace Estoque\Infra\Controller;

use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\HtmlRenderTrait;
use Estoque\Helpers\MoneyFormatTrait;

class HomeController implements Controller
{
    use HtmlRenderTrait;
    use MoneyFormatTrait;

    private RepositorioEstoque $repositorioEstoque;
    private RepositorioVendas $repositorioVendas;

    public function __construct(RepositorioEstoque $repositorioEstoque, RepositorioVendas $repositorioVendas)
    {
        $this->repositorioEstoque = $repositorioEstoque;
        $this->repositorioVendas = $repositorioVendas;
    }

    public function processRequest(): void
    {
        echo $this->htmlRender('pages/home.php', [
            'itensEmEstoque' => $this->repositorioEstoque->quantidadeDeItensDisponiveis(),
            'vendasDoMes' => $this->repositorioVendas->vendasDoMes(),
            'itensEmFalta' => $this->repositorioEstoque->quantidadeDeItensEmFalta(),
            'valorTotalVendido' => $this->toMoneyFormat($this->repositorioVendas->valorVendidoMesAtual()),
            'valorTotalEstoque' => $this->toMoneyFormat($this->repositorioEstoque->valorTotalEmEstoque())
        ]);
    }
}