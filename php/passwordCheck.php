<?php
$username=$_POST['id'];
$pwd=$_POST['password'];
$user = 'root';
$password = 'root';
$db = 'Pj2';
$host = 'localhost';
$port = 3306;
$serve='localhost:3306';



$con = new Mysqli($serve,$user,$password,$db);
$con->query("SET NAMES utf8");//解决中文乱码问题
$passwordRegistered=$_POST['password'];
$sql="select pass from traveluser where username='$_POST[id]'";
$result=$con->query($sql);
//$data=array();
$row=$result->fetch_row();
$valid = false;
if(mysqli_num_rows($result)>0)//exists
{
    if(password_verify($passwordRegistered,$row[0]))
    $valid = true;
}

echo json_encode(array('valid'=>$valid));

mysqli_free_result($result);
mysqli_close($con);//关闭mysql链接答
?>