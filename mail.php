<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';



if($_SERVER['REQUEST_METHOD']=='POST'){


    $servername = "sql102.epizy.com";
    $username = "epiz_31770710";
    $password = "7VAWScXAowKm";
    $db_name = "epiz_31770710_gallery";
// Create connection
$conn = new mysqli($servername, $username, $password,$db_name);

$token = bin2hex(random_bytes(16));
$email=$_POST['email'];
$stmt = $conn->prepare("select id,user_name from user where email=? ");
$stmt->bind_param("s",$email);
$stmt->execute();
$res=$stmt->get_result();

if($res->num_rows>0){
$res=$res->fetch_array();
$id=$res[0];
$user_name=$res[1];
$stmt = $conn->prepare("UPDATE user SET token=? WHERE id=?");
$stmt->bind_param("si",$token,$id);
$stmt->execute();
}

else{
    echo "<div style='padding:10px 2px; border-radius:25px;border:1px solid black; background:LightGray

    ;'><p>your email is not registered , you can sign up <a href=signup.php>Here </a>.</p></div>";
    exit();
}



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$file_data = file('./secreet.txt');


try {//Administrator

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = false;                                   //Enable SMTP authentication
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $file_data[0];                     //SMTP username
    $mail->Password   = $file_data[1];   
    $mail->From = "Gallary@Gallery.com";
    //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SM
    //Recipients
    $mail->addAddress($email, '@Gallary');     //Add a recipient
    $mail->setFrom("Gallary@Gallery.com",'Gallery');
    


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Link !';
    $mail->Body    = "<h1>Hello $user_name ! ,</h1><br> here is the password reset link:<a href=http://tarek-nassar.freecluster.eu/reset.php?id=$id&token=$token> Click here</a> ";


    $mail->send();
    header('location:mailSend.php');


} catch (Exception $e) {
    echo "error: Message could not be sent, try refreshing the page. ";
}

}

else{
    http_response_code(503);

}