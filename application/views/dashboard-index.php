<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Welcome back </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li>Dashboard</li>
                        <li></li>
                      </ol>
                    <!--e breadcrumb-->
                    <div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-ok"></span>
                        Welcome to use P2U system, we glad to have you here.
                      </div>
                    
                    <?php
                    if ($role == 'merchant') {
                    
                        if ($user['company_code'] == '') {
                            echo '<div class="alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign"></span>
                                        Unfortunately, you need to verify your company details before purchase our product and use the system. Thanks.
                                        <br /><a href="'.  site_url('dashboard/companyprofile').'" class="alert-link">Click here to finish up the details for verification</a>. 
                                  </div>';
                        }
                       
                        if ($error != '') {
                            echo '<div class="alert alert-warning" role="alert">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                    '.$error.'
                                 </div>';
                        }
                        
                    } else {
                        // admin
                    }
                    
                    echo '<div style="background-color: #534960; padding: 20px; border-radius: 5px; color: #fff;">';
                        echo '<p>We are happy to have you here. P2U is an evolution of card that going to be popular in the future.</p>';
                        echo '<p>We support ECO , thats why P2U exist and help to reduce the materials that need to build the physical card holders.</p>';
                        echo '<p>We love simplicity, thats why we build P2U to simplify the transaction by a single app.</p>';
                        echo '<p>We love special offer, thats why card rewarded system is built inside the P2U.</p>';
                        echo '<p>We build this because of we like creative works and challenge evolution the world.</p>';
                        echo '</div>';
                    ?>
                    
                      
                    
                    
                    
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->