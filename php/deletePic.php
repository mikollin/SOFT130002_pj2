<?php
//var_dump($_POST);
//$image=$_POST['image'];
//echo('this '.$image);
//$json_arr=array("image"=>$image);
//$json_obj=json_encode($json_arr);
//echo $json_obj;
$image=$_GET["path"];
echo $image;

$user = 'root';
$password = 'root';
$db = 'Pj2';
$host = 'localhost';
$port = 3306;
$serve='localhost:3306';

$con = new Mysqli($serve,$user,$password,$db);
$con->query("SET NAMES utf8");//解决中文乱码问题
$sql="select * from travelimage where path='$image'";
$result=$con->query($sql);
$row=$result->fetch_row();
$imageid=$row[0];

$sql="DELETE FROM `travelimage` WHERE `travelimage`.`ImageID` ='$imageid'";
$result=$con->query($sql);
$sql="DELETE FROM `travelimagefavor` WHERE `travelimagefavor`.`ImageID` ='$imageid'";
//照片删除 对应的收藏的也应该删除
$result=$con->query($sql);

mysqli_free_result($result);
mysqli_close($con);//关闭mysql链接答
echo " <script   language = 'javascript' type = 'text/javascript' > ";
echo "window.location.href='../html/mypics.php'";
echo " </script > ";

?>
