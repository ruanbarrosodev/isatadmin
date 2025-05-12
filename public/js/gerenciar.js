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
    
})

