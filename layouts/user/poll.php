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
                    <div class="col-sm-8 col-md-8 col-lg-6 poll">
                        <form action="?cmd=addPoll" class="form-ajax user" method="post">
                            <div class="input-group">
                                <input type="hidden" name="parent" value="0">
                                <input type="text" class="form-control" name="title" placeholder="Ստեղծել հարցում" required>
                                <span class="input-group-addon"><button><i class="fa fa-plus"></i></button></span>
                            </div>
                        </form>
                        <ul>
                            <?php foreach($cnt->getPoll($cnt->user["user_id"], "top") as $poll){?>
                            <li>             
                                <form action="?cmd=editPoll" class="form-ajax user" method="post">
                                    <div class="input-group">
                                        <input type="hidden" name="poll_id" value="<?php echo $poll["poll_id"]?>">
                                        <span class="input-group-addon">
                                            <a href="#getPoll?poll_id=<?php echo $poll["poll_id"]?>"><i class="fa fa-code"></i></a>
                                        </span>
                                        <input type="text" class="form-control" name="title" placeholder="Հարցման անվանում" value="<?php echo $poll["title"]?>" required>
                                        <span class="input-group-addon">
                                            <a href="?cmd=removePoll&poll_id=<?php echo $poll["poll_id"]?>"><i class="fa fa-trash-o"></i></a>
                                        </span>
                                    </div>
                                </form>
                                <ul>
                                    <?php foreach($cnt->getPoll($cnt->user["user_id"], $poll["poll_id"]) as $poll_sub){?>
                                    <li class="sortable" data-id="<?php echo $poll_sub['poll_id']?>">
                                        <form action="?cmd=editPoll" class="form-ajax user" method="post">
                                            <div class="input-group">
                                                <input type="hidden" name="poll_id" value="<?php echo $poll_sub["poll_id"]?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-arrows-alt"></i>
                                                </span>       
                                                <input type="text" class="form-control" name="title" placeholder="Հարցաշար" value="<?php echo $poll_sub["title"]?>" required>
                                                <span class="input-group-addon">
                                                    <a href="?cmd=removePoll&poll_id=<?php echo $poll_sub["poll_id"]?>"><i class="fa fa-trash-o"></i></a>
                                                </span>
                                            </div>
                                        </form>               
                                    </li>
                                    <?php }?>
                                    <li>
                                        <form action="?cmd=addPoll" class="form-ajax user" method="post">
                                            <div class="input-group">
                                                <input type="hidden" name="parent" value="<?php echo $poll["poll_id"]?>">
                                                <input type="text" class="form-control" name="title" placeholder="Ավելացնել հարցաշար" required>
                                                <span class="input-group-addon"><button><i class="fa fa-plus"></i></button></span>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>