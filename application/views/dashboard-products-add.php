<link type="text/css" rel="stylesheet" href="{path}back/js/plugins/tagsinput/jquery.tagsinput.css" />
<script type="text/javascript" src="{path}back/js/plugins/tagsinput/jquery.tagsinput.js"></script>

<!-- Include the multiselect plugin's CSS and JS: -->
<script type="text/javascript" src="{path}back/js/plugins/multiselect/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="{path}back/js/plugins/multiselect/bootstrap-multiselect.css" type="text/css"/>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Product</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li><a href="<?= site_url('products')?>">Product</a></li>
                        <li>Add</li>
                      </ol>
                    <!--e breadcrumb-->
                    <form class="form-horizontal" id="product_form" role="form" action="<?=  site_url('products/add_process');?>" method="POST" enctype="multipart/form-data" >
                   
                        <div class="form-group">
                            <label class="control-label col-md-2">Product image</label>
                            <div class="col-md-10">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://placehold.it/200x150&text=NO%20IMAGE" style="height: 140px; width: 200px;" id="preview" alt="">
                                    </div>
                                    
                                    <div>
                                        <span id="btn-select" class="btn btn-default btn-file">
                                            <span >Select image</span>
                                        </span>
                                        <?=form_error("product_image");?>
                                        <input type="file" id="image-upload" name="product_image" style="opacity: 0; position: absolute; top: -100px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Product name</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control validate[required]" data-prompt-position="bottomLeft" name="product_name" placeholder="Please enter product name">
                              <?=form_error("product_name");?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Cost points</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control validate[required, number]" data-prompt-position="bottomLeft" name="cost_points" placeholder="Please enter cost points">
                              <?=form_error("cost_points");?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Balance</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control validate[required, integer]" data-prompt-position="bottomLeft" name="balance" placeholder="Please enter product balance">
                              <?=form_error("balance");?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Receive mode</label>
                          <div class="col-sm-10">
                              <select name="receive_mode" class="form-control validate[required]" data-prompt-position="bottomLeft">
                                  <option value="onpick">On-Pick</option>
                                  <option value="delivery">Delivery</option>
                              </select>
                              <?=form_error("receive_mode");?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Start date</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control validate[required]" data-prompt-position="bottomLeft" id="start_date" name="start_date" placeholder="Please enter start date">
                              <?=form_error("start_date");?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Due date</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control validate[required]" data-prompt-position="bottomLeft" id="due_date" name="due_date" placeholder="Please enter end date">
                              <?=form_error("due_date");?>
                          </div>
                        </div>
                        
                        <?php
                        // load the existing vendors
                        $tags = "";
                            if ($vendors != null) {
                                foreach ($vendors as $vendor) {
                                    $tags .= $vendor['name'].', ';
                                }
                            }
                            
                        ?>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Vendors</label>
                          <div class="col-sm-10">
                              <!-- Build your select: -->
                                <select id="vendors_multiselect" class="validate[required]" data-prompt-position="bottomLeft" name="vendors[]" multiple="multiple">
                                    <?php
                                        if ($vendors != null)
                                            foreach ($vendors as $vendor)
                                                echo '<option value='.$vendor['id'].'>'.$vendor['name'].'</option>';
                                    ?>
                                </select>
                                &nbsp; <a id="manage_vendors" style="cursor: pointer">Manage vendors</a>
                                <?=form_error("vendors");?>
                              <div style="display: none;">
                                <br />
                                <input type="text" id="vendors" value="<?=$tags;?>" class="form-control" />
                              </div>
                          </div>
                        </div>
                        
                        <input type="submit" value="Add" class="btn btn-success btn-lg" style="float: right;" />
                        
                      </form>
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->

            <script type="text/javascript">
                $(document).ready(function() {
                    // image upload
                    $('#btn-select').click(function() {
                        $('#image-upload').click();
                    });
                    
                   
                    $('#image-upload').change(function() {
                        readURL(this);
                    });
                    
                    /// validation engine
                    $("#product_form").validationEngine();
                    
                    //datepicker
                    $('#start_date').datepicker();
                    $('#due_date').datepicker();
                    
                    // tagsinput
                    $('#vendors').tagsInput({
                        'onAddTag': add_vendor,
                        'onRemoveTag':delete_vendor
                    });
                    
                    // multiselect list
                    $('#vendors_multiselect').multiselect();
                    
                    // manage vendors link
                    $('#manage_vendors').click(function() {
                        $(this).next().toggle( "bounce", { times: 2 }, "slow" );
                    });
                    
                });
                
                
                function add_vendor(value) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: base_url+"products/add_vendor",
                        data: { name: value }
                      })
                      .done(function( msg ) {
                          if (msg == null) {
                              error('Failed to add vendor');
                          } else {
                              success('Successfully add vendor');
                              update_vendors_list(msg);
                          }
                      });
                }
                
                function delete_vendor(value) {
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: base_url+"products/delete_vendor",
                        data: { name: value }
                      })
                      .done(function( msg ) {
                          if (msg == null) {
                              error('Failed to delete vendor');
                          } else {
                              success('Successfully delete vendor');
                              if (msg.data == 'error') {
                                  $('#vendors_multiselect').html("");
                                  $('#vendors_multiselect').multiselect('rebuild');
                              }
                              else
                                update_vendors_list(msg);
                          }
                      });
                }
                
                function update_vendors_list(obj) {
                    var vendor_multiselect = $('#vendors_multiselect');
                    vendor_multiselect.html('');
                    $.each(obj, function(index, value) {
                        vendor_multiselect.append("<option value='"+value.id+"'>"+value.name+"</option>");
                    });
                    vendor_multiselect.multiselect('rebuild');
                }
                
                // read the preview image url
                function readURL(input) {

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#preview').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                
            </script>