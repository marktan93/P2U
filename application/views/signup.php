     <div class="main">
	 	<div class="content">	
			<div class="content_top">  
	 		    <div class="wrap">    
            	    <div class="my-custom-box">
                        <div class="my-custom-signup">
                            <h2>Signup to join us</h2><br />
                            <form id="signupform" class="form-horizontal" role="form" action="<?=  site_url('home/signup_process');?>" method="POST" >
                                <div class="form-group">
                                  <label for="sigunup_fullname" class="col-sm-2 control-label">Fullname</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control validate[required, custom[onlyLetterSp]]" id="sigunup_fullname" value="<?=  set_value('fullname');?>" name="fullname" placeholder="Please enter fullname">
                                      <?=form_error('fullname');?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="signup_ic" class="col-sm-2 control-label">ICNO</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control validate[required]" id="signup_ic" value="<?=  set_value('icno');?>" name="icno" placeholder="Please enter ic no">
                                    <?=form_error('icno');?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="signup_email" class="col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                      <input type="email" class="form-control {highlight} validate[required, custom[email]]" name="email" value="{email}" id="signup_email" placeholder="Please enter email">
                                      <?=form_error('email');?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="signup_password" class="col-sm-2 control-label">Password</label>
                                  <div class="col-sm-10">
                                    <input type="password" class="form-control validate[required]" id="signup_password" name="password" placeholder="Please enter password">
                                    <?=form_error('password');?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="signup_repassword" class="col-sm-2 control-label">Password</label>
                                  <div class="col-sm-10">
                                    <input type="password" class="form-control validate[required, equals[signup_password]]" name="repassword" id="signup_repassword" placeholder="Please retype password">
                                    <?=form_error('repassword');?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="signup_contact" class="col-sm-2 control-label">Contact</label>
                                  
                                  <div class="col-sm-10">
                                      <div class="input-group">
                                          <div class="input-group-addon">+60</div>
                                        <input type="text" class="form-control validate[required]" id="signup_contact" value="<?=  set_value('contact');?>" name="contact" placeholder="Please enter contact number">
                                        <?=form_error('contact');?>
                                      </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="signup_security_question" class="col-sm-2 control-label">Security Question</label>
                                  <div class="col-sm-10">
                                    <select class="selectpicker form-control validate[required]" name="sec_q" >
                                        <optgroup label="Pets">
                                            <option value="1">What is your pet's name?</option>
                                            <option value="2" >What is your first pet?</option>
                                        </optgroup>
                                        <optgroup label="Family">
                                            <option value="3">What is your father name?</option>
                                            <option value="4">What is your mother name?</option>
                                        </optgroup>
                                        <optgroup label="Others">
                                            <option value="5">What is your hobby?</option>
                                            <option value="6">What is your favorite book?</option>
                                        </optgroup>
                                      </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="signup_security_answer" class="col-sm-2 control-label">Security Answer</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control validate[required]" value="<?=  set_value('sec_a');?>" name="sec_a" id="signup_security_answer" placeholder="Please enter security answer">
                                    <?=form_error('sec_a');?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="captcha" class="col-sm-2 control-label">Captcha</label>
                                  <div class="col-sm-10">
                                      <img id="captcha" src="<?=site_url('captcha/show');?>" alt="CAPTCHA Image" />
                                    <input type="text" class='form-control validate[required]'  name="captcha_code" size="10" maxlength="6" />
                                    <?=form_error('captcha_code');?>
                                    <a href="#" onclick="document.getElementById('captcha').src = '<?=  site_url('captcha/show?namespace=');?>' + Math.random(); return false">[ Different Image ]</a>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Sign Up</button>
                                  </div>
                                </div>
                              </form>
                            <?php 
                            $error = $this->uri->segment(3);
                            if ($error == 'error')
                                echo 'Failed to register (Captcha or email existed)';
                        ?>
                        </div>
                        
					</div>  
                    
					<div class="clear"></div>
				</div>
			</div>
				
     	</div>
     </div>	

     <script>
         
         $(document).ready(function() {
             /// validation engine
             $("#signupform").validationEngine();
         });
        
     </script>
