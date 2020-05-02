<?php 
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    define('INCLUDE_PATH', 'http://localhost/FullStack/Projetos/EstoqueLucia/');
    define('BASE_DIR', __DIR__);

    define('DATABASE', 
    ['HOST'=> 'localhost', 
    'DATABASE'=> 'estoque_lucia',
    'USER'=> 'root',
    'PASSWORD'=> '']);

    $autoload = function($class) {
        include('classes/'.$class.'.php');
    };
    spl_autoload_register($autoload);

    function activeMenu($par) {
        $url = explode('/', @$_GET['url'])[0];
        if($url == $par) echo 'active';
    }
?>