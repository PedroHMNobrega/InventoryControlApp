<?php include __DIR__ . '/../header.php'; ?>
<div class="content-box left">
    <div class="alert a-sucesso" style="display: none"><i class="fas fa-check"></i>Tarefa Adicionada Com Sucesso!</div>
    <div class="content-wrapper table">
        <h1 class="titulo"><i class="fas fa-clipboard-list"></i> Encomendas</h1>
        <section class="activities">
        <div class="container">
            <div class="activities-wrapper">
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
                    if(count($encomendas) == 0) echo "<div class='sem-encomenda'><i class='fas fa-plus'></i><h2>Adicione uma Encomenda!<h2></div>";
                    else echo "<div class='sem-encomenda' style='display:none'><i class='fas fa-plus'></i><h2>Adicione uma Encomenda!<h2></div>";
                ?>
                <div class="tarefas-wrapper">
                    <?php foreach($encomendas as $key => $encomenda) {?>
                        <div class="tarefa-single <?php if($encomenda->getStatus() == 1) echo 'done'; ?>" id="item-<?= $encomenda->getId(); ?>">
                            <span><?= $encomenda->getNome(); ?></span>
                            <a>
                                <i idrm="<?= $encomenda->getId(); ?>" class="fas fa-times remove-task"></i>
                            </a>
                            <label class="checkbox-container">
                                <input type="checkbox" qual="<?= $encomenda->getId(); ?>" <?php if($encomenda->getStatus() == 1) echo 'checked'; ?>>
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
<?php include __DIR__ . '/../footer.php'; ?>