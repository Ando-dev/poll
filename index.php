<?php
session_start();
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
ini_set( 'date.timezone', 'Asia/Yerevan' );
mb_internal_encoding("UTF-8");
mb_regex_encoding("UTF-8");

require "function/main.php";

if(!empty($_POST)){
    $_POST = checkVariable($_POST);
}

spl_autoload_register(function ($name){
    if(is_file("classes/$name.php")){
        require "classes/$name.php";
    }elseif(is_file("drivers/$name.php")){
        require "drivers/$name.php"; 
    }else{
        exit("Error loading: $name");
    }
});

$url = new Url();

if(is_dir("layouts/".$url->PATH) && !is_file("layouts/".$url->PATH.".php") && !empty($url->PAGE)){
    header("Location: /".$url->PATH."/");
    exit();
}

$cnt = new User();

if(isset($url->GET['cmd'])){
    $cnt->{$url->GET['cmd']}();
    if($url->type=='ajax'){
        exit();
    }else{
        header("Location: /".$url->PATH."".urldecode($url->GET['backUrl'])."");
        exit();
    }
}

if(!is_file("layouts/".$url->PATH.".php")){
    if(!empty($url->DIRS) && is_file("layouts/".$url->DIRS."default.php")){
        $url->PATH = $url->DIRS."default";
    }else{
        if(!empty($url->PATH)){
            header("HTTP/1.0 404 Not Found");
        }
        $url->DIRS = "";
        $url->PATH = "default";
    }
}

if(isset($url->DIR[0]) && $url->DIR[0]=="user" && empty($cnt->user["user_id"])){
    $url->DIRS = "";
    $url->PATH = "default";
}
if(($url->PATH=="default" || $url->PATH=="signUp") && !empty($cnt->user["user_id"])){
    $url->DIRS = "user/";
    $url->PATH = "user/default";
}

require "layouts/".$url->PATH.".php";

?>