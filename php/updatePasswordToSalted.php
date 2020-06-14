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

$i=1;
for(;$i<36;$i++) {
    $sql = "select pass from traveluser where uid='$i'";
    $result = $con->query($sql);

    if (mysqli_num_rows($result) > 0) {
        $row=$result->fetch_row();
        $passwordRegister=$row[0];
        $pass=password_hash($passwordRegister, PASSWORD_DEFAULT);
        $sql = "update traveluser set pass='$pass' where uid='$i'";
        $result = $con->query($sql);
    }


}

?>