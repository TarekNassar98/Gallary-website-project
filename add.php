<?php 
 session_start();

$servername = "sql102.epizy.com";
$username = "epiz_31770710";
$password = "7VAWScXAowKm";
$db_name = "epiz_31770710_gallery";

$conn = new mysqli($servername, $username, $password,$db_name);

$stmt = $conn->prepare("INSERT INTO user_action (user_id,image_id ,is_fav) values (?,?, 1)");
$stmt->bind_param("ii",$_SESSION['user_id'],$_GET['imgid']);
$stmt->execute();

    

?>
