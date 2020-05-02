<div class="content-box left">
    <?php 
        $vendas = MySql::conect()->prepare("SELECT * FROM `tb_admin.vendas` WHERE MONTH(`data`) = MONTH(CURRENT_DATE()) AND YEAR(`data`) = YEAR(CURRENT_DATE()) ORDER BY `data` DESC, `id` DESC");
        $vendas->execute();
        $vendas = $vendas->fetchAll();
        
        $disp = MySql::conect()->prepare("SELECT SUM(quantidade) FROM `tb_admin.estoque` WHERE quantidade > 0");
        $disp->execute();
        $disp = $disp->fetch()[0];
        
        $falta = MySql::conect()->prepare("SELECT * FROM `tb_admin.estoque` WHERE quantidade = 0");
        $falta->execute();
        $falta = $falta->rowCount();

        $totalVendido = MySql::conect()->prepare("SELECT SUM(valor) FROM `tb_admin.vendas`  WHERE MONTH(`data`) = MONTH(CURRENT_DATE()) AND YEAR(`data`) = YEAR(CURRENT_DATE())");
        $totalVendido->execute();
        $totalVendido = $totalVendido->fetch()[0];

        $totalEstoque = MySql::conect()->prepare("SELECT SUM(valor * quantidade) FROM `tb_admin.estoque`");
        $totalEstoque->execute();
        $totalEstoque = $totalEstoque->fetch()[0];
    ?>
    <div class="content-wrapper">
        <h1 class="titulo"><i class="fas fa-home"></i> Painel de Controle</h1>
        <div class="box-wrapper">
            <div class="box b1">
                <p>Produtos em Estoque:<br><b><?php echo $disp ?></b></p>
            </div><!--box-->
            <div class="box b2">
                <p>Produtos em Falta:<br><b><?php echo $falta ?></b></p>
            </div><!--box-->
            <div class="box b3">
                <p>Vendas Esse Mês:<br><b><?php echo 'R$ '.number_format($totalVendido, 2, ',', '.') ?></b></p>
            </div><!--box-->
            <div class="box b4">
                <p>Total em Estoque:<br><b><?php echo 'R$ '.number_format($totalEstoque, 2, ',', '.') ?></b></p>
            </div><!--box-->
        </div><!--box-wrapper-->
    </div><!--content-wrapper-->
    <div class="content-wrapper table">
        <h1 class="titulo"><i class="fas fa-money-bill-wave"></i> Vendas do Mês</h1>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vendas as $key => $value) { ?>
                    <tr>
                        <td><?php echo $value['nome'] ?></td>
                        <td><?php echo $value['quantidade'] ?></td>
                        <td><?php echo 'R$ '.number_format($value['valor'], 2, ',', '.') ?></td>
                        <td><?php echo date('d/m/Y', strtotime($value['data'])) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div><!--content-wrapper-->
</div><!--content-box-->