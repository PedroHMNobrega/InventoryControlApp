<?php

namespace Estoque\Infra\Controller\Estoque;

use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\FleshMessageTrait;
use Estoque\Helpers\HtmlRenderTrait;
use Estoque\Helpers\InputHelper;
use Estoque\Helpers\MoneyFormatTrait;
use Estoque\Infra\Controller\Controller;

class EstoqueController implements Controller
{
    use HtmlRenderTrait;
    use FleshMessageTrait;
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
        InputHelper::sanitizePost();
        InputHelper::sanitizeGet();

        if (isset($_POST['acao-buscar']) && $_POST['busca'] != '') {
            $produtos = $this->repositorioEstoque->buscarItensPorNome($_POST['busca']);
        } else if (isset($_GET['falta'])) {
            $produtos = $this->repositorioEstoque->itensEmFalta();
        } else {
            $produtos = $this->repositorioEstoque->itensDisponiveis();
        }

        echo $this->htmlRender('pages/estoque.php', [
            'produtos' => $produtos
        ]);
    }
}