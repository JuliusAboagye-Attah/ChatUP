$(document).ready(function(){
    $('.chat_body').slideToggle();
     $('.owner').show("slide", {direction: "left" }, 1000);
    
    $('.chat_head').click(function(){
      $('.chat_body').slideToggle(); 
   });

    $('.msg_head').click(function(){
      $('.msg_wrapper').slideToggle(); 
   });
    
    $('.close').click(function(){
        $('.msg_box').hide();
        $('.detail_contact').hide("slide", { direction: "left"  }, 1000);
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
                $('textarea').val("");
            }
    });
    
     $('.img').click(function(){
        $('.detail_contact').hide("slide", { direction: "left"  }, 1000);
    });

     $('.msg_head').click(function(){
        $('.detail_contact').show("slide", {direction: "left" }, 1000);
    });
});