<?php
function sendMailSmtp($to = "", $subject = "", $message = "", $file = ""){ 
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.mail.ru";
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = "";
    $mail->Password = "";
    $mail->FromName = "";
    $mail->From = "";
    $mail->AddAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $message;
    if(!empty($file)){
        if(isset($file['tmp_name'])){
            $mail->AddAttachment($file['tmp_name'], $file['name']);
        }else{
            $mail->AddStringAttachment($file["body"], $file["name"], 'base64', 'application/octet-stream');
        }
    }
    $mail->WordWrap = 50;
    $mail->ContentType = 'text/html';
    $mail->CharSet="UTF-8";
    $mail->Send(); 
}


function checkVariable($value){
    if(is_array($value)){
        return array_map(function($item) {
            return checkVariable($item);
        }, $value);
    }else{
        $item = addslashes($value);
        $item = trim($item);
        $item = htmlspecialchars($item);
        $item = preg_replace("/[\n\r]{3,}/","\r\r", $item);
        return $item;
    }
}
?>