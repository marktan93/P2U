$(document).ready(function() {
    
    var glob_this;
    
    // update paid to packaging
    $('.btn-check-paid').click(function(e) {
        if (!$(this).hasClass('btn-check-packaging')) {
            var orderid = $(this).attr('orderid');
            var status = false;
            if (confirm("Confirm to update Order id ("+orderid+") to Packaging ?")) {
                // update paid status
                $.ajax({
                    type: "POST",
                    url: base_url+"orders/update_paid",
                    data: { order_id : orderid },
                    async: false
                }).done(function( msg ) {
                    if (msg == 'success') {
                        success('Successfully update paid to packaging state');
                        status = true;
                    } else {
                        error('Failed to update paid to packaging state');
                    }
                });
                
                if (status == true) {
                    $(this).parent().parent().find('td:nth-child(2)').text('PACKAGING');
                    $(this).prev().hide();
                    $(this).removeClass('btn-check-paid');
                    $(this).addClass('btn-check-packaging');
                    $(this).attr('data-toggle', 'modal');
                    $(this).attr('data-target', '#packagingModal');
                }
                
                e.stopPropagation();
            }
        }
    });
    
    // display different modal for delivery and onpick
    $('body').on('click', '.btn-check-packaging', function() {
        glob_this = $(this);
        var receive_mode = $(this).parent().parent().find('td:nth-child(3)').text();
        if (receive_mode == 'DELIVERY') {
            $('.onpick-form').hide();
            $('.delivery-form').fadeIn('fast');
            $('#btn-save').removeClass('save-onpick-form');
            $('#btn-save').addClass('save-delivery-form');
        } else {
            $('.delivery-form').hide();
            $('.onpick-form').fadeIn();
            $('#btn-save').removeClass('save-delivery-form');
            $('#btn-save').addClass('save-onpick-form');
        }
        
        $('#btn-save').attr('orderid', $(this).attr('orderid'));
    });
    
    // update packaging to ready on pick
    $('body').on('click', '.save-onpick-form', function () {
        var status = false;
        var order_id = $(this).attr('orderid');
        if (order_id != null) {
            $.ajax({
                type: "POST",
                url: base_url+"orders/update_pickup",
                data: { order_id : order_id },
                async: false
            }).done(function( msg ) {
                if (msg == 'success') {
                    success('Successfully update packaging to ready');
                    status = true;
                } else {
                    error('Failed to update packaging to ready');
                }
            });
            
            if (status == true) {
                glob_this.parent().parent().find('td:nth-child(2)').text("READY");
                glob_this.parent().parent().css('background-color', '#ececec');
                glob_this.hide();
            }
            
        }
    });
    
    // update packaging to delivered
    $('body').on('click', '.save-delivery-form', function () {
        var status = false;
        var order_id = $(this).attr('orderid');
        var courier_service = $('#courier_service').val();
        var tracking_code = $('#tracking_code').val();
        if (order_id != null && courier_service != null && tracking_code != null) {
            $.ajax({
                type: "POST",
                url: base_url+"orders/update_delivery",
                data: { order_id : order_id, courier_service: courier_service, tracking_code: tracking_code },
                async: false
            }).done(function( msg ) {
                if (msg == 'success') {
                    success('Successfully update packaging to delivered');
                    status = true;
                } else {
                    error('Failed to update packaging to delivered');
                }
            });
            
            if (status == true) {
                glob_this.parent().parent().find('td:nth-child(2)').text("DELIVERED");
                glob_this.parent().parent().css('background-color', '#ececec');
                glob_this.hide();
            }
            
        }
    });
    
    // delete order
    $('.btn-delete-order').click(function(e) {
        var orderid = $(this).attr('orderid');
        if (!confirm("Confirm to delete Order id ("+orderid+") ? It will auto rollback the transaction.")) {
            e.preventDefault();
        }
    });
    
});