<?php

    $servername = "sql102.epizy.com";
    $username = "epiz_31770710";
    $password = "7VAWScXAowKm";
    $db_name = "epiz_31770710_gallery";

// Create connection
$conn = new mysqli($servername, $username, $password,$db_name);






$str_value='';
if($_POST['inputName']=='user_name'){
$stmt = $conn->prepare("select user_name from user where user_name = ?");
$stmt->bind_param("s",$_POST['value']);
$str_value='username';
}
else if($_POST['inputName']=='email'){

$stmt = $conn->prepare("select email from user where email = ?");
$stmt->bind_param("s",$_POST['value']);
$str_value='email';
}

$stmt->execute();
$res = $stmt->get_result();
if( $res->num_rows>0){
    echo "$str_value is already taken";
}






?>


