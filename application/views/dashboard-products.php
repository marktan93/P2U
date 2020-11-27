
<link type="text/css" rel="stylesheet" href="{path}back/js/plugins/qtip/jquery.qtip.css" />

<!-- Include either the minifed or production version, NOT both!! -->
<script type="text/javascript" src="{path}back/js/plugins/qtip/jquery.qtip.js"></script>

<!-- Optional: imagesLoaded script to better support images inside your tooltips -->
<script type="text/javascript" src="{path}back/js/plugins/qtip/imagesloaded.pkg.min.js"></script>


        <div id="page-wrapper">
            <div class="row">
                
                <div class="col-lg-12">
                    
                    <h1 class="page-header">Products Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li>Products</li>
                      </ol>
                    <!--e breadcrumb-->
                    <a href="<?=  site_url('products/add');?>">
                     <button type="button" class="btn btn-success">
                                        <span class="glyphicon glyphicon-plus"></span> Add Product
                                      </button>
                    </a>
                    <?php 
                        if ($products != null) {
                    ?>
                    <br />
                    <br />
                    <form method="POST" action="<?=  site_url("products/search");?>">
                        <div class="col-lg-4" style="margin-left: 0px; padding-left: 0px;">
                            <input type="text" value="" name="keyword" placeholder="Search Product id or Product name" class="form-control" />
                        </div>
                        <div class="col-lg-2">
                            <input type="submit" value="Search" class="form-control btn-success" />
                        </div>
                    </form>
                    <br />
                    <br />
                    <br />
                    <table id="product-data" class="table table-bordered">
                        <caption>Published products</caption>
                        <thead>
                            <tr class="success">
                                <th>No</th>
                                <th>Product image</th>
                                <th>Product name</th>
                                <th>Cost (Points)</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Methods</th>
                                <th>Balance</th>
                                <th>Vendor(s)</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <?php
                            if ($products != null) {
                                $i=0;
                                foreach ($products as $product) {
                                    $image = explode('.', $product['image']);
                            ?>
                            
                            <tr>
                                <td><?=++$i?></td>
                                <td><img src="{path}upload/products/thumbnail/<?=$image[0].'_thumb.'.$image[1];?>" /></td>
                                <td><?=$product['product_name']?></td>
                                <td><?=$product['cost_points'];?></td>
                                <td><?=date('Y-m-d', strtotime($product['start_date']));?></td>
                                <td><?=date('Y-m-d', strtotime($product['due_date']));?></td>
                                <td><?=  strtoupper($product['receive_mode']);?></td>
                                <td><?=$product['balance'];?></td>
                                <td style="text-align: center; cursor:pointer;"><img src="{path}images/house.png" productid="<?=$product['id'];?>" class="vendor" height="25" width="25" /></td>
                                <td>
                                    <label style="cursor:pointer;" href="#" activation="<?=$product['activation'];?>" productid="<?=$product['id'];?>" class="btn-activate">
                                        <span class="label label-<?=(($product['activation'] == true)?'success':'danger');?>"><?=(($product['activation'] == true)?'Activated':'Deactivated');?></span>
                                    </label>
                                </td>
                                <td align="center">
                                    <a href="<?=  site_url('products/edit/'.$product['id']);?>" class="btn btn-xs btn-info bs-tooltip" data-placement="top" data-original-title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                    <br />
                                    <br />
                                    <a class="btn-delete" href="<?=  site_url('products/delete/'.$product['id']);?>">
                                    <label href="#" class=" btn btn-xs btn-danger bs-tooltip" data-placement="top" data-original-title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                    
                                    </label>
                                    </a>
                                    </td>
                            </tr>
                            
                            <?php
                                }
                            }
                            ?>
                            
                            
                        </tbody>
                    </table>
                        
                    
                    <nav style="text-align: center;" >
                        <ul class="pagination">
                         
                          <?php
                                                      
                            for($i=1; $i<=$total_pages; $i++) {
                                echo "<li ".(($i == $current_page)?"class='active'":"")." ><a href='".  site_url("products/$page_name/$i")."'>".$i."</a></li>";
                            }
                          ?>
                        </ul>
                      </nav>
                        <?php } else {
                            
                            echo '<br /><br /> Start to add some products now.';
                        }?>
            <!-- /.row -->

        </div>
            
            <script type="text/javascript">
                $(document).ready(function() { 
                    
                    // tool tips ajax get value vendors
                    $(".vendor").each(function() {
                        $(this).qtip({
                            content: {
                                text: "Loading...",
                                ajax: {
                                    url: base_url+"products/get_vendor",
                                    type: "POST",
                                    data: {
                                        "product_id": $(this).attr("productid")
                                    },
                                    success: function(data, status) {
                                      this.set('content.text', data);
                                    }
                                }
                            }
                        })
                    });
                    
                    
                    // activate and deactivate
                    $('.btn-activate').click(function() {
                        var status;
                        var state;
                        $.ajax({
                          type: "POST",
                          url: base_url+"products/activate",
                          data: { product_id: $(this).attr('productid'), activation: $(this).attr('activation') },
                          async: false
                        })
                        .done(function( msg ) {
                            state = msg;
                            if (msg == 'null') {
                                error('Failed to activate / deactivate the product');
                            } else {
                                success('Successfully to activate / deactivate the product');
                                if (msg == "")
                                    status = false;
                                else 
                                    status = true;
                            }
                        });
                        if (state != 'null') {
                            var activate_button = $(this).children('span');
                            
                            if (status == true) {
                                $(this).attr('activation', 1);
                                activate_button.removeClass('label-danger');
                                activate_button.addClass('label-success');
                                activate_button.text('Activated');
                            } else {
                                $(this).attr('activation', 0);
                                activate_button.removeClass('label-success');
                                activate_button.addClass('label-danger');
                                activate_button.text('Deactivated');
                            }
                            
                        }
                    });
                    
                    // button delete product
                    $('.btn-delete').click(function(e) {
                        if (!confirm("Do you confirm want to proceed delete the product?"))
                            e.preventDefault();
                    });
                });
            </script>

