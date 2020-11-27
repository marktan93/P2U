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

                            <div style='width: 400px; height: 200px; border: 1px solid #fff; line-height: 200px; text-align: center; 
                                 margin: 0px auto; background-color: #49ea6d; border-radius: 4px;'>
                                Successfully sent the message to admin.
                            </div>
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