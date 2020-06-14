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

$valid = true;
if(mysqli_num_rows($result)>0)//exists
    $valid=false;
//echo $username;
//while ($tmp=mysqli_fetch_assoc($result)) {
//    //$data[]=$tmp;
//    if($tmp === $username){
//        $valid = false;//exists
//        break;
//    }
//}
//var_dump($data);  //can connect to the mysql


//$f=array('valid' => $exists);
echo json_encode(array('valid'=>$valid));

//if($valid){
//    echo json_encode($t);   //true代表用户名可以使用
//
//}else{
//    echo json_encode($t);   //代表用户名已经存在
//    echo "用户名已存在，请重新注册！";
//    echo "<a href=register.php>[注册]</a>";
//}
mysqli_free_result($result);
mysqli_close($con);//关闭mysql链接答
?>