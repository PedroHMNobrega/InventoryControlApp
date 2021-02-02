<?php include __DIR__ . '/../header.php'; ?>
<div class="content-box left">
<div class="content-wrapper table">
        <h1 class="titulo"><i class="fas fa-money-bill-wave"></i> Vendas</h1>
        <div class="box-wrapper">
            <div class="box b3 box-2">
                <p>Total Vendido:<br><b><?= $totalVendido ?></b></p>
            </div><!--box-->
        </div><!--box-wrapper-->
        <div class="grafico">
            <h3 class="titulo text-center">Vendas por Mês</h3>
            <canvas id="myChart"></canvas>
        </div><!--grafico-->
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
                <?php foreach($vendas as $key => $venda) { ?>
                    <tr>
                        <td><?= $venda->getNomeProduto(); ?></td>
                        <td><?= $venda->getQuantidadeVendido(); ?></td>
                        <td><?= $this->toMoneyFormat($venda->getValorVenda()); ?></td>
                        <td><?= $venda->getDataVendaFormatada(); ?></td>
                        <td><a href=<?= $this->getRedirectUrl($venda); ?> class="remove-venda"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div><!--content-wrapper-->
</div><!--content-box-->
<?php include __DIR__ . '/../footer.php'; ?>