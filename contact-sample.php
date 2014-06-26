<?php
require 'PHPMailer/PHPMailerAutoload.php';

function spamcheck($field) {
    //filter_var() sanitizes the e-mail
    //address using FILTER_SANITIZE_EMAIL
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);

    //filter_var() validates the e-mail
    //address using FILTER_VALIDATE_EMAIL
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

if (isset($_POST['email'])) {//if "email" is filled out, proceed
    //check if the email address is invalid
    $mailcheck = spamcheck($_POST['email']);
    if ($mailcheck == FALSE) {
        header("location:index.htm?status=-1");
    } else {//send email
    
    
        $mail = new PHPMailer;
        
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup server
        $mail->Port = 587;
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'sample@gmail.com'; // SMTP username
        $mail->Password = 'samplePassword'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable encryption, 'ssl' also accepted
        
        $mail->AddReplyTo($_POST['email']);
        $mail->From = $_POST['email'];
        $mail->FromName = $_POST['name'];
        $mail->addAddress('forward@gmail.com'); //forwarding address
        
        $mail->isHTML(true);
        $mail->Subject = 'ContactUs Form - RoboGames Website : '.$_POST['subject'];
        $mail->Body = 'Name : '.$_POST['name'].'<br/>'.
                        'Email : '.$_POST['email'].'<br/>'.
                        'Phone : '.$_POST['phone'].'<br/><br/>'.
                        'Message : <br/>'.$_POST['message'].'<br/>'
        ;
        $mail->AltBody = 'Name : '.$_POST['name'].'   '.
                        'Email : '.$_POST['email'].'   '.
                        'Phone : '.$_POST['phone'].'    '.
                        'Message : '.$_POST['message'].'    '
        ;
        if(!$mail->send()) {
            header("location:index.htm?status=0");
        }

        header("location:index.htm?status=1");
    }
} else {//if "email" is not filled out, display the form 
    header("location:index.htm?status=-1");
}
?>