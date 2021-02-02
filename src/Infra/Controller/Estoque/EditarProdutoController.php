<?php

namespace Estoque\Infra\Controller\Estoque;

use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\HtmlRenderTrait;
use Estoque\Helpers\InputHelper;
use Estoque\Infra\Controller\Controller;

class EditarProdutoController implements Controller
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

        echo $this->htmlRender('pages/editarProduto.php', [
            'produto' => $produto,
            'id' => $id
        ]);
    }
}