 /// load the scroll bar effects
(function($){
    $(window).load(function(){
      $("#chatwrap").mCustomScrollbar();
      $("#allwrapper").mCustomScrollbar();
      setInterval(checkSelectedChat, 3000);
      setInterval(merchantNotificationList, 3000);
    });
  })(jQuery);
  
var last_id;  

  
$(document).ready(function() {
    
    ////// merchant list //////
    
    var merchant_list = $('.merchant-fullname');
    var input = $('#merchant-select');
     // filter name
    input.keyup(function() {
        merchant_list.each(function() {
            if ($(this).text().toLowerCase().indexOf(input.val().toLowerCase()) != -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    
    // click header hide or show
    $('#merchant-header').click(function() {
        $('#listwrap').toggle();
    });
    
    merchant_list.click(function() {
        var merchant_id = $(this).attr('value');
        $(this).find('span').text('0');
        $.ajax({
            type: "POST",
            url: base_url+"chat/read",
            dataType: 'json',
            data: { merchant_id: merchant_id }
        }).done(function( obj ) {
            $('.fullname').text(obj.merchant.fullname);
            $('.txtboxchat').attr('userid', obj.merchant.user_id);
            $('.chatboxwrap').show();
            $('.txtboxchat').focus();
            // clear previous messages
            $('.contentwrap').html("");
            if (obj.messages != null) { 
                var size = Object.size(obj.messages);
                // load messages 
                $.each(obj.messages, function(index, message) {
                    var str = '';
                    if (message.from_user_id == obj.merchant.user_id)
                        str = str_right_reply(message.content, message.last_update);
                    else
                        str = str_left_reply(message.content, message.last_update);
                    $(str).appendTo($('.contentwrap'));
                    if (index == size-1) { // get the last id, for loading the next message
                        last_id = message.id;
                    }
                });
                $("#allwrapper").mCustomScrollbar("update");
                $("#allwrapper").mCustomScrollbar("scrollTo","bottom");
            }   
        });
    });
    
    ////////////////chat box/////////////////
    
    $('.chat-header').click(function() {
        var user_id = $('.txtboxchat').attr('userid');
        $('.badge').text(0);
        if (user_id != '')
            $('.chatboxwrap').toggle();
    });
    
    $('.load-admin').click(function() {
        // load merchant and admin content 
        // only view by merchant
        var user_id = $('.txtboxchat').attr('userid') ;
        $.ajax({
            type: "POST",
            url: base_url+"chat/read",
            dataType: 'json',
            data: { merchant_id : user_id}
        }).done(function( obj ) {
            $('.txtboxchat').focus();
            if (obj.messages != null) { 
                var size = Object.size(obj.messages);
                // load messages 
                $.each(obj.messages, function(index, message) {
                    var str = '';
                    if (message.from_user_id == user_id)
                        str = str_left_reply(message.content, message.last_update);
                    else
                        str = str_right_reply(message.content, message.last_update);
                    $(str).appendTo($('.contentwrap'));
                    if (index == size-1) { // get the last id, for loading the next message
                        last_id = message.id;
                    }
                });
                $("#allwrapper").mCustomScrollbar("update");
                $("#allwrapper").mCustomScrollbar("scrollTo","bottom");
            }   
        });
    });
    
    $('.txtboxchat').keypress(function(e) {
        if (e.keyCode == 13) {
            var user_id = $(this).attr('userid');
            var content = $(this).val();
            if (user_id != '' && content != '' ) {
                $.ajax({
                    type: "POST",
                    url: base_url+"chat/create",
                    dataType: 'json',
                    data: { user_id:  user_id, content: content}
                }).done(function( obj ) {
                    if (obj.response == false)
                        error('Error while sending the message');
                    else {
                        $('.txtboxchat').val('');
                        
//                        var str = str_left_reply(content, generate_date());
//                        $(str).appendTo($('.contentwrap'));
//                        $("#allwrapper").mCustomScrollbar("scrollTo","bottom");
                        checkSelectedChat();
                    }
                });
                
            } else {
                error('Error while sending the message.');
            }
        }
    });
    
    
    
    
});

//// update periodically
/// load message
function checkSelectedChat(){
    var txtbox = $('.txtboxchat');
    var user_id = txtbox.attr('userid');
    if (last_id != null && $(".chatboxwrap").is(":visible") ) { // if the user click on the tab
        if (user_id != '') {
            // update latest messages
            $.ajax({
                type: "POST",
                url: base_url+"chat/load",
                dataType: 'json',
                data: { last_id: last_id , user_id: user_id}
            }).done(function( obj ) {
                if (obj.response == false)
                    error('Error while sending the message');
                else {

                    if (obj.messages != null) {
                        // start update messages
                        var size = Object.size(obj.messages);
                        // load messages 
                        $.each(obj.messages, function(index, message) {
                            var role = $('.txtboxchat').attr('role');
                            var str = '';
                            if (message.from_user_id == user_id)
                                if (role == 'admin')
                                    str = str_right_reply(message.content, message.last_update);
                                else
                                    str = str_left_reply(message.content, message.last_update)
                            else
                                if (role == 'admin')
                                    str = str_left_reply(message.content, message.last_update);
                                else if (role == 'merchant')
                                    str = str_right_reply(message.content, message.last_update);

                            $(str).appendTo($('.contentwrap'));
                            if (index == size-1) { // get the last id, for loading the next message
                                last_id = message.id;
                            }
                        });
                    } else {
                        $("#allwrapper").mCustomScrollbar("update");
                        $("#allwrapper").mCustomScrollbar("scrollTo","bottom");
                    }
                }
            });
        }
    } else {
        /// check notification
        $.ajax({
                type: "POST",
                url: base_url+"chat/notification",
                dataType: 'json',
                data: { user_id: user_id}
            }).done(function( obj ) {
                if (obj.response == true) {
                    $('.badge').text(obj.notify);
                } else {
                    $('.badge').text(0);
                }
            });
    }
}

/// laod merchant notificatiion
function merchantNotificationList() {
     $.ajax({
                url: base_url+"chat/merchant_list_notification",
                dataType: 'json'
            }).done(function( obj ) {
                if (obj.response == true) {
                    $.each(obj.notify, function(index, message) {
                        
                        $('#userid'+message.merchant_id).text(message.total);
                    });
                }
            });
}



function generate_date() {
    var d = new Date();
    var date = d.getDate();
    var year = d.getFullYear();
    var month = d.getMonth()+1;
    var hour = d.getHours();
    var minute = d.getMinutes();
    
    return date+'-'+month+'-'+year+' '+hour+':'+minute; 
}

function str_right_reply(content, date) {
    return '<div class="right-reply content"><div class="right-triangle"></div>'+content+'<div class="date">'+date+'</div></div>';
}

function str_left_reply(content, date) {
    return '<div class="left-reply content"><div class="left-triangle"></div>'+content+'<div class="date">'+date+'</div></div>';
}

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
