<!doctype html>
<html lang="hy">
    <head>
        <?php require "inc/head.php";?>
        <title>Սոցիալական հարցում</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
    </head>
    <body>
       
        <?php require "inc/nav.php";?>

        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                       <form action="?cmd=signIn" class="form-ajax sign" method="post">
                            <h1>Մուտք</h1>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                <input type="email" class="form-control" name="email" placeholder="Էլ․փոստ" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Գաղտնաբառ" required>
                            </div>
                            <div class="form-message"></div>
                            <div class="text-right">
                                <a href="/signUp">Գրանցվել</a>
                                <button type="submit" class="btn btn-info">Մուտք</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>