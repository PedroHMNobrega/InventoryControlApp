<?php include __DIR__ . '/../header.php'; ?>
<div class="content-box left">
    <div class="content-wrapper">
        <h1 class="titulo"><i class="fas fa-pencil-alt"></i> Adicionar Produto</h1>
        <h3 class="titulo2">Insira os Dados</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="input-wrapper">
                <label>Nome do Produto</label>
                <input type="text" name="nome" required <?php if($temValor) echo "value='$_POST[nome]'" ?>>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Descrição</label>
                <textarea name="descricao"><?php if($temValor) echo $_POST['descricao'] ?></textarea>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Valor</label>
                <input type="text" name="valor" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal="," required <?php if($temValor) echo "value='$_POST[valor]'" ?>>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Quantidade em Estoque</label>
                <input type="number" name="quantidade" min="0" required <?php if($temValor) echo "value='$_POST[quantidade]'" ?>>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Adicionar Imagem</label>
                <input type="file" name="img">
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <div class="buttons-wrapper">
                    <input type="submit" value="Adicionar" name="acao">
                </div>
            </div><!--input-wrapper-->
        </form>
    </div><!--content-wrapper-->
</div><!--content-box-->
<?php include __DIR__ . '/../footer.php'; ?>