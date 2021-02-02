<?php

namespace Estoque\Application;

use Estoque\Domain\Encomenda;
use Estoque\Domain\RepositorioEncomenda;

class GerenciarEncomenda
{
    private RepositorioEncomenda $repositorioEncomenda;

    public function __construct(RepositorioEncomenda $repositorioEncomenda)
    {
        $this->repositorioEncomenda = $repositorioEncomenda;
    }

    public function adicionar(array $dados): void
    {
        $novaEncomenda = new Encomenda(
            null,
            $dados['addTask'],
            $dados['status'],
            $this->repositorioEncomenda->getProximoOrderId()
        );

        if($this->repositorioEncomenda->adicionar($novaEncomenda)) {
            $encomenda = $this->repositorioEncomenda->pegaUltimo();
            print <<<HTML
                <div class="tarefa-single" id="item-{$encomenda->getId()}">
                    <span>{$encomenda->getNome()}</span>
                    <a>
                        <i idrm="{$encomenda->getId()}" class="fas fa-times remove-task"></i>
                    </a>
                    <label class="checkbox-container">
                        <input type="checkbox" qual="{$encomenda->getId()}">
                        <span class="checkmark"><i class="fas fa-check"></i></span>
                    </label>
                </div>
            HTML;
        }
    }

    public function remover(int $id): bool
    {
        return $this->repositorioEncomenda->remover($id);
    }

    public function editar(int $id, array $columns): void
    {
        $this->repositorioEncomenda->editar($id, $columns);
    }

    public function ordena(array $dados)
    {
        foreach ($dados['item'] as $key => $value) {
            $this->editar($value, ['order_id'=> $key+1]);
        }
    }

    public function getTasks()
    {
        $encomendas = $this->repositorioEncomenda->selecionarOrdenado();

        foreach($encomendas as $key => $encomenda) {
            $v1 = ($encomenda->getStatus() == 1) ? 'done' : '';
            $v2 = ($encomenda->getStatus() == 1) ? 'hide' : '';
            $v3 = ($encomenda->getStatus() == 1) ? 'checked' : '';
            print <<<HTML
                <div class="tarefa-single $v1" id="item-{$encomenda->getId()}">
                    <span>{$encomenda->getNome()}</span>
                    <a>
                        <i idrm="{$encomenda->getId()}" class="fas fa-times remove-task $v2"></i>
                    </a>
                    <label class="checkbox-container">
                        <input type="checkbox" qual="{$encomenda->getId()}" $v3>
                        <span class="checkmark"><i class="fas fa-check"></i></span>
                    </label>
                </div><!--tarefa-single-->
            HTML;
        }
    }
}