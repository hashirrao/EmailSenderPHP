<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$senderemail = $_POST["senderemail"];
$senderpassword = $_POST["senderpassword"];
$subject = $_POST["subject"];
$maintext = $_POST["maintext"];
$reciepentemail = $_POST["reciepentemail"];
$attachmentaddress = $_POST["attachmentaddress"];

$email = $reciepentemail;

  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'ssl';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 465;
  $mail->isHTML();
  $mail->Username = $senderemail;
  $mail->Password = $senderpassword;
  $mail->SetFrom($email);
  $mail->Subject = $subject;
  $mail->Body = $maintext;
  $mail->AddAddress($email);

  $attachment  = explode(",", $attachmentaddress);
  foreach($attachment as $value){
    $path = "../../uploads/$value";
    $mail->AddAttachment($path); 
  }

  if($mail->Send())
  {
    //echo "Email sent to: ".$email."\n";
    echo "<tr>Email sent to: ".$email."</tr>";
  }
  else
  {
    echo "Error in sending ".$email."\nError Message is: $mail->ErrorInfo \n";
  } 
?>