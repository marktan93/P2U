<link type="text/css" rel="stylesheet" href="<?=  asset_url()?>back/css/invoice.css" />

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
                        <li><a href="<?= site_url('orders')?>">Orders</a></li>
                        <li>Info</li>
                      </ol>
                    <!--e breadcrumb-->
                    
                    <div class="col-lg-10" id="invoice_wrapper">
                        
                        <div class="col-lg-8 merchant-info">
                            <div class="heading-sm"><?=$order['merchant_name']?></div>
                            <div>Tel: <?=$order['merchant_contact'];?></div>
                        </div>
                        <div class="col-lg-4 heading">Invoice</div>
                        <div class="col-lg-12"><hr /></div>
                        <div class="col-lg-8 left" >
                            <div class="heading-sm">Sold to:</div>
                            <div><?=$order['fullname'];?></div>
                            <div>
                            <?=$order['address'];?>
                            </div>
                            <div>
                            Tel : <?=$order['contact'];?>
                            </div>
                            
                        </div>
                        <div class="col-lg-4 right">
                            <table cellpadding="0" border="0" cellspacing="0" style="text-align: left;">
                                <tr>
                                    <td><span class="heading-sm">Order ID</span> &nbsp; </td>
                                    <td>: <?=$order['order_id'];?></td>
                                </tr>
                                <tr>
                                    <td><span class="heading-sm">Order Date</span> &nbsp; </td>
                                    <td>: <?=$order['order_date'];?></td>
                                </tr>
                                <?php  
                                if ($order['receive_mode'] == 'delivery') {
                                ?>
                                <tr>
                                    <td><span class="heading-sm">Tracking Code</span> &nbsp; </td>
                                    <td>: <?=$order['tracking_code'];?></td>
                                </tr>
                                <tr>
                                    <td><span class="heading-sm">Courier Serive</span> &nbsp; </td>
                                    <td>: <?=  strtoupper($order['courier_service']);?></td>
                                </tr>
                                <?php } else {
                                ?>
                                    <td><span class="heading-sm">Receive Mode</span> &nbsp; </td>
                                    <td>: On-Pick</td>
                                
                                <?php
                                } ?>
                                <tr>
                                    <td><span class="heading-sm">Status</span> &nbsp; </td>
                                    <td>: <?= strtoupper($order['status']);?></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-lg-12 products">
                            <div class="clear"></div>
                            <table cellpadding="0" border="0" cellspacing="">
                                <tr>
                                    <th>ProductID</th>
                                    <th>Product Description</th>
                                    <th>Vendor</th>
                                    <th>Qty</th>
                                    <th>Unit points</th>
                                    <th>Total points</th>
                                </tr>
                                <?php 
                                $total = 0;
                                    foreach ($products as $product) {
                                ?>
                                <tr>
                                    <td><?=$product['id'];?></td>
                                    <td><a href="<?=site_url("products/edit/".$product['id']);?>"><?=$product['product_name'];?></a></td>
                                    <td><?=$product['name'];?></td>
                                    <td><?=$product['quantity'];?></td>
                                    <td><?=$product['cost_points'];?></td>
                                    <td><?php 
                                        echo $subtotal = $product['quantity']*$product['cost_points'];
                                        $total += $subtotal;
                                        ?></td>
                                </tr>
                                <?php }?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="heading-sm">Total</td>
                                    <td class="total"><?=$total;?></td>
                                </tr>
                            </table>
                        </div>
                        
                        <!--shipping and onpick details-->
                        <div>
                            
                        </div>
                        
                        <div class="col-lg-12 heading-sm" align="center"><br /><br />Note: This invoice is computer generated and no signature is required.</div>
                    </div>
                    <div class="col-lg-12" align="center">
                        <br />
                        <br />
                        <br />
                        <button type="button" onclick="PrintElem('#invoice_wrapper')" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
                    </div>
                <!-- /.col-lg-4 -->
                </div>
            <!-- /.row -->

        </div>

<script type="text/javascript">
    
function PrintElem(elem) {
    Popup(jQuery(elem).html());
}

function Popup(data) {
    var mywindow = window.open('', 'my div', 'height=400,width=600');
    mywindow.document.write('<html><head><title>Invoice</title>');
    mywindow.document.write('<link rel="stylesheet" href="<?=  asset_url()?>back/css/invoice.css" type="text/css" />');  
    mywindow.document.write('</head><body>');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');
    mywindow.document.close();
    mywindow.print();                        
}

</script>