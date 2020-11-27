
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User profile management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li>User profile</li>
                      </ol>
                    <!--e breadcrumb-->
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
                                  <label for="signup_password" class="col-sm-2 control-label">Password</label>
                                  <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" value='' id="signup_password" placeholder="Please enter password">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="signup_repassword" class="col-sm-2 control-label">Password</label>
                                  <div class="col-sm-10">
                                    <input type="password" class="form-control" name="repassword" value='' id="signup_repassword" placeholder="Please retype password">
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
                                <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Update</button>
                                    <span title='Contact us to update the core details' class="glyphicon glyphicon-question-sign"></span>
                                  </div>
                                </div>
                      </form>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->

            