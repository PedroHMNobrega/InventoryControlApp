<?php
    //TODO: Implementar container de injecao de dependencia
    use Estoque\Infra\Controller\Ajax\HandleEncomendasController;
    use Estoque\Infra\Controller\Controller;
    use Estoque\Infra\Controller\EncomendasController;
    use Estoque\Infra\DataBase\MySql;
    use Estoque\Infra\DataBase\Repositories\RepositorioEncomendaPdo;
    use Estoque\Infra\DataBase\Repositories\RepositorioEstoquePdo;
    use Estoque\Infra\DataBase\Repositories\RepositorioVendasPdo;

    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/../config/config.php';

    $path = $_SERVER['PATH_INFO'];
    $routes = require __DIR__ . '/../config/routes.php';

    if(!array_key_exists($path, $routes)) {
        http_response_code(404);
        exit();
    }

    session_start();

    $controllerClass = $routes[$path];
    $pdo = MySql::conect();

    if($controllerClass == EncomendasController::class || $controllerClass == HandleEncomendasController::class) {
        /** @var Controller $controller */
        $controller = new $controllerClass(new RepositorioEncomendaPdo("tb_admin.encomendas", $pdo));
    } else {
        /** @var Controller $controller */
        $controller = new $controllerClass(new RepositorioEstoquePdo("tb_admin.estoque", $pdo), new RepositorioVendasPdo("tb_admin.vendas", $pdo));
    }

    $controller->processRequest();