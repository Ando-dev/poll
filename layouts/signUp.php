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
                       <form action="?cmd=signUp" class="form-ajax sign" method="post">
                           <h1>Գրանցում</h1>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                                <input type="name" class="form-control" name="name" placeholder="Ձեր անունը" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                <input type="email" class="form-control" name="email" placeholder="Էլ․փոստ" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Գաղտնաբառ" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" name="password_rep" placeholder="Կրկնել գաղտնաբառը" required>
                            </div>
                            <div class="form-message"></div>
                            <div class="text-right">
                                <a href="/">Մուտք</a>
                                <button type="submit" class="btn btn-info">Գրանցվել</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>