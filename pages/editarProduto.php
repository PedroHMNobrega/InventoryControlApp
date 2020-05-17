<div class="content-box left">
    <?php 
        $id = $_GET['id'];
        $produto = DataBase::select($id, 'tb_admin.estoque');
        if(isset($_POST['acao'])) {
            if($_POST['valor'][0] == 'R') {
                $_POST['valor'] = preg_replace('/[.R$]/', '', $_POST['valor']);
                $_POST['valor'] = (double)str_replace(',', '.', $_POST['valor']);
            }
            $img = $_FILES['img'];
            $imgAtual = $produto['img'];
            $_POST['img'] = $imgAtual;
            if($img['name'] != '') {
                if(Painel::validImg($img)) {
                    $img = Painel::uploadFile($img);
                    $_POST['img'] = $img;
                    if($img != false && DataBase::editar($_POST, $id, 'tb_admin.estoque')) {
                        if($img != $imgAtual) Painel::removeFile($imgAtual);
                        Painel::redirect(INCLUDE_PATH."editarProduto?id=$id&editado");
                    } else {
                        Painel::alert('erro', 'Ocorreu um Erro ao Editar o Produto. Tente Novamente!');
                        if($img != $imgAtual) Painel::removeFile($img);
                    }
                } else Painel::alert('erro', 'Selecione Uma Imagem Válida');
            } else {
                if(DataBase::editar($_POST, $id, 'tb_admin.estoque')) {
                    Painel::redirect(INCLUDE_PATH."editarProduto?id=$id&editado");
                } else Painel::alert('erro', 'Ocorreu um Erro ao Editar o Produto. Tente Novamente!');
            }
        }
        if(isset($_GET['deletar'])) {
            if(DataBase::remover($id, 'tb_admin.estoque')) {
                Painel::removeFile($produto['img']);
                Painel::redirect(INCLUDE_PATH.'estoque?deletado');
            } else Painel::alert('erro', 'Erro ao Remover Produto. Tente Novamente.');
        }
        if(isset($_GET['editado'])) Painel::alert('sucesso', 'Produto Editado Com Sucesso!');
        
    ?>
    <div class="content-wrapper">
        <h1 class="titulo"><i class="fas fa-pencil-alt"></i> Editar Produto</h1>
        <?php if($produto['img'] != '') { ?>
            <div class="image-wrapper" style="background-image: url('<?php echo INCLUDE_PATH."uploads/$produto[img]" ?>')"></div>
        <?php } ?>
        <h3 class="titulo2">Altere os Dados</h3>
        <div class="image"></div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="input-wrapper">
                <label>Nome do Produto</label>
                <input type="text" name="nome" value="<?php echo $produto['nome'] ?>" required>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Descrição</label>
                <textarea name="descricao"><?php echo $produto['descricao'] ?></textarea>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Valor</label>
                <input type="text" name="valor" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal="," required value="<?php echo $produto['valor'] ?>" ?>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Quantidade em Estoque</label>
                <input type="number" name="quantidade" min="0" value="<?php echo $produto['quantidade'] ?>" required>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Adicionar Imagem</label>
                <input type="file" name="img">
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <div class="buttons-wrapper">
                    <input type="submit" value="Editar" name="acao">
                    <a href="<?php INCLUDE_PATH ?>editarProduto?id=<?php echo $id ?>&deletar" class="remove-button">Remover</a>
                </div><!--buttons-wrapper-->
            </div><!--input-wrapper-->
        </form>
    </div><!--content-wrapper-->

</div><!--content-box-->