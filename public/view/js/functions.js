$(function() {
    $('.remove-button').click(function() {
        let r = confirm("Tem certeza que deseja DELETAR esse produto?");
        if(r) return true;
        return false;
    });

    $('.remove-venda').click(function() {
        let r = confirm("Tem certeza que deseja DELETAR esse venda?");
        if(r) return true;
        return false;
    });

    $('input[type=number]').on('wheel', function(e){
        return false;
    });
});