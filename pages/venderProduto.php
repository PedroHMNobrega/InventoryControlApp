<div class="content-box left">
    <?php 
        $id = $_GET['id'];
        $produto = DataBase::select($id, 'tb_admin.estoque');
        if(isset($_POST['acao'])) {
            if($_POST['quantidade'] > $produto['quantidade']) 
                Painel::alert('erro', 'Quantidade Adicionada Maior que o Estoque. Tente Novamente.');
            else {
                if($_POST['valor'][0] == 'R') {
                    $_POST['valor'] = preg_replace('/[.R$]/', '', $_POST['valor']);
                    $_POST['valor'] = (double)str_replace(',', '.', $_POST['valor']);
                }
                $_POST['valor'] *= $_POST['quantidade'];
                $_POST['data'] = date('Y-m-d');
                if(DataBase::adicionar($_POST, 'tb_admin.vendas')) {
                    $quantidadeAtual = $produto['quantidade'] - $_POST['quantidade'];
                    DataBase::editar(['quantidade'=> $quantidadeAtual], $id, 'tb_admin.estoque');
                    Painel::redirect(INCLUDE_PATH.'estoque?vendido');
                } else Painel::alert('erro', 'Erro ao Confirmar a Venda. Tente Novamente!');
            }
        }
    ?>
    <div class="content-wrapper">
        <h1 class="titulo"><i class="fas fa-pencil-alt"></i> Adicionar Venda</h1>
        <h3 class="titulo2">Confirme sua Venda</h3>
        <form action="" method="POST" class="confirmar-venda">
            <h3 class="text-center">Produto:<br><b><?php echo $produto['nome'] ?></b></h3>
            <input type="hidden" name="nome" value="<?php echo $produto['nome'] ?>">
            <?php if($produto['img'] != '') { ?>
                <div class="image-wrapper img2" style="background-image: url('<?php echo INCLUDE_PATH."uploads/$produto[img]" ?>')"></div>
            <?php } ?>
            <div class="input-wrapper">
                <label>Valor da Unidade</label><br>
                <input type="text" name="valor" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal="," required value="<?php echo $produto['valor'] ?>" ?>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <label>Unidades Vendidas</label><br>
                <input type="number" name="quantidade" min="1" value="1" required>
            </div><!--input-wrapper-->
            <div class="input-wrapper">
                <input type="hidden" name="id_produto" value="<?php echo $produto['id'] ?>">
                <input type="submit" value="Confirmar" name="acao">
            </div><!--input-wrapper-->
        </form>
    </div><!--content-wrapper-->

</div><!--content-box-->