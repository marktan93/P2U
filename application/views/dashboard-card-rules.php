
        <div id="page-wrapper">
            <div class="row">
                
                <div class="col-lg-12">
                    
                    <h1 class="page-header">Card management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li><a href="<?=  site_url('card');?>">Card</a></li>
                        <li>Rules</li>
                      </ol>
                    <!--e breadcrumb-->
                    
                   <ul class="nav nav-pills nav-justified" role="tablist">
                        <li role="presentation" ><a href="<?=  site_url('card');?>">Info</a></li>
                        <li role="presentation" ><a href="<?=  site_url('card/edit');?>">Edit</a></li>
                        <li role="presentation" class="active"><a href="<?=  site_url('card/rules');?>">Rules</a></li>
                   </ul>
                    <br />
                    <br />
                   
                    <?php
                                if ($rule != null) {
                            ?>
                    
                    <table id="my-data" class="table table-bordered">
                        <caption>Existing rules</caption>
                        <thead>
                            <tr class="success">
                                <th>No</th>
                                <th>Purchase amount (RM)</th>
                                <th>Rules</th>
                                <th>Points Awarded</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            
                            <tr>
                                <td>1</td>
                                <td><?= $rule['purchase_amount']; ?></td>
                                <td>More than or equal (Every)</td>
                                <td><?= $rule['points_rewarded'];?></td>
                                <td align="center"><label id="btndelete" href="#" class="btn-delete btn btn-xs btn-danger bs-tooltip" ruleid="<?=$rule['id'];?>" data-placement="top" data-original-title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </label></td>
                            </tr>
                            
                        </tbody>
                    </table>
                    <?php } ?>    
                    
                    <div class="col-lg-12">
                        <form class='service_info form-horizontal'>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Default point(s)</label>
                              <div class="col-sm-10">
                                <div class="input-group spinner">
                                    <input type="text" class="form-control spn" value="<?=$user['card_initial_points'];?>" id="default-points" disabled="disabled" >
                                    <div class="input-group-btn-vertical">
                                      <button class="btn btn-default spn" disabled="disabled" ><i class="fa fa-caret-up"></i></button>
                                      <button class="btn btn-default spn" disabled="disabled" ><i class="fa fa-caret-down"></i></button>
                                    </div>
                                  </div><br />
                                 <a style="cursor: pointer" id="link-enable">Enable</a>
                              </div>
                            </div>
                            <hr />
                            
                            <!--form add rule-->
                            <div id="form-add-rule" <?= ($rule!=null?'style="display: none;"': '')?> >
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Purchase Amount</label>
                                  <div class="col-sm-10">
                                      <div class="input-group">
                                              <div class="input-group-addon">RM</div>
                                            <input type="text" id="amount" class="form-control" value="" placeholder="Enter purchase amount">
                                          </div>

                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Points Awarded</label>
                                  <div class="col-sm-10">
                                    <input type="text" id="points_awarded" class="form-control" value="" placeholder="Enter points awarded">
                                  </div>
                                </div>
                                <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" id="btn-add-rule" class="btn btn-default btn-success"  value="Add Rule" />
                                      </div>
                                </div>
                            </div>
                        </form>
                    </div>
            <!-- /.row -->

        </div>
            
<script>
    // default points
    $('#link-enable').click(function() {
        $('.spn').removeAttr('disabled');
        $(this).after("<button id='save-spn' class='btn btn-default btn-success btn-sl'>Save</button>");
        $(this).remove();
    });
    
    // update initial points (AJAX) 
    $('body').on('click', '#save-spn', function(e) {
        e.preventDefault();
        
        $.ajax({
          type: "POST",
          url: base_url+"card/initial_points",
          data: { points: $("#default-points").val() }
        })
        .done(function( msg ) {
            if (msg == 'null')
                error('Failed to update initial points');
            else 
                success('Successfully updated initial points');
        });
        
        $('.spn').attr('disabled', 'disabled');
        $('#save-spn').hide();
    });
    
    // add rule (ajax)
    $('#btn-add-rule').click(function (e) {
        e.preventDefault();
        var amount = $('#amount').val();
        var points_awarded = $('#points_awarded').val();
        
        $.ajax({
          type: "POST",
          url: base_url+"card/add_rule",
          data: { amount: amount, points_awarded: points_awarded }
        })
        .done(function( msg ) {
            if (msg == 'null') {
                error('Failed to add rule');
            } else {
                $('#amount').val('');
                $('#points_awarded').val('');
                success('Successfully add rule');
                location.reload();
            }
        });
        
    });
    
    // delete rules (ajax)
    $('#btndelete').click(function () {
        var ruleid = $(this).attr('ruleid');
        $.ajax({
          type: "POST",
          url: base_url+"card/delete",
          data: { ruleid: ruleid }
        })
        .done(function( msg ) {
            if (msg == 'null') {
                error('Failed delete rule');
            } else {
                success('Successfully delete rule');
                location.reload();
            }
        });
    });
    
    // Spinner    
    (function ($) {
      $('.spinner .btn:first-of-type').on('click', function(e) {
          e.preventDefault();
        $('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
      });
      $('.spinner .btn:last-of-type').on('click', function(e) {
          e.preventDefault();
          var input = $('.spinner input');
          if (input.val() <= 0) {
              input.val(0)
          } else {
              $('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
          }
      });

      $('.spinner').focusout(function() {
          var input = $('.spinner input');
          if (input.val() < 0) {
              input.val(0);
          }
      });
    })(jQuery);
    
    
</script>
