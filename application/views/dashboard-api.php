
<script type="text/javascript" src="{path}back/js/plugins/syntaxhighlighter/shCore.js"></script>
<script type="text/javascript" src="{path}back/js/plugins/syntaxhighlighter/shBrushPhp.js"></script>
<link type="text/css" rel="stylesheet" href="{path}back/js/plugins/syntaxhighlighter/shCore.css" />
<link type="text/css" rel="stylesheet" href="{path}back/js/plugins/syntaxhighlighter/shThemeDefault.css" />

<style>
    .accordion-group {
        border: 1px solid #ddd;
        margin-bottom: 5px;
        border-radius: 3px;
    }
    
    .accordion-heading {
        background-color: #ececec;
        padding: 5px;
        border-bottom: 1px solid #ddd;
    }
    
    .accordion-body {
        padding: 10px;
    }
</style>

        <div id="page-wrapper">
            <div class="row">
                
                <div class="col-lg-12">
                    
                    <h1 class="page-header">API Configuration</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li>API</li>
                      </ol>
                    <!--e breadcrumb-->
                   
                    <div class="col-lg-8">
                        <div class="accordion" id="accordion2">
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                  Download and install
                                </a>
                              </div>
                              <div id="collapseOne" class="accordion-body collapse in">
                                <div class="accordion-inner">
                                    <p>
                                  Users can go ahead and click the download button right beside here to download the latest RESTful API provided by P2U.
                                    </p>
                                    <p>User can simply put the downloaded files into the plugins folder of the project that working on.</p>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                  Start to use API
                                </a>
                              </div>
                              <div id="collapseTwo" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <p>
                                        To use the API, user only need to include a file called "P2U.php" and all will be done.
                                        

                                    </p>
                                    <p>After included the file, the user can start create the object from it.</p>
<pre class="brush: php">
require_once 'P2U.php';

$p2u = new P2U;
</pre>                                  
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                                  Setting up account informations
                                </a>
                              </div>
                              <div id="collapseThree" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <p>
                                        This is important for user to start establish the connection. 
                                    </p>
                                    <p>User need to go in core folder and open the settings.php</p>
                                    <p>core->settings.php (Inside the file we will see some code)</p>
<pre class="brush: php">
if (!defined("EMAIL"))
	define("EMAIL", "Enter your email here");

if (!defined("PASSWORD"))
	define("PASSWORD", "Enter your password here");

// Important: Do not change the value of URL
if (!defined("URL"))
	define("URL", "http://localhost/p2u/api/");
</pre>                                
                                    <p>Now what you need to do is simply change the value of email and password that relevant to the P2U website login information.
                                        <br />
                                    </p>
                                    <p class='alert alert-warning' role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Important to not change the value of URL, it could lead to failure</p>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                                  Establish connection
                                </a>
                              </div>
                              <div id="collapseFour" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <p>
                                        User can go ahead and call the function from the object, the user will connect to the P2U.
                                    </p>
<pre class="brush: php">
$p2u->establish();
</pre> 
                                    <p>After that, the user can start using the function of generate points already.</p>
                                    <p>Simply call a function and pass in the amount of payment, P2U will auto calculate the points should rewarded to the customer.</p>
<pre class="brush: php">
$p2u->generate(200.00);
</pre> 
                                    <p>200.0 is amount of payment that can be replace with variable later.</p>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                                  Records down ID of points
                                </a>
                              </div>
                              <div id="collapseFive" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <p>
                                        Here the important to make sure customer can review back their QR code later. 
                                    </p>
                                    <p>We highly recommend that user to store the points id return from P2U into their own database table (Order table) for future use.</p>
                                    <p>User can get the points id by a single line of code.</p>
<pre class="brush: php">
// datatype = int
$p2u->get_points_id();
</pre>                                     
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSix">
                                  Display QRcode to customer
                                </a>
                              </div>
                              <div id="collapseSix" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <p>
                                        Here come to the last time to get the display of QR code.
                                    </p>
                                    <p>User can simply echo it out using php or put it in html image tag.</p>
<pre class="brush: php">
$p2u->QRCODE();
</pre>                                    
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSeven">
                                  Recall QRcode to customer
                                </a>
                              </div>
                              <div id="collapseSeven" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <p>
                                        For future use, user doesn't need to do all the establishment of account anymore. 
                                    </p>
                                    <p>User can straight away request the data from P2U again by passing the points id to it.</p>
                                    <p>Simply repeat these steps will do</p>
<pre class="brush: php">
require_once 'P2U.php';

$p2u = new P2U;
// $points_id should get from the user's database table not from P2U.
$p2u->set_points_id($points_id);
$p2u->QRCODE();
</pre>  
                                </div>
                              </div>
                            </div>
                          </div>
                        <br />                        <br />
                        <br />
                        <br />

                    </div>
                    
                    <div class="col-lg-4" style="border: 1px solid #ddd; padding: 5%;">
                        <h3>Start setup</h3>
                        Version 0.2 <br />
                        - Fixed some bugs
						- Display expired or redeemed image
						- Validate minimum purchase
                        <div align='center'>
                            <a href="{path}P2U_API.zip" target="_blank">
                        <button type="button" class="btn btn-success">
                                        <span class="glyphicon glyphicon-arrow-down"></span> Download
                                      </button>
                                </a>
                        </div>
                    </div>
                        
                   
            <!-- /.row -->

        </div>

<script type="text/javascript">
     SyntaxHighlighter.all()
</script>