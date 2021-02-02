<?php include __DIR__ . '/../header.php'; ?>
<div class="content-box left">
    <div class="content-wrapper table">
        <h1 class="titulo"><i class="fas fa-store"></i> Estoque</h1>
        <div class="buscar">
            <h3><i class="fas fa-search"></i> Buscar</h3>
            <form action="<?php INCLUDE_PATH ?>/estoque" method="POST">
                <input type="text" name="busca" placeholder="Buscar Produto">
                <input type="submit" value="Buscar" name="acao-buscar">
            </form>
        </div><!--buscar-->
        <div class="produtos">
            <form action="" method="GET" class="switch">
                <input type="submit" name='disponivel' value="Produtos Disponíveis" <?php if(!isset($_GET['falta'])) echo 'class="active-swtc"' ?>>
                <input type="submit" name='falta' value="Produtos Faltando" <?php if(isset($_GET['falta'])) echo 'class="active-swtc"' ?>>
            </form>
            <?php if(isset($_GET['falta'])) { ?>
                <h3 class="titulo2">Produtos Faltando</h3>
            <?php } else { ?>
                <h3 class="titulo2">Produtos Disponíveis</h3>
            <?php } ?>
            <?php if(isset($_POST['acao-buscar']) && $_POST['busca'] != '') { ?>
                <?php if(count($produtos) == 1) {?>
                    <p class="resultado">Foi encontrado <b>1</b> produto.</p>
                <?php } else { ?>
                    <p class="resultado">Foram encontrados <b><?php echo count($produtos) ?></b> produtos.</p>
                <?php } ?>
            <?php } ?>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produtos as $key => $produto) { ?>
                        <tr>
                            <td><?= $produto->getNome() ?></td>
                            <td><?= $produto->getQuantidade() ?></td>
                            <td><?= $this->toMoneyFormat($produto->getValor()) ?></td>
                            <td>
                                <a href="<?= INCLUDE_PATH ?>/editarProduto?id=<?= $produto->getId(); ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a href="<?= INCLUDE_PATH ?>/venderProduto?id=<?= $produto->getId(); ?>"><i class="fas fa-dollar-sign"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div><!--produtos-->
    </div><!--content-wrapper-->
</div><!--content-box-->
<?php include __DIR__ . '/../footer.php'; ?>