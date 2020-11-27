<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>P2U | Evolution of Card - Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="{path}/back/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{path}/back/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{path}/back/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{path}/back/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div style="text-align: center; margin-top: 50px;">
                    <img src="{path}/images/logo.jpg" height="50" width="100" />
                </div>
                <div class="login-panel panel panel-default" style="margin-top: 50px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        
                        <form role="form" method="post" action="<?=  site_url('home/login_progress');?>" >
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" />
                                
                            </fieldset>
                        </form>
                        <div class="col-md-4" style="margin-top:10px;padding-left: 0px;" >
                            <a class="btn btn-default btn-info btn-block" href="<?=  site_url('home');?>" ><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back</a>
                        </div>
                        <div class="col-md-8" style="margin-top:10px;padding-left: 0px; text-align: right;" >
                            <a href="<?=  site_url('home/forgot');?>">Forgot password?</a>
                        </div>
                    </div>
                    
                </div>
                
                
                <?php
                    if ($error != null) {
                ?>
                <div class="alert alert-danger" role="alert">
                     <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <?=$error;?>
                </div>
                <?php
                    }
                ?>
                
                <?php
                    if ($recover != null) {
                ?>
                <div class="alert alert-success" role="alert">
                     <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <?=$recover;?>
                </div>
                <?php
                    }
                ?>
                
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{path}/back/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{path}/back/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{path}/back/js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{path}/back/js/sb-admin-2.js"></script>

</body>

</html>
