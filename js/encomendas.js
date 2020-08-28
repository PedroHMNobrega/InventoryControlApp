$(function() {
    var includePath = 'http://localhost/FullStack/Projetos/EstoqueLucia/'; 
    
    addTask();
    doneTask();
    addTaskPage();
    sortTask();
    removeTask();
    
    function addTask() {
        $('.add-task form').submit(function() {
            $('.sem-encomenda').hide();
            $nome = $('.add-task input[name=task]').val();
            if($nome != '') {
                $status = '0';
                $.ajax({
                    url: includePath+'ajax/ajax.php',
                    method: 'post',
                    data: {'addTask': $nome, 'status': '0'}
                }).done(function(data) {
                    $('.tarefas-wrapper').append(data);
                    $('.add-task input[name=task]').val('');
                });
            }
            return false;
        });
    }

    function removeTask() {
        $(document).on('click', '.remove-task', function() {
            let el = $(this);
            let id = el.attr('idrm');
            $.ajax({
                url: includePath+'ajax/ajax.php',
                method: 'post',
                data: {'removeTask': id}
            }).done(function(data) {
                if(data == 'true') {
                    el.parent().parent().fadeOut();
                    setTimeout(function() {el.parent().parent().remove();}, 1000);
                }
            });
            if($('.tarefa-single').length == 1) {
                setTimeout(function() {
                    $('.sem-encomenda').show();
                }, 1050);
            }
        });
    }

    function doneTask() {
        $(document).on('change', 'input[type=checkbox]', function() {
            let removeTask = $('.remove-task');
            let father = $(this).parent().parent();
            let id = $(this).attr('qual');
            if(this.checked) {
                father.css('background-color', '#05974e');
                $.ajax({
                    url: includePath+'ajax/ajax.php',
                    method: 'post',
                    data: {'done': id}
                }).done(function(data) {
                    console.log(data);
                });
            } else {
                father.css('background-color', '#da8db6');
                $.ajax({
                    url: includePath+'ajax/ajax.php',
                    method: 'post',
                    data: {'undone': id}
                }).done(function(data) {
                    console.log(data);
                });
            }
        });
    }

    function getTasks(data) {
        $.ajax({
            url: includePath+'ajax/ajax.php',
            method: 'post',
            data: {'getTask': data}
        }).done(function(data) {
            $('.tarefas-wrapper').html(data);
        });
    }

    function addTaskPage() {
        let button = $('.add-button');
        let addTask = $('.add-task');
        button.click(function() {
            if($(this).hasClass('active-btn')) {
                button.removeClass('active-btn');
                addTask.hide();
            } else {
                button.addClass('active-btn');
                addTask.show();
                $('.activities-wrapper input[type=text]').focus();
            }
        });

        $('.add-task form').submit(function() {
            if($('input[type=text]').val() == '') return false;
        });   
    }

    function sortTask() {
        $('.tarefas-wrapper').sortable({
            update: function() {
                var data = $(this).sortable('serialize');//?Pega a ordem de como ficou os elementos;
                data += '&sort';
                $.ajax({
                    url: includePath+'ajax/ajax.php',
                    method: 'post',
                    data: data
                }).done(function(data) {
                    console.log(data);
                });
            }
        });
    }
});