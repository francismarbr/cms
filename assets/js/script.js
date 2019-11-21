$(function(){
    $('.imagem_item a').on('click', function() {
        $(this).parent().remove();
    });
});