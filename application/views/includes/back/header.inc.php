<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>P2U | Dashboard - {title}</title>
    
    <link href="{path}/back/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="shortcut icon" href="{path}/images/icon.ico" />
    
    <!-- Bootstrap Core CSS -->
    <link href="{path}/back/css/bootstrap.min.css" rel="stylesheet">
    
    <!--Self defined CSS-->
    <link href="{path}/back/css/style.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{path}/back/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{path}/back/css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{path}/back/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{path}/back/css/plugins/morris.css" rel="stylesheet">
    
    <!-- color picker -->
    <link href="{path}/back/css/colpick.css" rel="stylesheet">
    
    <link href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{path}/back/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="{path}/back/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!--Load constant-->
    <script src="{path}/back/js/constant.js"></script>
    
   <!-- jQuery -->
    <script src="{path}/back/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{path}/back/js/bootstrap.min.js"></script>
    
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{path}/back/js/plugins/metisMenu/metisMenu.min.js"></script>
    
    <script src="{path}/back/js/colpick.js"></script>
    
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    
    <script src="{path}/back/js/jquery-ui/jquery-ui.min.js"></script>
    
    <!-- validation plugin -->
    <script src="{path}plugins/validation-engine/js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
    <script src="{path}plugins/validation-engine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

    <link rel="stylesheet" href="{path}plugins/validation-engine/css/validationEngine.jquery.css" type="text/css"/>
    <!-- end of validation plugin--->

    
    <script src="{path}/back/js/glob_func.js"></script>
    
    
    
    <script src="{path}/back/js/plugins/scrollbar/jquery.mCustomScrollbar.js"></script>
    <link rel="stylesheet" type="text/css" href="{path}/back/js/plugins/scrollbar/jquery.mCustomScrollbar.css" />
    
    <script src="{path}/back/js/chat.js"></script>
    <link rel="stylesheet" type="text/css" href="{path}/back/css/chat.css" />
    
</head>

<body>

    
    <?php
    $role = $this->session->userdata('role');
    $uri = $this->uri->segment(1);
    if ($uri == false)
        $uri = 'dashboard';
    
    ?>
    
    <div id="wrapper">
        
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=  site_url('dashboard');?>">P2U Dashboard</a>
            </div>
            <!-- /.navbar-header -->
            
        <div class="error-msg"></div>
        <div class="success-msg"></div>
        
            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <?php if ($role == 'merchant') {?>
                        <li><a href="<?=  site_url('dashboard/userprofile');?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?=  site_url('dashboard/companyprofile');?>"><i class="fa fa-home fa-fw"></i> Company Profile</a>
                        </li>
                        <li class="divider"></li>
                        <?php }?>
                        <li><a href="<?=  site_url('home/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--
                        <li class="sidebar-search">
                            
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            
                        </li>-->
                        <li>
                            <a <?= (($uri == 'dashboard') ? ' class="active"' : ''); ?> href="<?=  site_url("dashboard");?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <?php if ($role == 'merchant') {?>
                        <li>
                            <a <?= (($uri == 'services') ? ' class="active"' : ''); ?> href="<?=  site_url('services');?>"><i class="fa fa-thumbs-up fa-fw"></i> P2U Services</a>
                        </li>
                        <li>
                            <a <?= (($uri == 'card') ? ' class="active"' : ''); ?> href="<?=  site_url('card');?>"><i class="fa fa-credit-card fa-fw"></i> Card</a>
                        </li>
                        <li>
                            <a <?= (($uri == 'products') ? ' class="active"' : ''); ?> href="<?=  site_url('products');?>"><i class="fa fa-gift fa-fw"></i> Products</a>
                        </li>
                        <li>
                            <a <?= (($uri == 'customers') ? ' class="active"' : ''); ?> href="<?=  site_url('customers');?>"><i class="fa fa-user"></i> Customers</a>
                        </li>
                        <li>
                            <a <?= (($uri == 'orders') ? ' class="active"' : ''); ?> href="<?=  site_url('orders');?>"><i class="fa fa-gift fa-shopping-cart"></i> Orders</a>
                        </li>
                        <li>
                            <a <?= (($uri == 'api') ? ' class="active"' : ''); ?> href="<?=  site_url('api');?>"><i class="fa fa-cog fa-fw"></i> API</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=  site_url('reports/subscriptions');?>">Subscription Report</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } else {
                        ?>
                            <li>
                                <a href="<?=  site_url('merchants');?>"><i class="fa fa-user fa-fw"></i> Merchants</a>
                            </li>
                            <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=  site_url('reports/merchant_subscriptions');?>">Merchant Subscriptions</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php
                        }?>
                        <!--for admin-->
                        
                        
                        
                        
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>