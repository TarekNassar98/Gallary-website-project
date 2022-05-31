

    <?php

    


    
if($_SERVER['REQUEST_METHOD']=='POST'){
        
    $servername = "sql102.epizy.com";
    $username = "epiz_31770710";
    $password = "7VAWScXAowKm";
    $db_name = "epiz_31770710_gallery";

// Create connection
$conn = new mysqli($servername, $username, $password,$db_name);
$stmt = $conn->prepare("select user_name from user where email=? ");
     
$stmt->bind_param("s",$_POST['email']);

$stmt->execute();

if($stmt->get_result()->num_rows > 0)

send_Email($_POST['email']);
header_remove();
?>
  
<div> <p> if this email is registered you will recive a reset password link , check your inbox/spam folder. Go back to <a href="Login.php">Login page</a></p>



  

<?php 
 
}


 
 else{ ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link rel="stylesheet" href="access.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <style>

        form{
            transform:initial;
        }

        </style>
</head>
<body>
<div class="logo"><a href="login.php"><i class="far fa-image fa-5x"></i></a></div>

<form action= "mail.php" method="POST">
        <i class="fa-solid fa-unlock fa-2x"></i>
        <h1>Reset Password</h1>
        <h6 class="error"></h6>
        <input class="empty"  type="email" placeholder="Type your email" name="email" required>
        <button>Next</button>
    </form>
<?php }?>


<script>
if ( window.history.replaceState ){
window.history.replaceState(null,null,window.location.href);
}

</script>

</body>
</html>

