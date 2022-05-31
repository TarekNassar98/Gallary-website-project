<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="access.css">

    <style> 
    form{
        transform: translate(0,0); 

    }
    </style>
</head>
<body>
    

<?php 

    $servername = "sql102.epizy.com";
    $username = "epiz_31770710";
    $password = "7VAWScXAowKm";
    $db_name = "epiz_31770710_gallery";
// Create connection
$conn = new mysqli($servername, $username, $password,$db_name);



if($_SERVER['REQUEST_METHOD']=='GET')
{


    $stmt = $conn->prepare("select token from user where token=?");
    $stmt->bind_param("s", $_GET['token']);
    $stmt->execute();
    $res=$stmt->get_result();
    if($res->num_rows==0){
     header("location:login.php");
     exit();
    }

    else{ ?>
        <form action= "" method="POST">
    <h1>RESET PASSWORD</h1>
    <input type="hidden" name='token' value="<?php echo $_GET['token']?>">
    <input class="pass"  placeholder="password" type="password" name="password" pattern="[A-Za-z0-9]{6,15}" title="password can contain mumbers and letters only, and must be between (6-15) charachters" required>
    <h6  class="error"></h6>
    <input class="pass" placeholder="Re-Type password" type="password" pattern="[A-Za-z0-9]{6,15}" title="password can contain mumbers and letters only, and must be between (6-15) charachters" required>
    <button disabled >Save</button>
</form>
<?php 
    }
}


else{

    
    $stmt = $conn->prepare("update user set password=?  , token='' where token=? ");
    $stmt->bind_param("ss", $_POST['password'],$_POST['token']);
    

    if(!$stmt->execute()){
        ?>
        <div>error updating data</div>
    <?php
    }
    else{ ?>
    <div>data updated successfully!</div>
    <?php } 
}

?>

</body>
<script>


const passwordInputs = document.getElementsByClassName('pass');
        for(const inp of passwordInputs){
            inp.addEventListener('focusout', function (){
              
                if(passwordInputs[0].value.length>0 && passwordInputs[1].value.length>0){
                    if(passwordInputs[0].value!=passwordInputs[1].value){
                    off();
                    passwordInputs[1].previousElementSibling.innerHTML="password does not match";
                    }
                else{
                    passwordInputs[1].previousElementSibling.innerHTML="";
                on();
            }

        }
    else
        off();
            
        });
        }

    
        function off(){
        document.forms[0][3].setAttribute('disabled','');
        document.forms[0][3].style.cursor="not-allowed";
        document.forms[0][3].style.opacity="0.2";   


    }
    function on(){
                document.forms[0][3].removeAttribute('disabled');
                document.forms[0][3].style.cursor="pointer";
                document.forms[0][3].style.opacity="1";


            }

off();

</script>

</html>