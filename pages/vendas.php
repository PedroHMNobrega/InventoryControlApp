<div class="content-box left">
    <?php 
        $vendas = MySql::conect()->prepare("SELECT * FROM `tb_admin.vendas` ORDER BY `data` DESC, id DESC");
        $vendas->execute();
        $vendas = $vendas->fetchAll();

        $totalVendido = MySql::conect()->prepare("SELECT SUM(valor) FROM `tb_admin.vendas`");
        $totalVendido->execute();
        $totalVendido = $totalVendido->fetch()[0];
        
        if(isset($_GET['delete'])) {
            if(DataBase::remover($_GET['delete'], 'tb_admin.vendas')) {
                $produto = DataBase::select($_GET['id'], 'tb_admin.estoque');
                $quantidade = $produto['quantidade'] + $_GET['qnt'];
                DataBase::editar(['quantidade'=> $quantidade], $_GET['id'], 'tb_admin.estoque');
                Painel::redirect(INCLUDE_PATH.'vendas?removido');
            } else Painel::alert('erro', 'Erro ao Deletar a Venda. Tente Novamente.');
        }
        if(isset($_GET['removido'])) Painel::alert('sucesso', 'Venda Deletada com Sucesso!');
    ?>
<div class="content-wrapper table">
        <h1 class="titulo"><i class="fas fa-money-bill-wave"></i> Vendas</h1>
        <div class="box-wrapper">
            <div class="box b3 box-2">
                <p>Total Vendido:<br><b><?php echo 'R$ '.number_format($totalVendido, 2, ',', '.') ?></b></p>
            </div><!--box-->
        </div><!--box-wrapper-->
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>-</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vendas as $key => $value) { ?>
                    <tr>
                        <td><?php echo $value['nome'] ?></td>
                        <td><?php echo $value['quantidade'] ?></td>
                        <td><?php echo 'R$ '.number_format($value['valor'], 2, ',', '.') ?></td>
                        <td><?php echo date('d/m/Y', strtotime($value['data'])) ?></td>
                        <td><a href="<?php echo INCLUDE_PATH ?>vendas?delete=<?php echo $value['id'] ?>&qnt=<?php echo $value['quantidade'] ?>&id=<?php echo $value['id_produto'] ?>" class="remove-venda"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div><!--content-wrapper-->
</div><!--content-box-->