<?php

namespace Estoque\Infra\Controller\Estoque;

use Estoque\Application\GerenciarProduto;
use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\HtmlRenderTrait;
use Estoque\Helpers\InputHelper;
use Estoque\Helpers\MoneyFormatTrait;
use Estoque\Infra\Controller\Controller;

class AdicionarProdutoController implements Controller
{
    use HtmlRenderTrait;
    use MoneyFormatTrait;

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

        $temValor = false;
        if (isset($_POST['acao'])) {
            $temValor = true;
            $this->gerenciarProduto->adicionarProduto($_POST);
        }

        echo $this->htmlRender('pages/adicionarProduto.php', [
            'temValor' => $temValor
        ]);
    }
}