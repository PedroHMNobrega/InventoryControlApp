<?php include __DIR__ . '/../header.php'; ?>
<div class="content-box left">
    <div class="content-wrapper">
        <h1 class="titulo"><i class="fas fa-pencil-alt"></i> Editar Produto</h1>
        <?php if($produto->getImagePath() != '') { ?>
            <div class="image-wrapper" style="background-image: url('<?= INCLUDE_PATH."/uploads/". $produto->getImagePath() ?>')"></div>
        <?php } ?>
        <h3 class="titulo2">Altere os Dados</h3>
        <div class="image"></div>
        <form action="<?= INCLUDE_PATH . '/realizaEdicao'; ?>" method="POST" enctype="multipart/form-data">
            <div class="input-wrapper">
                <label>Nome do Produto</label>
                <input type="text" name="nome" value="<?= $produto->getNome(); ?>" required>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Descrição</label>
                <textarea name="descricao"><?= $produto->getDescricao(); ?></textarea>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Valor</label>
                <input type="text" name="valor" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal="," required value="<?= $produto->getValor() ?>" ?>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Quantidade em Estoque</label>
                <input type="number" name="quantidade" min="0" value="<?= $produto->getQuantidade()?>" required>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Adicionar Imagem</label>
                <input type="file" name="img">
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <div class="buttons-wrapper">
                    <input type="hidden" name="id" value="<?= $produto->getId(); ?>">
                    <input type="submit" value="Editar" name="acao">
                    <a href="<?= INCLUDE_PATH ?>/realizaRemocao?id=<?= $id ?>" class="remove-button">Remover</a>
                </div><!--buttons-wrapper-->
            </div><!--input-wrapper-->
        </form>
    </div><!--content-wrapper-->
</div><!--content-box-->
<?php include __DIR__ . '/../footer.php'; ?>