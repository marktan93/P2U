

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Company profile management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url("dashboard");?>">Dashboard</a></li>
                        <li>Company profile</li>
                      </ol>
                    <!--e breadcrumb-->
                    
                    <?php echo (($user['company_reg_no'] == '')? '<div class="alert alert-warning" role="alert">
                           <span class="glyphicon glyphicon-info-sign"></span> Once submitted cannot make changes anymore. Thanks.
                      </div>' : '');?>
                    
                    <?php 
                    
                        if ($user['company_verification'] == true) {
                            echo '<div class="alert alert-success" role="alert">
                                        <span class="glyphicon glyphicon-ok"></span> Your company has been verified.
                                   </div>';
                        } 
                        
                        if ($user['company_verification'] == false && $user['company_reg_no'] != '' ) {
                            echo '<div class="alert alert-warning" role="alert">
                                    <span class="glyphicon glyphicon-info-sign"></span> Your company is in verification progress.
                               </div>';
                        }
                    
                    ?>
                    
                    <form class="form-horizontal" id="company-form" role="form" action="<?=site_url("dashboard/company_update");?>" method="POST" enctype="multipart/form-data" >
                                <div class="form-group">
                                  <label for="company_name" class="col-sm-2 control-label">Company name</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control validate[required]" id="company_name" name='company_name' value='<?=$user['company_name'];?>' name='company_name' placeholder="Please enter company name">
                                    <a data-toggle="modal" style='cursor:pointer' data-target="#company" >Example</a>
                                  </div>
                                </div>
                    
                                <div class="form-group">
                                  <label for="company_regno" class="col-sm-2 control-label">Company Registration No</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control validate[required]" id="company_regno" name='company_regno' value='<?=$user['company_reg_no'];?>' placeholder="Please enter company registration number">
                                    <a data-toggle="modal" style='cursor:pointer' data-target="#company" >Example</a>
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label for="company_code" class="col-sm-2 control-label">Company Code</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control validate[required]" id="company_code" name='company_code' value='<?=$user['company_code'];?>' placeholder="Please enter company code">
                                    <a data-toggle="modal" style='cursor:pointer' data-target="#company" >Example</a>
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label for="website" class="col-sm-2 control-label">Website</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control validate[required]" id="website" name='website' value='<?=$user['website'];?>' placeholder="Please enter website">
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
                                            //echo '<input type="file" class="form-control filestyle" name="company_logo" id="company_logo" >';
                                        }
										echo '<br />';
										echo '<br />';
                                        echo '<input type="file" class="form-control filestyle" name="company_logo" id="company_logo" >';
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
                                            //echo '<input type="file" class="form-control filestyle" name="user_ic" id="user_ic" >';
                                            //echo '<a data-toggle="modal" style="cursor:pointer" data-target="#myModal" >Example</a>';
                                        }
										echo '<br />';
										echo '<br />';
                                        echo '<input type="file" class="form-control filestyle" name="user_ic" id="user_ic" >';
                                        
										echo '<a data-toggle="modal" style="cursor:pointer" data-target="#myModal" >Example</a>';
                                    ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label"></label>
                                  <div class="col-sm-10">
                                    <input type='checkbox' name='term_condition'> I accept all the <a style='cursor: pointer;' data-toggle='modal' data-target='#term'>terms and conditions</a>.
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <button type="Submit" class="btn btn-default">Submit</button>
                                  </div>
                                </div>
                      </form>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->

            <!-- modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h4 class="modal-title" id="myModalLabel">Example of IC image</h4>
                    </div>
                    <div class="modal-body"  style='text-align: center'>
                        <div class="alert alert-warning" role="alert">
                           <span class="glyphicon glyphicon-info-sign"></span> 
                           Our system will watermark the image. Thanks. <br />
                      </div>
                      <img src='{path}/images/mrbean.jpg' />
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            <!--company modal-->
            <div class="modal fade" id="company" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h4 class="modal-title" id="myModalLabel">Example of Company details</h4>
                    </div>
                    <div class="modal-body"  style='text-align: left'>
                       Company Name: Agensi Pekerjaan Fokas Mulia Sdn Bhd
                       <br />
                       <br />
                       Company registration no. : 603355-T
                       <br />
                       <br />
                       Company code : APFM54
                       <br />
                       * Searchable by user, easier to be identified
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            
            <!--terms and conditions-->
            <div class="modal fade" id="term" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h4 class="modal-title" id="myModalLabel">Terms and conditions</h4>
                    </div>
                    <div class="modal-body"  style='text-align: left'>
                        <ol>
                           <li>The content of the pages of this website is for your general information and use only. It is subject to change without notice.</li> 
                           <li>This website uses cookies to monitor browsing preferences. If you do allow cookies to be used, the following personal information may be stored by us for use by third parties: [insert list of information].</li> 
                           <li>Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.</li> 
                           <li>Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.</li> 
                           <li>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</li> 
                           <li>All trade marks reproduced in this website which are not the property of, or licensed to, the operator are acknowledged on the website.</li> 
                           <li>Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.</li> 
                           <li>From time to time this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).</li> 
                           <li>Your use of this website and any dispute arising out of such use of the website is subject to the laws of England, Northern Ireland, Scotland and Wales.</li> 
                        </ol>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
<script>
         
         $(document).ready(function() {
             /// validation engine
             $("#company-form").validationEngine();
         });
        
     </script>