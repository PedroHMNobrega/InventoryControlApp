<?php include('config.php') ?>
<html lang="pt-br">
<head>
    <title>Controle de Estoque</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/all.min.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/boot.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">
    <link rel="shortcut icon" href="<?php echo INCLUDE_PATH; ?>images/favicon.ico" type="image/x-icon">
</head>
<body>
    <nav class="left">
        <div class="logo" style="background-image: url('<?php echo INCLUDE_PATH; ?>images/logo.png');"></div>
        <ul>
            <li class="<?php activeMenu('home'); activeMenu('') ?>"><a href="<?php echo INCLUDE_PATH ?>home"><i class="fas fa-home"></i><p>Página Inicial</p></a></li>
            <li class="<?php activeMenu('estoque') ?>"><a href="<?php echo INCLUDE_PATH ?>estoque"><i class="fas fa-store"></i><p>Estoque</p></a></li>
            <li class="<?php activeMenu('adicionarProduto') ?>"><a href="<?php echo INCLUDE_PATH ?>adicionarProduto"><i class="fas fa-plus"></i><p>Adicionar Produto</p></a></li>
            <li class="<?php activeMenu('vendas') ?>"><a href="<?php echo INCLUDE_PATH ?>vendas"><i class="fas fa-money-bill-wave"></i><p>Vendas</p></a></li>
            <li class="<?php activeMenu('encomendas') ?>"><a href="<?php echo INCLUDE_PATH ?>encomendas"><i class="fas fa-clipboard-list"></i><p>Encomendas</p></a></li>
        </ul>
    </nav>

    <?php Painel::loadPage(); ?>
    <div class="clear"></div>

    <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/jquery-ui.min.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/jquery.maskMoney.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/financeiroCliente.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/functions.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/chart.min.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/grafico.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/encomendas.js"></script>
</body>
</html>