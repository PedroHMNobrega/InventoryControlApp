<?php

namespace Estoque\Infra\Controller\Vendas;

use Estoque\Domain\ItemVendido;
use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\HtmlRenderTrait;
use Estoque\Helpers\MoneyFormatTrait;
use Estoque\Infra\Controller\Controller;

class VendasController implements Controller
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
        /** @var ItemVendido[] $vendas */
        $vendas = $this->repositorioVendas->todasAsVendas();
        $totalVendido = $this->toMoneyFormat($this->repositorioVendas->valorVendidoTotal());

        echo $this->htmlRender('pages/vendas.php', [
            'vendas' => $vendas,
            'totalVendido' => $totalVendido
        ]);
    }

    private function getRedirectUrl(ItemVendido $venda) {
        return INCLUDE_PATH . "/realizaRemocaoVenda?" .
            "delete=" . $venda->getIdVenda() .
            "&qnt=" . $venda->getQuantidadeVendido() .
            "&id=" . $venda->getIdDoProduto();
    }
}