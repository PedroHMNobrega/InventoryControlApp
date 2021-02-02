<?php

namespace Estoque\Infra\Controller\Ajax;

use Estoque\Application\GerenciarEncomenda;
use Estoque\Domain\RepositorioEncomenda;
use Estoque\Helpers\InputHelper;
use Estoque\Infra\Controller\Controller;

class HandleEncomendasController implements Controller
{
    private RepositorioEncomenda $repositorioEncomenda;
    private GerenciarEncomenda $gerenciarEncomenda;

    public function __construct(RepositorioEncomenda $repositorioEncomenda)
    {
        $this->repositorioEncomenda = $repositorioEncomenda;
        $this->gerenciarEncomenda = new GerenciarEncomenda($this->repositorioEncomenda);
    }

    public function processRequest(): void
    {
        InputHelper::sanitizePost();

        if(isset($_POST['done']))
            $this->gerenciarEncomenda->editar($_POST['done'], ['status'=> '1']);

        else if(isset($_POST['undone']))
            $this->gerenciarEncomenda->editar($_POST['undone'], ['status'=> '0']);

        else if(isset($_POST['sort']))
            $this->gerenciarEncomenda->ordena($_POST);

        else if(isset($_POST['getTask']))
            $this->gerenciarEncomenda->getTasks();

        else if(isset($_POST['addTask'])) {
            $this->gerenciarEncomenda->adicionar($_POST);
        }

        else if(isset($_POST['removeTask'])) {
            if($this->gerenciarEncomenda->remover($_POST['removeTask'])) {
                die('true');
            }
        }

        die();
    }
}