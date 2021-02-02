<?php

namespace Estoque\Infra\Controller\Vendas;

use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\HtmlRenderTrait;
use Estoque\Helpers\InputHelper;
use Estoque\Infra\Controller\Controller;

class VenderProdutoController implements Controller
{
    use HtmlRenderTrait;

    private RepositorioEstoque $repositorioEstoque;
    private RepositorioVendas $repositorioVendas;

    public function __construct(RepositorioEstoque $repositorioEstoque, RepositorioVendas $repositorioVendas)
    {
        $this->repositorioEstoque = $repositorioEstoque;
        $this->repositorioVendas = $repositorioVendas;
    }

    public function processRequest(): void
    {
        InputHelper::sanitizeGet();

        $id = $_GET['id'];
        $produto = $this->repositorioEstoque->pegarItemPeloId($id);

        echo $this->htmlRender('pages/venderProduto.php', [
            'produto' => $produto,
        ]);
    }
}