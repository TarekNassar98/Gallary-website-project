<?php 


    $servername = "sql102.epizy.com";
    $username = "epiz_31770710";
    $password = "7VAWScXAowKm";
    $db_name = "epiz_31770710_gallery";
$conn = new mysqli($servername, $username, $password,$db_name);
$stmt = $conn->prepare("select name from image where name like CONCAT('%',?,'%')");
$stmt->bind_param("s",$_GET['q'] );
$stmt->execute();
$content=$stmt->get_result();
if($content == false || $content->num_rows==0)
    echo "<li><h3>No data found</h3></li>";

    else
        while($vals = $content->fetch_array())
        echo "<li style ='cursor:pointer;' onclick=output(this)><a href='#'>$vals[0]</a></li>\n";

?>