<?php include __DIR__ . '/../header.php'; ?>
<div class="content-box left">
    <div class="content-wrapper">
        <h1 class="titulo"><i class="fas fa-home"></i> Painel de Controle</h1>
        <div class="box-wrapper">
            <div class="box b1">
                <p>Produtos em Estoque:<br><b><?= $itensEmEstoque ?></b></p>
            </div><!--box-->
            <div class="box b2">
                <p>Produtos em Falta:<br><b><?= $itensEmFalta ?></b></p>
            </div><!--box-->
            <div class="box b3">
                <p>Vendas Esse Mês:<br><b><?= $valorTotalVendido ?></b></p>
            </div><!--box-->
            <div class="box b4">
                <p>Total em Estoque:<br><b><?= $valorTotalEstoque ?></b></p>
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
                <?php foreach($vendasDoMes as $key => $item) { ?>
                    <tr>
                        <td><?= $item->getNomeProduto() ?></td>
                        <td><?= $item->getQuantidadeVendido() ?></td>
                        <td><?= $this->toMoneyFormat($item->getValorVenda()) ?></td>
                        <td><?= $item->getDataVendaFormatada() ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div><!--content-wrapper-->
</div><!--content-box-->
<?php include __DIR__ . '/../footer.php'; ?>