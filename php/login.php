<?php
$username=$_POST['id'];
session_start();
//由于先前已经通过usernameexist和passwordcheck 这边双保险再加一个判断写session
$pwd=$_POST['password'];
$user = 'root';
$password = 'root';
$db = 'Pj2';
$host = 'localhost';
$port = 3306;
$serve='localhost:3306';



$con = new Mysqli($serve,$user,$password,$db);
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

mysqli_free_result($result);
mysqli_close($con);//关闭mysql链接答
if($valid) {
    $_SESSION['username'] = $username;
}
echo " <script   language = 'javascript' type = 'text/javascript' > ";
echo "window.location.href='../index.php'";
echo " </script > ";
?>