<?php
    function activeMenu($par) {
        $url = $_SERVER['PATH_INFO'];
        if($url == $par) echo 'active';
    }
?>

<html lang="pt-br">
<head>
    <title>Controle de Estoque</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= INCLUDE_PATH ?>/view/css/all.min.css">
    <link rel="stylesheet" href="<?= INCLUDE_PATH ?>/view/css/boot.css">
    <link rel="stylesheet" href="<?= INCLUDE_PATH ?>/view/css/style.css">
    <link rel="shortcut icon" href="<?= INCLUDE_PATH ?>/res/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <nav class="left">
        <div class="logo" style="background-image: url('<?= INCLUDE_PATH; ?>/res/images/logo.png');"></div>
        <ul>
            <li class="<?php activeMenu('/home'); activeMenu('') ?>"><a href="<?= INCLUDE_PATH ?>/home"><i class="fas fa-home"></i><p>Página Inicial</p></a></li>
            <li class="<?php activeMenu('/estoque') ?>"><a href="<?= INCLUDE_PATH ?>/estoque"><i class="fas fa-store"></i><p>Estoque</p></a></li>
            <li class="<?php activeMenu('/adicionarProduto') ?>"><a href="<?= INCLUDE_PATH ?>/adicionarProduto"><i class="fas fa-plus"></i><p>Adicionar Produto</p></a></li>
            <li class="<?php activeMenu('/vendas') ?>"><a href="<?= INCLUDE_PATH ?>/vendas"><i class="fas fa-money-bill-wave"></i><p>Vendas</p></a></li>
            <li class="<?php activeMenu('/encomendas') ?>"><a href="<?= INCLUDE_PATH ?>/encomendas"><i class="fas fa-clipboard-list"></i><p>Encomendas</p></a></li>
        </ul>
    </nav>

<?php
    if(isset($_SESSION['message'])) {
        $tipo = $_SESSION['message_type'];
        $msg = $_SESSION['message'];

        if($tipo == 'sucesso')
            echo '<div class="alert a-sucesso"><i class="fas fa-check"></i>'.$msg.'</div>';
        else if($tipo == 'erro')
            echo '<div class="alert a-erro"><i class="fas fa-times"></i>'.$msg.'</div>';
        else if($tipo == 'atencao')
            echo '<div class="alert a-atencao"><i class="fas fa-exclamation-triangle"></i>'.$msg.'</div>';
        echo "<script>setTimeout(function() { $('.alert').fadeOut(); }, 3000);</script>";
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
?>