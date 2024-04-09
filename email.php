<?php

require_once('PHPMailer/PHPMailerAutoload.php');

function sendEmail($code, $email)
{
    // Define SMTP settings
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure ='ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();

    // Supply login credentials - These are actual credentials for a real account please use responsibly
    $mail->Username = 'courseworkuni1@gmail.com';
    $mail->Password = 'University1';

    // Define email contents
    $mail->setFrom('no-reply@sms.com', 'no-reply@sms.co.uk');
    $mail->Subject = 'Your One Time Login Code!';
    $mail->Body = 'Please enter the follwoing code in to the box and click verify to login! <br>' . $code;
    $mail->addAddress($email);

    if(!$mail->send()) 
    {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

?>