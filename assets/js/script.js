$(function(){
    $('.imagem_produto a').on('click', function() {
        $(this).parent().remove();
    });
});