<?php
$username=$_POST['id'];
$user = 'root';
$password = 'root';
$db = 'Pj2';
$host = 'localhost';
$port = 3306;
$serve='localhost:3306';



$con = new Mysqli($serve,$user,$password,$db);
$sql="select * from traveluser where username='$_POST[id]'";
$result=$con->query($sql);
//$data=array();

$valid = false;
if(mysqli_num_rows($result)>0)//exists
    $valid=true;

echo json_encode(array('valid'=>$valid));

mysqli_free_result($result);
mysqli_close($con);//关闭mysql链接答
?>