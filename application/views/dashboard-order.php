 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">P2U Order</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li><a href="<?=  site_url('services');?>">Services</a></li>
                        <li>Order</li>
                      </ol>
                    <!--e breadcrumb-->
                    <div style="text-align: center">
                   
                    <div class="col-lg-8">
                    <!--after purchase the product-->
                    <div class='service_info form-horizontal'>
                       
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Service name</label>
                                  <div class="col-sm-10">
                                      <div class='form-control-static'><?=$service['service_name'];?></div>
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Service duration</label>
                                  <div class="col-sm-10">
                                    <div class='form-control-static'><?=$service['service_duration'];?> Year</div>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Discount</label>
                                  <div class="col-sm-10">
                                    <div class='form-control-static'><?=$service['discount'];?> %</div>
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Price</label>
                                  <div class="col-sm-10">
                                    <div class='form-control-static'>RM <?=$service['cost']?></div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label"></label>
                                  <div class="col-sm-10"><a href="<?=  site_url('dashboard/services');?>">
                                          <a href="<?= site_url('services/cancel');?>"><button type="button" class="btn btn-default">
                                        Cancel
                                      </button>
                                    </a>
                                      <a href="<?=  site_url('services/payment_info/'.$service['id']);?>">
                                    <button type="button" class="btn btn-default">
                                         Checkout
                                      </button>
                                          </a>
                                  </div>
                                </div>
                    </div>
                </div>
                        
                        
                </div>
                
         </div></div>