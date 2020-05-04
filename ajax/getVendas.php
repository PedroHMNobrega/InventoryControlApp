<?php 
    include('../config.php');
    if(isset($_POST['pegaVenda'])) {
        for($i = 1; $i <= 12; $i++) {
            $sql = MySql::conect()->prepare("SELECT SUM(valor) FROM `tb_admin.vendas` WHERE MONTH(`data`) = ? AND YEAR(`data`) = YEAR(CURRENT_DATE())");
            $sql->execute([$i]);
            $valor = $sql->fetch()['SUM(valor)'];
            if($valor) $valores[] = (int)$valor;
            else $valores[] = 0;
        }
        // echo "<script>alert($valores[0]);</script>";
        die(json_encode($valores));
    }
?>