<?php 

session_start();


    $servername = "sql102.epizy.com";
    $username = "epiz_31770710";
    $password = "7VAWScXAowKm";
    $db_name = "epiz_31770710_gallery";

$conn = new mysqli($servername, $username, $password,$db_name);

$inc=$_GET['inc'];
if(isset($_GET['q'])){ 
    $stmt =$conn->prepare("select name, id , src from image where name like CONCAT('%',?,'%')");
    $stmt->bind_param("s",$_GET['q']);
    $stmt->execute();
    $content = $stmt->get_result();
}

else if(isset($_GET['page'])&& $_GET['page']=='fav'){
    $stmt = $conn->prepare("select name, id , src from image  join user_action on image.id = user_action.image_id where user_id=?");
    $stmt->bind_param("i",$_SESSION['user_id']);
    $stmt->execute();
    $content = $stmt->get_result();

}


else{
$stm = "select name, id , src from image ;";
$content = $conn->query($stm);
}

$cols = (($val=($content->num_rows-$inc))<6)? $val : 6;

if(!mysqli_data_seek($content,$inc))
{
   
    http_response_code(201);    
}       


?>

 
<?php 
    if($_GET['page']=='home'|| $_GET['page']=='search')
        for($j=0;$j<6&& $j<= $cols;$j++)
        while($vals = $content->fetch_array()){ ?>
        <div class="container">
        <a   href="#"><img src="images/<?php echo $vals[2] ?>" alt="" srcset=""></a>
        <h3 style="text-align:center;"><?php echo $vals[0] ?></h3>

        <div id="option">
        <a href="images/<?php echo $vals[2] ?>" name ="download" download="image" value="<?php echo $vals[1];?>"><i class="fa-solid fa-arrow-down fa-2x"></i></a>
        <button name ="fav" value="<?php echo $vals[1];?>"><i class="fa-solid fa-heart fa-2x"></i></button>    
        </div>
    </div>
        
    <?php break; } 


    else
    for($j=0;$j<6&& $j<= $cols;$j++)
    while($vals = $content->fetch_array()){ ?>
           <div class="container" >
           <a   href="#"><img src="images/<?php echo $vals[2] ?>" alt="" srcset=""></a>
        <h3 class="name"><?php echo $vals[0] ?></h3>
        <button class="del" id="<?php echo $vals[1]; ?>"><i class="fa-solid fa-trash fa-2x"></i></button>
    </div>
    
<?php break; } 
    
    ?>
      