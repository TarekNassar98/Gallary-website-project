<?php 

session_start();
validate();



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="access.css">


</head>
<body>
    
     <div class="logo"><a href="login.php"><i class="far fa-image fa-5x"></i></a></div>
    <form action="" method="post">
    <div><?php
    
        echo getError();
    ?>
    </div>
    <h1>SIGN IN</h1>
        <input value="<?php if(isset($_COOKIE['uname'])) echo $_COOKIE['uname']; ?>" pattern="[A-Za-z0-9]{3,6}" title="username can contaim mumbers and letters only, and must be between (3-6) charachters" required  type="text" placeholder="username" name="user_name">
        <input value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>" }ly, and must be between (6-15) charachters" required placeholder="password" type="password" name="password">
        <button>Log In</button>
        <div >
        <a href="Forget.php">Forget Password ?</a>
        <label for="cookies">Remember Me<input id="cookies" type="checkbox" name="cookies" value="y"></label>
    </div>
    <h6>Do not have account ? <a href="signup.php">sign up here</a></h6>
    </form>
</body>
</html>




<script>
    
</script>


<?php


function validate(){
    
    $err=false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
    $servername = "sql102.epizy.com";
    $username = "epiz_31770710";
    $password = "7VAWScXAowKm";
    $db_name = "epiz_31770710_gallery";
        
        
        // Create connection
        $conn = new mysqli($servername, $username, $password,$db_name);
        
        // Check connection
        
        $userName = $_POST['user_name']; 
        $password = $_POST['password'];
        // query data.
        $stmt = $conn->prepare("select id from user where user_name=? and password=?");
        $stmt->bind_param("ss", $userName, $password);
        $stmt->execute();
        $content = $stmt->get_result();
        if($content->num_rows>0){
            $_SESSION['user_id'] = $content->fetch_array(MYSQLI_NUM)[0];

            header('location:index.php') ;
            
            if(isset($_POST['cookies'])){
                
            setcookie('uname', $userName,    time()+86400);
            setcookie('password', $password, time()+86400);
            
        }
         

        }
        else{
        $GLOBALS['err'] = true;
        }
        
        
        return "";
        
        // close connection
        $conn->close();
            }
         
}

function getError(){

if( isset($GLOBALS['err']) && $GLOBALS['err']==true)
    return  "<h1 style = color:red;>Invalid username or password !</h1>";

}
?>

<script>

    onload=function(){
       document.forms[0].style.transform="translate(0,1rem)";
    }

</script>






<?php



if($_SERVER['REQUEST_METHOD'] == 'GET')
{    // remove all session variables
session_unset();
// destroy the session
session_destroy();
}
?>