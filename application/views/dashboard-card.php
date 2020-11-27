

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
                        <li>Info</li>
                      </ol>
                    <!--e breadcrumb-->
                    
                   <ul class="nav nav-pills nav-justified" role="tablist">
                        <li role="presentation" class="active" ><a href="<?=  site_url('card');?>">Info</a></li>
                        <li role="presentation" ><a href="<?=  site_url('card/edit');?>">Edit</a></li>
                        <li role="presentation"><a href="<?=  site_url('card/rules');?>">Rules</a></li>
                   </ul>
                    <br />
                    
                    <?php 
                    
                        if ($card['card_name'] == null) {
                    ?>
                    
                    <div class="alert alert-warning" role="alert">
                        <span class="glyphicon glyphicon-info-sign"></span> You don't have card, create it at <a href="<?=  site_url('card/edit');?>" class="alert-link">here</a> and don't forget to set the <a href="<?=  site_url('card/rules');?>" class="alert-link">rules</a>
                      </div>
                        <?php } else {?>
                    
                    
                    <br />
                    <div class="col-lg-5">
                        <img src='<?= asset_url()?>upload/card/<?=$card['card_img'];?>' class='card-img' >
                    </div>
                    
                    
                    
                    <div class='service_info form-horizontal col-lg-7'>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Card name</label>
                                  <div class="col-sm-10">
                                    <div class="form-control-static"><?=$card['card_name'];?></div>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Card Status</label>
                                  <div class="col-sm-10">
                                      <div class="form-control-static">
                                          <?php
                                          if ($rules == null)
                                              echo 'Please setup the rules first';
                                          else 
                                              echo 'Ready';
                                          ?> 
                                  </div>
                                </div>
                                
                    </div>
                        <?php }?>
                <!-- /.col-lg-4 -->
                </div>
            <!-- /.row -->

        </div>
            