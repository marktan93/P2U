<!DOCTYPE HTML>
<html>
<head>
<title>P2U | Evolution of Card - {title}</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="{path}front/js/jquery.min.js" type="text/javascript"></script>

<!--bootstrap files-->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{path}front/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{path}front/dist/css/bootstrap-select.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="{path}front/dist/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="{path}front/dist/js/bootstrap.min.js"></script>
<script src="{path}front/dist/js/bootstrap-select.min.js"></script>
<!--end of bootstrap files-->



<link href="{path}front/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="shortcut icon" href="{path}front/images/icon.ico" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,500,900' rel='stylesheet' type='text/css'>

<script src="{path}front/js/script.js" type="text/javascript"></script>
<script src="{path}front/js/jquery.magnific-popup.js" type="text/javascript"></script>

<script src="{path}front/dist/js/jquery.maskedinput.min.js" type="text/javascript"></script>

<!-- validation plugin -->
<script src="{path}plugins/validation-engine/js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="{path}plugins/validation-engine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" href="{path}plugins/validation-engine/css/validationEngine.jquery.css" type="text/css"/>
<!-- end of validation plugin--->



<link href="{path}front/css/magnific-popup.css" rel="stylesheet" type="text/css">
<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="{path}front/js/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="{path}front/css/jquery.fancybox.css" media="screen" />
	<script type="text/javascript" src="{path}front/js/jquery.fancybox-media.js"></script>	

        
</head>
<body>
  <div class="header" id="home">
  	  <div class="header_top">
	   <div class="wrap">
		 	     <div class="logo">
                                 <a href="<?php echo site_url("home/index");?>"><img src="{path}images/logo.jpg" alt="P2U Logo" height="50" /></a>
					</div>	
						<div class="menu">
						    <ul>
                                                        <li><a href="<?php echo site_url("home/index");?>">Home</a></li>
								<li><a class="popup-with-zoom-anim" href="#small-dialog">Pricing</a></li>
								<li class="hover-drop"><a href="#" >Support</a>
                                    <ul>
                                        <li><a href="../forum" target="_blank">Community</a></li>
                                        <li><a href="<?php echo site_url("home/api");?>" target="_self">API</a></li>
                                        <li><a href="<?php echo site_url("home/contact");?>" target="_self">Contact</a></li>
                                    </ul>
                                </li>			
                                <?php 
                                    if ($this->session->userdata('uid') != null ) {
                                ?>                                
                                                                <li class="login" >
									<div id="loginContainer"><a href="#" id="loginButton"><span>Account</span></a>
						                <div id="loginBox">     
                                                                    <ul id="accountForm">
                                                                        <li><a style="background: none; color: #000; border: none; box-shadow: none;" href="<?=  site_url("dashboard/index");?>">Dashboard</a></li>
                                                                        <li><a href="<?=  site_url("home/logout");?>" >Logout</a></li>
                                                                    </ul>
						                    
						                </div>
						               </div>
								   </li>
                                
                                <?php
                                    }  else {
                                ?>        
                                                                <li class="login" >
									<div id="loginContainer"><a href="#" id="loginButton"><span>Login</span></a>
						                <div id="loginBox">                
                                                                    <form id="loginForm" action="<?=  site_url("home/login_progress");?>" method="POST" >
						                        <fieldset id="body">
						                            <fieldset>
						                                <label for="email">Email Address</label>
						                                <input type="text" name="email" id="email">
						                            </fieldset>
						                            <fieldset>
						                                <label for="password">Password</label>
						                                <input type="password" name="password" id="password">
						                            </fieldset>
						                            <input type="submit" id="login" value="Sign in">
						                            <!--<label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember me</i></label>-->
						                        </fieldset>
                                                                        <span><a href="<?=  site_url('home/forgot');?>">Forgot your password?</a></span>
						                    </form>
						                </div>
						               </div>
								   </li>
                                
                                <?php        
                                    }
                                ?>
                               
								<div class="clear"></div>
							</ul>
						</div>							
	    		 <div class="clear"></div>
	        </div>
	    </div>
	 </div>	
					              	
									<!--details will be read from the database-->
					              	<div id="small-dialog" class="mfp-hide">
					                           	    <div class="plans_table">
  			 	
								  			 	<table width="100%" cellspacing="0" class="compare_plan">
												<thead>
								   					<tr>
								        				<th class="plans-list"><h3>Plan Features</h3></th>
								        				<th class="plans-list"><h3>Basic</h3></th>
								        				<th class="plans-list"><h3>Economy</h3></th>
								        				<th class="plans-list"><h3>Premium</h3></th>
								    				</tr>
												</thead>			
								   				<tbody>
								   					<tr>
									        			<td class="plan_list_title">Year(s)</td>
												        <td class="price_body">1</td>
												        <td class="price_body">5</td>
												        <td class="price_body">8</td>
									    			</tr>
								    				<tr>
								        				<td class="plan_list_title">Card Customization</td>
														<td class="price_body"><img src="{path}images/tickmark-icon.png" alt="img"></td>
										        		<td class="price_body"><img src="{path}images/tickmark-icon.png" alt="img"></td>
										        		<td class="price_body"><img src="{path}images/tickmark-icon.png" alt="img"></td>
								    				</tr>
                                                    <tr>
                                                        <td class="plan_list_title">Upgrade</td>
														<td class="price_body"><img src="{path}images/tickmark-icon.png" alt="img"></td>
										        		<td class="price_body"><img src="{path}images/tickmark-icon.png" alt="img"></td>
										        		<td class="price_body"><img src="{path}images/icon-remove.png" alt="img"></td>
                                                    </tr>
								    				<tr>
								        				<td class="plan_list_title">QR Code</td>
											    	    <td class="price_body"><img src="{path}images/tickmark-icon.png" alt="img"></td>
											        	<td class="price_body"><img src="{path}images/tickmark-icon.png" alt="img"></td>
											        	<td class="price_body"><img src="{path}images/tickmark-icon.png" alt="img"></td>
													</tr>
                                                    <tr>
								        				<td class="plan_list_title">Discount</td>
											    	    <td class="price_body">0%</td>
											        	<td class="price_body">10%</td>
											        	<td class="price_body">20%</td>
													</tr>
                                                    <tr>
								        				<td class="plan_list_title">Price</td>
											    	    <td class="price_body">RM 12000</td>
											        	<td class="price_body">RM 54000</td>
											        	<td class="price_body">RM 76800</td>
													</tr>
												</tbody></table>  			 	
  											 </div>
												</div>
											   <script>
													$(document).ready(function() {
														$('.popup-with-zoom-anim').magnificPopup({
															type: 'inline',
													
															fixedContentPos: false,
															fixedBgPos: true,
													
															overflowY: 'auto',
													
															closeBtnInside: true,
															preloader: false,
															
															midClick: true,
															removalDelay: 300,
															mainClass: 'my-mfp-zoom-in'
														});
																					
													});
													</script>
					              	