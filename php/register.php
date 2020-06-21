<?php
$user = 'root';
$password = 'root';
$db = 'inventory';
$host = 'localhost';
$port = 3306;

$link = mysqli_init();
$success = mysqli_real_connect(
    $link,
    $host,
    $user,
    $password,
    $db,
    $port
);
?>

<?php
header("Content-type:text/html;charset-utf-8");
$username=$_POST['id'];
$email=$_POST['email'];
$passwordRegister=$_POST['password1'];
$json_arr=array("id"=>$username,"email"=>$email,"password1"=>$passwordRegister);
$json_obj=json_encode($json_arr);
echo $json_obj;
echo "正在跳转，请稍后……";

$user = 'root';
$password = 'root';
$db = 'Pj2';
$host = 'localhost';
$port = 3306;
$serve='localhost:3306';
$con = new Mysqli($serve,$user,$password,$db);
$con->query("SET NAMES utf8");//解决中文乱码问题
$pass=password_hash($passwordRegister, PASSWORD_DEFAULT);
$sql="INSERT INTO `traveluser`(`UserName`, `Email`,`Pass`) VALUES ('$username','$email','$pass')";
if($username!=null&&$email!=null&&$passwordRegister!=null)
$result=$con->query($sql);
//$data=array();

echo " <script   language = 'javascript' type = 'text/javascript' > ";
//echo "var path=window.location.pathname;console.log(path);var start=window.location.pathname.split('/');console.log(start.toString());start[start.length-2]='html';start[start.length-1]='login.html';";
//echo "console.log(start.toString());start=start.join('/');";
//echo "console.log(window.location.host+start.toString());window.location.href =window.location.host+start.toString(); ";
echo "window.location.href='../html/login.html'";
echo " </script > ";

mysqli_free_result($result);
mysqli_close($con);//关闭mysql链接答
?>
