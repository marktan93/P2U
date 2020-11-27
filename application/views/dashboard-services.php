<link href="{path}back/css/pricingtable.css" rel="stylesheet">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">P2U Services</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li>Services</li>
                      </ol>
                    <!--e breadcrumb-->
                    <!--before purchase -->
                    <?php
                    if ($payment == false) {
                    ?>
                    <div style="text-align: center">
                    
                    <div class="alert alert-warning" role="alert">
                           <span class="glyphicon glyphicon-info-sign"></span> Hi, start your loyalty program by purchasing our service. Thanks.
                      </div>
                    <!--pricing table-->
                    <div class="plans">
                        <?php
                            foreach ($services as $service) {
                        ?>
                        
                            <div class="plan">
                                <h2 class="plan-title"><?=$service['service_name'];?></h2>
                                <p class="plan-price"><?=$service['service_duration']?> <span> / year</span></p>
                                <ul class="plan-features">
                                  <li><strong>Card customization</strong></li>
                                  <li><strong>QR code</strong> API</li>
                                  <li><strong><?=$service['discount'];?>%</strong> discount</li>
                                  <li><strong>RM <?=$service['cost'];?></strong> / <?=$service['service_duration'];?> year</li>
                                </ul>
                                <a href="<?=  site_url('services/order/'.$service['id'])?>" class="plan-button">Purchase</a>
                              </div>
                        
                        <?php
                            }
                        ?>
                        
                       
                    <!--end of pricing table-->
                    
                    
                    </div>
                    </div>
                        <?php } else {?>
                <div class="col-lg-8">
                    <!--after purchase the product-->
                    <div class='service_info form-horizontal'>
                       
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Package</label>
                                  <div class="col-sm-10">
                                      <div class='form-control-static'><?=$service['service_name']?></div>
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Duration</label>
                                  <div class="col-sm-10">
                                    <div class='form-control-static'><?=$service['service_duration']?> Year(s)</div>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Purchased at</label>
                                  <div class="col-sm-10">
                                    <div class='form-control-static'><?=$service['last_update']?></div>
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Expire Date</label>
                                  <div class="col-sm-10">
                                    <div class='form-control-static'><?=$service['expiry_date']?></div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label"></label>
                                  <div class="col-sm-10">
                                      <!--
                                      <a href="<?php echo site_url('services/extend/'.$service['id']);?>"><button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-heart"></span> Extends Subscription
                                      </button>
                                    </a>
                                      -->
                                      <a href="<?php echo site_url('services/freeze/'.$service['id']);?>" class="confirmbtn" ><button type="button" class="btn btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-fire"></span> Terminate Subscription
                                      </button>
                                    </a>
                                  </div>
                                </div>
                    </div>
                </div>
                        <?php }?>
         </div>

            
<script>
    $(document).ready(function() {
        $('.plan').hover(function() {
            $(this).addClass('plan-tall');
        }, function() {
            $(this).removeClass('plan-tall');
        });
        
        
        $('.confirmbtn').click(function(e) {
            var result = confirm('Warning, you sure want to terminate the service ?');
            if (result == false)
                e.preventDefault();
        });
        
    });
    </script>