<?php
$poll = $cnt->getPoll("", "", $url->PAGE);
if(!isset($poll["poll_id"]) || empty($poll["poll_id"])) exit;
?>
<table class="poll-item">
    <tr>
        <th><?=$poll["title"]?></th>
    </tr>
    <?php 
    $i=0;
    foreach($cnt->getPoll("", $poll["poll_id"]) as $poll_sub){
    $i++;
    ?>
    <tr>
        <td>
            <?php if(!isset($_SESSION['rate'])){?>
            <label><input type="radio" name="poll" onchange="location='?cmd=addRate&poll_id=<?=$poll_sub["poll_id"]?>'"> <?=$i?>) <?=$poll_sub["title"]?></label>
            <?php }else{?>
            <?=$i?>) <?=$poll_sub["title"]?> <span><?=$cnt->getPollRate($poll_sub["poll_id"])?>%</span>
            <?php }?>
            <div class="precent" style="width:<?=$cnt->getPollRate($poll_sub["poll_id"])?>%;"></div>
        </td>
    </tr>
    <?php }?>
</table>
<style>
    table.poll-item{
        width:100%;
    }
    table.poll-item tr{
    }
    table.poll-item tr th,
    table.poll-item tr td{
        text-align: left;
        position: relative;
        padding: 7px 15px;
    }
    table.poll-item tr td span{
        float:right;
        color:red;
    }
    table.poll-item tr td div.precent{
        position: absolute;
        bottom: 0;
        border:2px solid green;
    }
</style>