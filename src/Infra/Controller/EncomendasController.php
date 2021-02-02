<?php

namespace Estoque\Infra\Controller;

use Estoque\Domain\RepositorioEncomenda;
use Estoque\Helpers\HtmlRenderTrait;

class EncomendasController implements Controller
{
    use HtmlRenderTrait;

    private RepositorioEncomenda $repositorioEncomenda;

    public function __construct(RepositorioEncomenda $repositorioEncomenda)
    {
        $this->repositorioEncomenda = $repositorioEncomenda;
    }

    public function processRequest(): void
    {
        echo $this->htmlRender('pages/encomendas.php', [
            'encomendas' => $this->repositorioEncomenda->selecionarOrdenado()
        ]);
    }
}