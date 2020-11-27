     <div class="main">
	 	<div class="content">	
			<div class="content_top">  
	 		    <div class="wrap">    
            	    <div class="my-custom-box">
                        <div class='my-custom-api'>
                            <h2>Contact us</h2><br /><br />
                            <p style="color: #fff;">It's been our honor to serve and answer any question for you. Please don't feels hesitate to ask question and let our professional team to solve that with you efficiently.</p>
                            <br />                            
                            Please enter the following details correctly to ensure that we are able to keep in touch with you. Thanks.
                            <br /><br />
                            Your information will not expose to others.
                            <br />
                            <br />
                            <br /><br />

                        <form id="contactform" class="form-horizontal" role="form" action="<?=  site_url('home/contact_process');?>" method="POST" >
                                <div class="form-group">
                                  <label for="contact_fullname" class="col-sm-2 control-label">Fullname</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control validate[required, custom[onlyLetterSp]]" id="contact_fullname" value='<?=  set_value('fullname');?>' name="fullname" placeholder="Please enter fullname">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="contact_email" class="col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control validate[required, custom[email]]" id="contact_email" value='<?=  set_value('email');?>' name="email" placeholder="Please enter email">
                                  </div>
                                </div>
                                <div class="form-group">
                                      <label for="contact_mobile" class="col-sm-2 control-label">Contact</label>

                                      <div class="col-sm-10">
                                          <div class="input-group">
                                              <div class="input-group-addon">+60</div>
                                            <input type="text" class="form-control validate[required]" id="contact_mobile" value='<?=  set_value('mobile');?>' name="mobile" placeholder="Please enter contact number">
                                          </div>
                                      </div>
                                    </div>
                                <div class="form-group">
                                  <label for="contact_content" class="col-sm-2 control-label">Content</label>
                                  <div class="col-sm-10">
                                      <textarea class="form-control validate[required,  custom[onlyLetterSp]]" id="contact_content"  name="content" placeholder="Please enter your problem."><?=  set_value('content');?></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="contact_content" class="col-sm-2 control-label"></label>
                                  <div class="col-sm-10">
                                      <input type="submit" value="Send" class="form-control btn-success" />
                                  </div>
                                </div>
                        </form>
                        <p style='color: #fff;'>
                                    <?php echo validation_errors(); ?>
                                </p>
                        </div>
					</div>  
                                
                    
					<div class="clear"></div>
				</div>
			</div>
				
     	</div>
     </div>	 <script>
         
         $(document).ready(function() {
             /// validation engine
             $("#contactform").validationEngine();
         });
        
     </script>