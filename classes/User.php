<?php 
class User extends Model{
    
    public $user;
    
    public function __construct(){
        parent::__construct();
        if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
            $this->user = $this->getUser($_SESSION['user_id']);
        }
    }

    public function logOut(){
        unset($_SESSION['user_id']);
    }
        
    public function signIn(){  
        if(empty($_POST['email']) || empty($_POST['password'])){
            echo json_encode([
                "message" => "<p class='error'>Լրացրեք բոլոր դաշտերը!</p>",
                "location" => false
            ]);
            return false;
        }  
        $user = $this->db->query("SELECT `user_id` FROM `user` WHERE `email`='".$_POST['email']."' AND `password`='".md5($_POST['password'])."'");
        if($user->num_rows == 1){
            $row = $user->fetch_assoc();
            $_SESSION['user_id'] = $row['user_id'];
            echo json_encode([
                "message" => 0,
                "location" => [
                    "href" => false,
                    "reload" => true
                ]
            ]);
            return false;
        }else{
            echo json_encode([
                "message" => "<p class='error'>Սխալ մոտքանուն կամ գաղտնաբառ!</p>",
                "location" => false
            ]);
            return false;
        }
    }
    
    public function signUp(){   
        if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_rep']) || empty($_POST['name'])){
            echo json_encode([
                "message" => "<p class='error'>Լրացրեք բոլոր դաշտերը!</p>",
                "location" => false
            ]);
            return false;
        }
        if(!preg_match("|[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}|i", $_POST['email'])){
            echo json_encode([
                "message" => "<p class='error'>Էլ.փոստը պատշաճ չէ!</p>",
                "location" => false
            ]);
            return false;
        }      
        $mail = $this->db->query("SELECT `user_id` FROM `user` WHERE `email`='".$_POST['email']."'");
        if($mail->num_rows > 0){
            echo json_encode([
                "message" => "<p class='error'>Էլ.փոստը զբաղված է!</p>",
                "location" => false
            ]);
            return false;
        }      
        if(!preg_match("/\A(\w){6,20}\Z/",$_POST['password'])){
            echo json_encode([
                "message" => "<p class='error'>Ծածկագիրը պետք է բաղկացած լինի 6-20 նիշերից!</p>",
                "location" => false
            ]);
            return false;
        }      
        if($_POST['password'] !== $_POST['password_rep']){
            echo json_encode([
                "message" => "<p class='error'>Ծածկագիրը չի համնկնում!</p>",
                "location" => false
            ]);
            return false;
        }
        $this->db->query("INSERT INTO `user`(`email`, `password`, `name`, `active`, `date`) VALUES ('".$_POST['email']."', '".md5($_POST['password'])."', '".$_POST['name']."', '0', NOW())");
        $user_id = $this->db->insert_id;    
        if(isset($user_id) && !empty($user_id) && $user_id !== NULL){
            $_SESSION['user_id'] = $user_id;
            $_SESSION["verified"] = rand(000000, 999999);
            sendMailSmtp($_POST['email'], $_POST['name'], "Հարգելի հաճախորդ Ձեր գրանցումը հաջողությամբ կատարվել է, հաստատեք Ձեր էլ․փոստը՝ <a href='http://poll.worknet.am/?cmd=emailVerified&code=".$_SESSION["verified"]."'>Հաստատել</a>։");
            echo json_encode([
                "message" => 0,
                "location" => [
                    "href" => "/#getVerified",
                    "reload" => false
                ]
            ]);
            return false;
        }else{
            echo json_encode([
                "message" => "<p class='error'>Համակարգային սխալ!</p>",
                "location" => false
            ]);
            return false;
        }
    }
    
    public function emailVerified(){
        if(!isset($this->user['user_id']) || empty($this->user['user_id'])){
            return false;
        }
        if(!isset($_GET['code']) || empty($_GET['code'])){
            return false;
        }
        if(!isset($_SESSION['verified']) || empty($_SESSION['verified'])){
            return false;
        }
        if($_GET['code'] != $_SESSION["verified"]){
            return false;
        }
        $this->db->query("UPDATE `user` SET `active`='1' WHERE `user_id`='".$this->user['user_id']."'");     
        header("Location: /#getActive");
        exit;
    }
    
    public function changeUser(){
        if(!isset($this->user['user_id']) || empty($this->user['user_id'])){
            echo json_encode([
                "message" => 0,
                "location" => [
                    "href" => "signIn",
                    "reload" => false
                ]
            ]);
            return false;
        }    
        if(!empty($_POST['password']) && !preg_match("/\A(\w){6,20}\Z/",$_POST['password'])){
            echo json_encode([
                "message" => "<p class='error'>Ծածկագիրը պետք է բաղկացած լինի 6-20 նիշերից!</p>",
                "location" => false
            ]);
            return false;
        }
        if(!empty($_POST['password']) && $_POST['password'] !== $_POST['password_rep']){
            echo json_encode([
                "message" => "<p class='error'>Ծածկագիրը չի համնկնում!</p>",
                "location" => false
            ]);
            return false;
        }
        if(!empty($_POST['name'])){
            $this->db->query("UPDATE `user` SET `name`='".$_POST['name']."' WHERE `user_id`='".$this->user['user_id']."'");
        }
        if(!empty($_POST['password'])){
            $this->db->query("UPDATE `user` SET `password`='".md5($_POST['password'])."' WHERE `user_id`='".$this->user['user_id']."'");
        }
        echo json_encode([
            "message" => 0,
            "location" => [
                "href" => false,
                "reload" => true
            ]
        ]);
        return false;
    }
    
    public function sortablePoll(){
        if(!isset($this->user['user_id']) || empty($this->user['user_id'])){
            return false;
        }
        $this->db->query("UPDATE `poll` SET `sort`='".$_POST['sort']."' WHERE `poll_id`='".$_POST['poll_id']."'");
    } 
    
    public function addPoll(){
        if(!isset($this->user['user_id']) || empty($this->user['user_id'])){
            return false;
        }
        if($this->user['active']==0){
            echo json_encode([
                "message" => 0,
                "location" => [
                    "href" => "#getVerified",
                    "reload" => false
                ]
            ]);
            return false;
        }
        if(empty($_POST['title'])){
            return false;
        }
        $this->db->query("INSERT INTO `poll`(`user_id`, `parent`, `title`, `sort`)VALUES('".$this->user["user_id"]."', '".$_POST['parent']."', '".$_POST['title']."', '0')");
        echo json_encode([
            "message" => 0,
            "location" => [
                "href" => false,
                "reload" => true
            ]
        ]);
        return false;
    } 
    
    public function editPoll(){
        if(!isset($this->user['user_id']) || empty($this->user['user_id'])){
            return false;
        }
        if(!isset($_POST['poll_id']) || empty($_POST['poll_id'])){
            return false;
        }
        if(empty($_POST['title'])){
            return false;
        }
        $poll_id = (int) $_POST['poll_id'];
        $this->db->query("UPDATE `poll` SET `title`='".$_POST['title']."' WHERE `poll_id`='$poll_id'");
    }
    
    public function removePoll(){
        if(!isset($this->user['user_id']) || empty($this->user['user_id'])){
            return false;
        }
        $poll = $this->getPoll("", "", $_GET['poll_id']);
        if(!isset($poll["user_id"]) || $poll["user_id"] != $this->user["user_id"]){
            return false;
        }
        $this->db->query("DELETE FROM `poll` WHERE `poll_id`='".$poll['poll_id']."' OR `parent`='".$poll['poll_id']."'");
    } 
    
    public function addRate(){
        if(!isset($_GET['poll_id']) || empty($_GET['poll_id'])){
            return false;
        }
        if(isset($_SESSION['rate'])){
            return false;
        }
        $poll_id = (int) $_GET['poll_id'];
        $this->db->query("UPDATE `poll` SET `rate`=`rate`+1 WHERE `poll_id`='$poll_id'");
        $_SESSION['rate'] = "ok";
    }


}