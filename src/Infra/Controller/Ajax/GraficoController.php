<?php

namespace Estoque\Infra\Controller\Ajax;

use Estoque\Domain\RepositorioEstoque;
use Estoque\Domain\RepositorioVendas;
use Estoque\Helpers\InputHelper;
use Estoque\Infra\Controller\Controller;

class GraficoController implements Controller
{
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

        if(isset($_POST['pegaVenda'])) {
            $valores = $this->repositorioVendas->valorVendidoPorMes();
            die(json_encode($valores));
        }
    }
}