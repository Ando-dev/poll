<!doctype html>
<html lang="hy">
    <head>
        <?php require "layouts/inc/head.php";?>
        <title>Սոցիալական հարցում</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
    </head>
    <body>
       
        <?php require "layouts/inc/nav.php";?>
        
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-3">
                        <?php require "inc/sidebar.php";?>
                    </div>
                    <div class="col-sm-8 col-md-8 col-lg-6">
                       <form action="?cmd=changeUser" class="form-ajax user" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="name" value="<?php echo $cnt->user['name']?>" placeholder="Ձեր անունը" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                        <input type="text" class="form-control" name="email" value="<?php echo $cnt->user['email']?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" class="form-control" name="password" value="" placeholder="Գախտնաբառ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" class="form-control" name="password_rep" value="" placeholder="Կրկնել գաղտնաբառը">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-message"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-info">Պահպանել</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>