
     <div class="main">
	 	<div class="content">	
	 		 <div class="content_top">  
	 		     <div class="wrap">                                  		
            	   <div class="banner_desc">
            		<h1>Card revolution <span>made easy</span></h1>  
            		<h3>P2U provides new way of using card</h3>
					<!--maybe replace with image or youtube embeded video-->
            		<a class="play_icon fancybox-media" href="http://vimeo.com/33790882"><img src="{path}images/play-icon.png" alt="" /></a>
            		<h3>Start register premium with <span>30% discount</span> today!</h3>
            		<p>Paypal supported</p>
                        <?php 
                            if ($loggedIn == null) {
                        ?>
            		 <div class="sign_up">				  	
                             <form action="<?php echo site_url("home/signup");?>" method="POST">
                                 <input type="text" name="email" placeholder="Enter email address" /> 
					 		<input type="submit" value="Sign Up">
					  </form>
				    </div>
                        <?php } ?>
                </div>  
                     <div class="ipad">
            		     <img src="{path}images/ipad.png" alt="" />
            	     </div>
             <div class="clear"></div>
        </div>
     </div>
           <div class="features" id="features">
                 <div class="wrap">                             	
                 		  <h2>Begin new revolution by <span>today</span></h2>
                 		    <h4>Signup with your company, design the card</h4>
                 		        <div class="features_grids">
							     <div class="section group">
									<div class="grid_1_of_4 images_1_of_4">
										 <img src="{path}images/beautyful-teplates.png" alt="" />
										 <h3>Beautiful Card</h3>
										 <p>Distribute the pretty & fashion card by today, using the customization tools provided by P2U.</p>
									</div>
									<div class="grid_1_of_4 images_1_of_4">
										 <img src="{path}images/mobile.png" alt="" />
										 <h3>Mobile Ready</h3>
										 <p>Mobile no longer a problem for browsing this site. Android application can be downloaded by customers.</p>
									</div>
									<div class="grid_1_of_4 images_1_of_4">
										 <img src="{path}images/security.png" alt="" />
										  <h3>Increased Security</h3>
										  <p>Account is highly secured by P2U. Customer can feel secure to do any transaction in this place. Company will be verified genuine.</p>
									</div>
									<div class="grid_1_of_4 images_1_of_4">
										 <img src="{path}images/payment.png" alt="" />
										  <h3>Payment Options</h3>
										  <p>Paypal does provided to merchant. Subscribe to the product always the right choice.</p>
									</div>
					              </div>
					              
					        </div>
						</div>
           			</div>
           			 
           	  
     		</div>
  		 </div>	
   