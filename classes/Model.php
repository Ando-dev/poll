<?php 
abstract class Model{
    
    protected $db;
    
    public function __construct(){
        $this->db = new DataBase("localhost", "root", "", "", "+4:00");
    }
    
    public function __call($name, $value){
        return false;
    } 


    public function getUser($user_id = ""){
        if(empty($user_id)){
            return false;
        }
        return $this->db->query("SELECT * FROM `user` WHERE `user_id`='$user_id'")->fetch_assoc();
    } 
 

    public function getPoll($user_id = "", $parent = "", $poll_id = ""){
        $where = "WHERE `poll_id` IS NOT NULL";
        if(!empty($user_id)){
            $where .= " AND `user_id`='$user_id'";
        }
        if(!empty($parent)){
            $where .= " AND `parent`='".(($parent=="top") ? 0 : $parent)."'";
        }
        if(!empty($poll_id)){
            $where .= " AND `poll_id`='$poll_id'";
        }
        $poll = $this->db->query("SELECT * FROM `poll` $where ORDER BY `sort` ASC, `poll_id` DESC");
        if(!empty($poll_id)){
            return $poll->fetch_assoc();
        }else{
            return $poll->fetch_all(MYSQLI_ASSOC);
        }
    }
    
    public function getPollRate($poll_id = ""){
        $poll_current = $this->getPoll("", "", $poll_id);
        $poll_parent = $this->getPoll("", $poll_current["parent"]);
        $poll_parent_sum = 0;
        foreach($poll_parent as $poll_parent){
            $poll_parent_sum += $poll_parent['rate'];
        }
        return round((float) $poll_current["rate"] * 100 / $poll_parent_sum);
    }


}