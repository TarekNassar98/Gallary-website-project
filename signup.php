<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="access.css">



</head>
<body>
  
     <div class="logo"><a href="login.php"><i class="far fa-image fa-5x"></i></a></div>
    
     <?php 
     
     


     if($_SERVER['REQUEST_METHOD']=='GET'){ ?>
     <form action= "" method="POST">
        <h1>SIGN UP</h1>
        <h6 class="error"></h6>
        <input class="empty dbTest"  type="text" placeholder="username" pattern="[A-Za-z0-9]{3,6}" title="username can contaim mumbers and letters only, and must be between (3-6) charachters" required name="user_name">
        <h6 class="error"></h6>
        <input class="empty dbTest"  type="email" placeholder="email" name="email" required>
        <input class="pass"  placeholder="password" type="password" name="password" pattern="[A-Za-z0-9]{6,15}" title="password can contain mumbers and letters only, and must be between (6-15) charachters" required>
        <h6 class="error"></h6>
        <input class="pass" placeholder="Re-Type password" type="password" pattern="[A-Za-z0-9]{6,15}" title="password can contain mumbers and letters only, and must be between (6-15) charachters" required>
        <button disabled  >Sign Up</button>
    
    <h6>Already have an account ? <a href="login.php">Log In here</a></h6>
    </form>
    <?php
     }



     else{ 


    $servername = "sql102.epizy.com";
    $username = "epiz_31770710";
    $password = "7VAWScXAowKm";
    $db_name = "epiz_31770710_gallery";

// Create connection
$conn = new mysqli($servername, $username, $password,$db_name);

$stmt = $conn->prepare("insert into user (user_name,email,password)values(?,?,?)");
     
$stmt->bind_param("sss", $_POST['user_name'],$_POST['email'],$_POST['password']);



if(!$stmt->execute()){ ?>
    
    <div class = "error">
         <p>Error, failed creating your account!</p>
     </div>

<?php 
}

   else{
         ?> 
     <div class = "succ">
         <p>Congrats ! account created successfully!</p>
         <span>Go to <a href="login.php">Login Page</a></span>
     </div>
<?php } 
}
?>


</body>
</html>






<script>

    onload=function(){
        
        let testArr=[1,1,1];
        if(document.forms[0]!=null){
       document.forms[0].style.transform="translate(0,1rem)";
        off();
        }
    

        const dbInputs = document.getElementsByClassName('dbTest');
        for(let i=0;i<dbInputs.length;i++ ){
            dbInputs[i].addEventListener('focusout', function (){
            const xhttp=new XMLHttpRequest();
            xhttp.open("POST", "validation.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(`inputName=${this.name}&value=${this.value}`);

            xhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                
                const res = xhttp.responseText.trim();
                dbInputs[i].previousElementSibling.innerHTML=res;
              
                if(res.length>0||dbInputs[i].value.length==0){
                testArr[i]=1;
            }
                else{
                testArr[i]=0;
            }

            if(testArr.includes(1))
                off();
            else
                on();


                } // end if

            } // onreadystate function end

        
        }); // focusout function end

    } // for loop end

    const passwordInputs = document.getElementsByClassName('pass');
        for(let i=0; i<passwordInputs.length;i++){
            passwordInputs[i].addEventListener('focusout', function (){

                passField_1=passwordInputs[0].value;
                passField_2=passwordInputs[1].value;
               
         
                if(passField_1.length>0&&passField_2.length>0){
                if(passField_1!=passField_2)
                {
                
                testArr[2]=1;
                passwordInputs[1].previousElementSibling.innerHTML='password does not match';
                }

                else{
        
                passwordInputs[1].previousElementSibling.innerHTML='';            
                testArr[2]=0;
                
            } 
            }
              
            else{
                testArr[2]=1;

            }


                    if(testArr.includes(1))
                        off();
                    else
                        on();


            })
        }


}//onload end 
    

    
    function off(){
        document.forms[0][4].setAttribute('disabled','');
        document.forms[0][4].style.cursor="not-allowed";
        document.forms[0][4].style.opacity="0.2";   
    }
    function on(){
                document.forms[0][4].removeAttribute('disabled');
                document.forms[0][4].style.cursor="pointer";
                document.forms[0][4].style.opacity="1";
    }
    

if ( window.history.replaceState ){
window.history.replaceState(null,null,window.location.href);
}


</script>
