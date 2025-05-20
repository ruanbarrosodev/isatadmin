modalBack = document.getElementsByClassName("modal");

$(document).ready(function () {
    $('.modal').on('click', function(e){
        if(e.target==this){
            $('.modal').css("display", "none");
        }
    });
    $('.btnChangePassword').on('click', function(){
        var modalId = $(this).data('modal-id');
        $('.modal-' + modalId).css('display', 'flex');

        $('.bodyDelete-' + modalId).css('display', 'none');
        $('.bodyReset-' + modalId).css('display', 'block');
    });
    $('.btnDeleteWorker').on('click', function(){
        var modalId = $(this).data('modal-id');
        $('.modal-' + modalId).css('display', 'flex');

        $('.bodyDelete-' + modalId).css('display', 'block');
        $('.bodyReset-' + modalId).css('display', 'none');
    });

    
      $('.tab-btn').click(function() {
    var tabId = $(this).data('tab');

    // Remove ativo dos botões e conteúdos
    $('.tab-btn, .tab-content').removeClass('active');

    // Adiciona ativo no botão clicado e no conteúdo correspondente
    $(this).addClass('active');
    $('.tab-content[data-tab="' + tabId + '"]').addClass('active');
  });
})

/*
    $('.btnDelete').on('click', function(){
        var modalId = $(this).data('modal-id');
        $('.myModal-' + modalId).css('display', 'flex');
    });

    $('.myModal').on('click', function(e){
    if(e.target==this){
        $('.myModal').css("display", "none");
    }
    $('.btnCancel').on('click', function(){
        $('.myModal').css("display", "none");
    });

      $('input[name="profilepic"]').on('change', function(e) {
        // Obtém o caminho do arquivo selecionado
        var imagePath = URL.createObjectURL(e.target.files[0]);

        // Exibe a visualização da imagem no photo-container
        $('.photo-container img').attr('src', imagePath);
    });
    data-modal-id="<?=$row->id?>"
});
*/

