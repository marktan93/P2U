
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Merchant Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li><a href="<?=  site_url('merchants');?>">Merchants</a></li>
                        <li>Profile</li>
                      </ol>
                    <!--e breadcrumb-->
                    <div class="col-lg-5">
                    <form class="form-horizontal" role="form" action="<?=  site_url('home/password_update');?>" method="POST" >
                        <div class="form-group">
                                  <label for="sigunup_fullname" class="col-sm-2 control-label">Fullname</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" disabled id="sigunup_fullname" value="<?=$user['fullname'];?>" placeholder="Please enter fullname">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="signup_ic" class="col-sm-2 control-label">ICNO</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" value='<?=$user['icno'];?>' id="signup_ic" disabled placeholder="Please enter ic no">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="signup_email" class="col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                      <input type="email" class="form-control" value='<?=$user['email'];?>' disabled id="signup_email" placeholder="Please enter email">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="signup_contact" class="col-sm-2 control-label">Contact</label>
                                  
                                  <div class="col-sm-10">
                                      <div class="input-group">
                                          <div class="input-group-addon">+60</div>
                                        <input type="text" class="form-control" value='<?=$user['contact'];?>' id="signup_contact" disabled placeholder="Please enter contact number">
                                      </div>
                                  </div>
                                </div>
                      </form>
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <?php if ($user['company_verification'] == false) { ?>
                        <form method="POST" action="<?=  site_url("merchants/approve")?>" >
                            <input type="hidden" value="<?=$user['user_id'];?>" name="merchant_id" />
                            <div class="col-lg-5"><input type="submit" value="Back" name="back" class="form-control  btn-info" /></div>
                            <div class="col-lg-5"><input type="submit" value="Approve" name="approve" class="form-control btn-success" /></div>
                        </form>
                        <?php }?>
                        <?php
                            $response = $this->uri->segment(4);
                            if (!empty($response)) 
                                if ($response == "success")
                                    echo 'Approved the company application';
                                else if ($response == 'failed')
                                    echo 'Internal error, faled to approve the company application';
                        ?>
                      </div>
                    <div class="col-lg-7">
                        <form class="form-horizontal" role="form" action="<?=site_url("dashboard/company_update");?>" method="POST" enctype="multipart/form-data" >
                                <div class="form-group">
                                  <label for="company_name" class="col-sm-2 control-label">Company name</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="company_name" name='company_name' <?php echo (($user['company_name'] == '')? '' : 'disabled');?> value='<?=$user['company_name'];?>' name='company_name' placeholder="Please enter company name">
                                    <a data-toggle="modal" style='cursor:pointer' data-target="#company" >Example</a>
                                  </div>
                                </div>
                    
                                <div class="form-group">
                                  <label for="company_regno" class="col-sm-2 control-label">Company Registration No</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="company_regno" name='company_regno' <?php echo (($user['company_reg_no'] == '')? '' : 'disabled');?> value='<?=$user['company_reg_no'];?>' placeholder="Please enter company registration number">
                                    <a data-toggle="modal" style='cursor:pointer' data-target="#company" >Example</a>
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label for="company_code" class="col-sm-2 control-label">Company Code</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="company_code" <?php echo (($user['company_code'] == '')? '' : 'disabled');?> name='company_code' value='<?=$user['company_code'];?>' placeholder="Please enter company code">
                                    <a data-toggle="modal" style='cursor:pointer' data-target="#company" >Example</a>
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label for="website" class="col-sm-2 control-label">Website</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="website" name='website' <?php echo (($user['website'] == '')? '' : 'disabled');?> value='<?=$user['website'];?>' placeholder="Please enter website">
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label for="company_logo" class="col-sm-2 control-label">Company Logo</label>
                                  <div class="col-sm-10">
                                    <?php 
                                        if ($user['company_logo'] != "") {
                                            $logo_array = explode('.', $user['company_logo']);
                                            echo '<img src="'.asset_url().'upload/logo/thumbnail/'.$logo_array[0].'_thumb.'.$logo_array[1].'" />';
                                        } else {
                                            echo '<input type="file" class="form-control filestyle" name="company_logo" id="company_logo" >';
                                        }
                                        
                                    ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="user_ic" class="col-sm-2 control-label">User IC</label>
                                  <div class="col-sm-10">
                                    <?php 
                                        if ($user['ic_img'] != "") {
                                            $ic_array = explode('.', $user['ic_img']);
                                            echo '<img src="'.asset_url().'upload/ic/thumbnail/'.$ic_array[0].'_thumb.'.$ic_array[1].'" />';
                                        } else {
                                            echo '<input type="file" class="form-control filestyle" name="user_ic" id="user_ic" >';
                                            echo '<a data-toggle="modal" style="cursor:pointer" data-target="#myModal" >Example</a>';
                                        }
                                        
                                    ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label"></label>
                                  <div class="col-sm-10">
                                      <?php echo (($user['company_code'] == '')? "<input type='checkbox' name='term_condition'> I accept all the <a style='cursor: pointer;' data-toggle='modal' data-target='#term'>terms and conditions</a>." : '');?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                                      <?php echo (($user['company_code'] == '')? '<button type="Submit" class="btn btn-default">Submit</button>' : '');?>
                                    
                                  </div>
                                </div>
                      </form>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->

            