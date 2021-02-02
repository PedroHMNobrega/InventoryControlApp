<?php include __DIR__ . '/../header.php'; ?>
<div class="content-box left">
    <div class="content-wrapper">
        <h1 class="titulo"><i class="fas fa-pencil-alt"></i> Adicionar Venda</h1>
        <h3 class="titulo2">Confirme sua Venda</h3>
        <form action="<?= INCLUDE_PATH . '/realizaVenda'; ?>" method="POST" class="confirmar-venda">
            <h3 class="text-center">Produto:<br><b><?= $produto->getNome(); ?></b></h3>
            <input type="hidden" name="nome" value="<?= $produto->getNome(); ?>">
            <?php if($produto->getImagePath() !== ''): ?>
                <div class="image-wrapper img2" style="background-image: url('<?= INCLUDE_PATH . "/uploads/" . $produto->getImagePath() ?>')"></div>
            <?php endif; ?>
            <div class="input-wrapper">
                <label>Valor da Unidade</label><br>
                <input type="text" name="valor" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal="," required value="<?= $produto->getValor(); ?>">
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Unidades Vendidas</label><br>
                <input type="number" name="quantidade" min="1" value="1" required>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <input type="hidden" name="id_produto" value="<?= $produto->getId(); ?>">
                <input type="submit" value="Confirmar" name="acao">
            </div><!--input-wrapper-->
        </form>
    </div><!--content-wrapper-->
</div><!--content-box-->
<?php include __DIR__ . '/../footer.php'; ?>