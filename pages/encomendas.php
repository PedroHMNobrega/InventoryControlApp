<?php 
    $tarefas = DataBase::query('SELECT * FROM `tb_admin.encomendas` ORDER BY `order_id`');

?>
<div class="content-box left">
    <div class="content-wrapper table">
        <h1 class="titulo"><i class="fas fa-clipboard-list"></i> Encomendas</h1>
        <section class="activities">
        <div class="container">
            <div class="activities-wrapper">
                <div class="alert a-sucesso" style="display: none"><i class="fas fa-check"></i>Tarefa Adicionada Com Sucesso!</div>
                <div class="add-button"><i class="fas fa-plus"></i></div>
                <div class="add-task">
                    <form method="POST">
                        <h1 class="text-center titulo"><i class="fas fa-check-circle"></i> Adicionar Encomenda</h1>
                        <input type="text" name="task" placeholder="Digite a Tarefa">
                        <input type="hidden" name="status" value="0">
                        <input type="submit" value="Adicionar" name="acao">
                    </form>
                </div><!--add-task-->
                <?php 
                    if(count($tarefas) == 0) echo "<div class='sem-encomenda'><i class='fas fa-plus'></i><h2>Adicione uma Encomenda!<h2></div>";
                    else echo "<div class='sem-encomenda' style='display:none'><i class='fas fa-plus'></i><h2>Adicione uma Encomenda!<h2></div>";
                ?>
                <div class="tarefas-wrapper">
                    <?php foreach($tarefas as $key => $value) {?>
                        <div class="tarefa-single <?php if($value['status'] == 1) echo 'done' ?>" id="item-<?php echo $value['id'] ?>">
                            <span><?php echo $value['nome'] ?></span>
                            <a>
                                <i idrm="<?php echo $value['id'] ?>" class="fas fa-times remove-task"></i>
                            </a>
                            <label class="checkbox-container">
                                <input type="checkbox" qual="<?php echo $value['id'] ?>" <?php if($value['status'] == 1) echo 'checked' ?>>
                                <span class="checkmark"><i class="fas fa-check"></i></span>
                            </label>
                        </div><!--tarefa-single-->
                    <?php } ?>
                </div><!--tarefas-wrapper-->
            </div><!--activities-wrapper-->
        </div><!--container-->
    </section><!--activities-->
    </div><!--content-wrapper-->

</div><!--content-box-->