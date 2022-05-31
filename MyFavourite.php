<?php

session_start();


if (!isset($_SESSION['user_id'])){
    header('location:Login.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourite</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">

<style>

*{
    margin:0;
    padding: 0;
    box-sizing:border-box;
}


.container{
  
    transition: transform 4s;
    margin-top:2%;
    display:block;
    margin-left:auto;
    margin-right:auto;
}


.row{
    text-align:center;
}



.container button{

  cursor: pointer;
  width:100%;
  color:red;
}
.trans{
  
    transform: translate(0,-100rem); 

}
.remove{
    display: none;
}


    
</style>
</head>
<body>

    <?php include('nav.php'); ?>

 <!--  content -->
<div class = "row" ></div>

<button style="  border:0 ; cursor:pointer; color:rgba(60,20,25,0.3); border-radius:50%; display:block;  margin:0 50%"  class="loading" ><i class="fa-solid fa-circle-arrow-down fa-3x"></i></button>

<h1 id='state'>No More Data To Show!</h1>

<div class="modal">
        <img src="" alt="" >
        <button class="close"><i class="fa-solid fa-xmark fa-3x"></i></button>
    </div>

       


</div>
</body>    




    <!-- request.js -->
<script src="./request.js"></script>
<script src="./Modal.js"></script>

    <!-- Modal behave -->






</html>