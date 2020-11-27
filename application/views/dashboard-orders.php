<script type="text/javascript" src="<?=  asset_url()?>back/js/order.js"></script>

        <div id="page-wrapper">
            <div class="row">
                
                <div class="col-lg-12">
                    
                    <h1 class="page-header">Orders Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li>Orders</li>
                      </ol>
                    <!--e breadcrumb-->
                    
                   <ul class="nav nav-pills nav-justified" role="tablist">
                        <li role="presentation" <?=($this->uri->segment(2) == 'index' || $this->uri->segment(2) == null)?'class="active"':''?> ><a href="<?=  site_url('orders');?>">All</a></li>
                        <li role="presentation" <?=($this->uri->segment(2) == 'paid')?'class="active"':''?> ><a href="<?=  site_url('orders/paid');?>">Paid<?php if ($badges_paid != null) {?><span class="badge"><?=$badges_paid['total'];?></span><?php }?> </a></li>
                        <li role="presentation" <?=($this->uri->segment(2) == 'packaging')?'class="active"':''?>><a href="<?=  site_url('orders/packaging');?>">Packaging<?php if ($badges_packaging != null) {?><span class="badge"><?=$badges_packaging['total'];?></span><?php }?></a> </li>
                        <li role="presentation" <?=($this->uri->segment(2) == 'ready')?'class="active"':''?>><a href="<?=  site_url('orders/ready');?>">Ready(Pickup)</a></li>
                        <li role="presentation" <?=($this->uri->segment(2) == 'delivered')?'class="active"':''?>><a href="<?=  site_url('orders/delivered');?>">Delivered</a></li>
                   </ul>
                    
                    <?php 
                    
                     if ($orders != null) {
                    ?>
                    <br />
                    <form method="POST" action="<?=  site_url("orders/search");?>">
                        <div class="col-lg-4">
                            <input type="text" value="" name="keyword" placeholder="Search Order id or customer name" class="form-control" />
                        </div>
                        <div class="col-lg-2">
                            <input type="submit" value="Search" class="form-control btn-success" />
                        </div>
                    </form>
                    <br />
                    <br />
                    <br />
                    <table id="product-data" class="table table-bordered">
                        <thead>
                            <tr class="success">
                                <th>Order ID</th>
                                <th>Status</th>
                                <th>Receive Mode</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <?php
                           
                                $i=0;
                                foreach ($orders as $order) {
                            ?>
                            
                            <tr>
                                <td><?=$order['id'];?></td>
                                <td><?=  strtoupper($order['status'])?></td>
                                <td><?=  strtoupper($order['receive_mode'])?></td>
                                <td><?=$order['fullname']?></td>
                                <td><?=$order['last_update']?></td>
                                <td align="center">
                                    <?php
                                        if ($order['status'] == 'paid' || $order['status'] == 'packaging') {
                                            if ($order['status'] == 'packaging') {
                                    ?>
                                    <label href="#" class=" btn btn-xs btn-success bs-tooltip btn-check-packaging" orderid="<?=$order['id'];?>" data-toggle="modal" data-target="#packagingModal" data-placement="top" data-original-title="check">
                                                    <i class="fa fa-check"></i>
                                    
                                    </label>
                                    <?php 
                                            } else {
                                    ?>
                                    <a class="btn-delete-order" orderid="<?=$order['id'];?>" href="<?=site_url('orders/delete/'.$order['id']);?>">
                                    <label href="#" class=" btn btn-xs btn-danger bs-tooltip "   data-placement="top" data-original-title="check">
                                                    <i class="fa fa-trash-o"></i>
                                                    </label>
                                    </a>
                                    
                                    <label href="#" class=" btn btn-xs btn-success bs-tooltip btn-check-paid" orderid="<?=$order['id'];?>"  data-placement="top" data-original-title="check">
                                                    <i class="fa fa-check"></i>
                                    
                                    </label>            
                                    <?php            
                                            }
                                        } ?>
                                    <a  href="<?=  site_url('orders/info/'.$order['id']);?>">
                                    <label href="#" class=" btn btn-xs btn-info bs-tooltip" data-placement="top" data-original-title="Info">
                                                    <i class="fa fa-info-circle"></i>
                                    
                                    </label>
                                    </a></td>
                            </tr>
                            
                            <?php
                                }
                            
                            ?>
                            
                            
                        </tbody>
                    </table>
                    
                    <nav style="text-align: center;" >
                        <ul class="pagination">
                         
                          <?php
                                                      
                            for($i=1; $i<=$total_pages; $i++) {
                                echo "<li ".(($i == $current_page)?"class='active'":"")." ><a href='".  site_url("orders/$page_name/$i")."'>".$i."</a></li>";
                            }
                          ?>
                        </ul>
                      </nav>
                    
                     <?php } else {
                         echo '<br />';
                         echo 'No records found.';
                         
                     }?>
                <!-- /.col-lg-4 -->
                </div>
            <!-- /.row -->

        </div>

<!--packaging Modal-->

<div class="modal fade" id="packagingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Packaging</h4>
      </div>
      <div class="modal-body">
          <div class="onpick-form" style="display: none">
              <p>When the product is ready, click confirm and ready for customer to pickup.</p>
          </div>
          <form class="delivery-form" style="display: none">
              Select a courier services <br /><br />
              <select id="courier_service" class="form-control">
                  <option value="poslaju">Poslaju</option>
                  <option value="skynet">Skynet</option>
                  <option value="gdex">GD-EX</option>
              </select>
              <br />
              Enter tracking code <br /><br />
              <input type="text" id="tracking_code" value="" class="form-control" placeholder="Enter tracking code" />
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn-save" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>