<?php
include 'maill/class.smtp.php';
include "maill/class.phpmailer.php";
class apps_libs_SendMaill
{
    private $user_maill;
    private $pass_maill;
    private $from_maill;
    function apps_libs_SendMaill($user_maill, $pass_maill, $from_maill)
    {
        $this->user_maill = $user_maill;
        $this->pass_maill = $pass_maill;
        $this->from_maill = $from_maill;
    }

    function SendMaill($user_re, $name_re, $title, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";
        $mail->SMTPDebug = 0;   // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true;    // enable SMTP authentication
        $mail->SMTPSecure = "ssl";   // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com";    // sever gui mail.
        $mail->Port = 465;         // cong gui mail de nguyen
    // xong phan cau hinh bat dau phan gui mail
        $mail->Username = $this->user_maill;  // khai bao dia chi email
        $mail->Password = $this->pass_maill;              // khai bao mat khau
        $mail->SetFrom($this->user_maill,$this->from_maill);
        $mail->AddReplyTo($this->user_maill, $this->from_maill); //khi nguoi dung phan hoi se duoc gui den email nay
        $mail->Subject = $title;// tieu de email 
        $mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
        $mail->AddAddress($user_re, $name_re);
    // thuc thi lenh gui mail 
        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }
}
?>