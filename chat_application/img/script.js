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
                $('textarea').val("");
            }
    });
    
     $('.img').click(function(){
        $('.detail_contact').hide("slide", { direction: "left"  }, 1000);
    });

     $('.msg_head').click(function(){
        $('.detail_contact').show("slide", {direction: "left" }, 1000);
    });
    
    function Chat ()
    {
        this.update = updateChat;
        this.send = sendChat;
        this.getState = getStateOfChat;
    }
    
    //gets the state of the chat
    function updateChat()
    {
        if(!instance)
            {
                instance = true;
                $.ajax({
                    type: "POST",
                    url: "processs.php",
                    data: {'function': 'update', 'state': state, 'file': file},
                    dataType: "json",
                    success: function(data)
                    {
                        if(data.text)
                            {
                                for(var i =0; i < data.text.length; i++)
                                    {
                                        var msg = $('.msg_a').append($(" "+ data.text[i] +" "));
                                        
                                         $("<div class='msg_a'>"+msg+"</div>").insertBefore('.msg_insert');
                                    }
                                $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                                instance = false;
                                state = data.state;            
                            }
                    }
                });
            }
        else
            {
                setTimeout(updateChat, 1500);
            }
    }
    
    
    //send the message
    function sendChat(message, nickname)
    {
        updateChat();
        $.ajax({
            type: "POST",
            url: "process.php",
            data: {'function': 'send', 'message': message, 'nickname': nickname, 'file': file},
            dataType: "json";
            success: function(data){
            updateChat();
        }
        });
    }

});