$(document).ready(function(){
   $('.chat_head').click(function(){
      $('.chat_body').slideToggle(); 
   });

    $('.msg_head').click(function(){
      $('.msg_wrapper').slideToggle(); 
   });
    
    $('.close').click(function(){
        $('.msg_box').hide();
    });
    
    $('.user').click(function(){
        $('.msg_box').show();
    });
    
    $('textarea').keypress(function(e){
        if(e.keyCode == 13)
            {
                
                var msg = $(this).val();
                
                $("<div class='msg_b'>"+msg+"</div>").insertBefore('.msg_insert');
                $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
            }
    });


});