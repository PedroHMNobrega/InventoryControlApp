<?php

use Estoque\Infra\Controller\Ajax\GraficoController;
use Estoque\Infra\Controller\Ajax\HandleEncomendasController;
use Estoque\Infra\Controller\EncomendasController;
use Estoque\Infra\Controller\HomeController;
use Estoque\Infra\Controller\Vendas\{RealizaRemocaoVendaController,
    RealizaVendaController,
    VendasController,
    VenderProdutoController};
use Estoque\Infra\Controller\Estoque\{AdicionarProdutoController,
    EditarProdutoController,
    EstoqueController,
    RealizaEdicaoController,
    RealizaRemocaoController};

return [
    '' => HomeController::class,
    '/home' => HomeController::class,
    '/estoque' => EstoqueController::class,
    '/adicionarProduto' => AdicionarProdutoController::class,
    '/vendas' => VendasController::class,
    '/encomendas' => EncomendasController::class,
    '/venderProduto' => VenderProdutoController::class,
    '/realizaVenda' => RealizaVendaController::class,
    '/editarProduto' => EditarProdutoController::class,
    '/realizaEdicao' => RealizaEdicaoController::class,
    '/realizaRemocao' => RealizaRemocaoController::class,
    '/realizaRemocaoVenda' => RealizaRemocaoVendaController::class,
    '/ajax/grafico' => GraficoController::class,
    '/ajax/handleEncomendas' => HandleEncomendasController::class,
];