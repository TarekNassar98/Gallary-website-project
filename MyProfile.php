<?php 

session_start();


if (!isset($_SESSION['user_id'])){
    header('location:Login.php');
}



    $servername = "sql102.epizy.com";
    $username = "epiz_31770710";
    $password = "7VAWScXAowKm";
    $db_name = "epiz_31770710_gallery";


$conn = new mysqli($servername, $username, $password,$db_name);
$q = "select id , email,user_name from user where id=$_SESSION[user_id]";
$result = $conn->query($q);
$userName='';
$email='';
while($val=$result->fetch_array()){
$userName = $val[2];
$email = $val[1];

}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $userName =$_POST['uname'];
    $email = $_POST['email'];

$stmt = $conn->prepare("UPDATE  user set user_name = ? , email = ? where id=$_SESSION[user_id]");
// set parameters .


// echo $stmt;
$stmt->bind_param("ss" , $userName , $email);


$err=$stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

h1{
                margin-left:5px;
                color:white;
                padding:10px;
                background:rgba(12,5,0,0.7);
                float:left;
                border-radius:12px;                
            }


        #info {
     
           text-align:center;
           margin-top:10px;
           clear:both;
        }
        
        table{
            width:60%;
            margin-top:110px;
            border-radius:16px;
            background:rgba(40,20,30,0.2);
        }


        td{
            padding:0;
           padding:10px 5px;
        }

        tr{
            border-collapse: collapse;
          
        }
        #info input{
            padding:10px;
            border-radius:12px;
        }

   


 #info #submit{
     background:rgba(0,0,220,0.8);
     color:white;
     border-radius:50px;
     padding: 15px 60px;

   
 }

 #info td button{
    border:0;
     cursor:pointer;
     background:none;
 }


    </style>



</head>


<body>

<?php include('nav.php'); 
?>
   
 
   <h1>Personal Informaation</h1>

    <form action="" method="POST" id="info">
    <?php 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if($err){
    ?>    
    <div style="background: rgb(110,110,14); margin-top:120px; padding:20px; font-size:1.3rem;">data saved successfully!</div>
<?php } else{ ?> 
    <div style="background: rgb(255,0,0); margin-top:120px; padding:20px; font-size:1.3rem;">error updating data!, User Name or Email already taken </div>


    <?php }} ?>
    <table>
        <tr>
        <td> User Name </td> 
        <td> <input   type="text" required value="<?php echo $userName ?>"  name="uname" value = <?php echo $userName; ?> readonly pattern="[A-Za-z0-9]{3,6}" title="username can contaim mumbers and letters only, and must be between (3-6) charachters" ></td>
        <td><button type="button" class="edit"> Edit <i class="fa-solid fa-pen fa-1x"></i></button></td>
    </tr>
        <tr>
        <td> Email </td> 
        <td> <input  type="email" name="email" value = <?php echo $email; ?> readonly required title="Enter a valid Email Address"></td>
        <td><button class="edit" type="button"> Edit <i class="fa-solid fa-pen fa-1x"></i></button></td>
    </tr>

    <tr>
        <td> <button id="submit"> Save </button> </td>
    </tr>
    </table>
    </form>



</body>
</html>

<script>

 const editButtons = document.getElementsByClassName('edit');
 for(let edit of editButtons )
{
    edit.onclick=function(){
        edit.parentElement.previousElementSibling.firstElementChild.removeAttribute('readonly');

    }

    
}
</script>

