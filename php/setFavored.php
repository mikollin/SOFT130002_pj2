<?php
session_start();
header("Content-type:text/html;charset-utf-8");
header("Access-Control-Allow-Origin: *"); //解决跨域
header('Access-Control-Allow-Methods:POST');// 响应类型




if(!isset($_SESSION['username'])) {
echo 'Please log in first !';

echo "<script>window.location.href='../html/login.html'</script>";
}
else {


    $username = $_SESSION['username'];


    $user = 'root';
    $password = 'root';
    $db = 'Pj2';
    $host = 'localhost';
    $port = 3306;
    $serve = 'localhost:3306';
    $con = new Mysqli($serve, $user, $password, $db);
    $con->query("SET NAMES utf8");//解决中文乱码问题

    $path = $_GET["path"];

    $sql = "select * from travelimage where path='$path'";
    $result = $con->query($sql);
    $row = $result->fetch_row();
    $imageid = $row[0];
    $sql="select * from traveluser where username='$username'";
    $result=$con->query($sql);
    $row=$result->fetch_row();
    $uid=$row[0];

    $sql = "select * from travelimagefavor where imageid='$imageid'and uid='$uid'";
    $result = $con->query($sql);
    $valid=false;

    if (mysqli_num_rows($result) == 0) {
        $valid = true;
    } else {
        $valid = false;
    }
    $sql = "select * from travelimage where path='$path'";
    $result = $con->query($sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_row()) {
            $favoredNum = $row[13];
            if ($valid == true)
                $favoredNum = $row[13] + 1;
            //this is the author's uid not current user $uid=$row[7];
            $imageid = $row[0];
            $title = $row[1];
            $des = $row[2];
            $country = $row[11];
            $city = $row[12];
            $content = $row[10];
            $author = $row[8];


        }
    }

    $sql="select * from traveluser where username='$username'";
    $result=$con->query($sql);
    $row=$result->fetch_row();
    $uid=$row[0];

    if ($path != null && $valid == true) {
        $sql = "UPDATE `travelimage` SET `FavoredNum` = '$favoredNum' WHERE `travelimage`.`path` = '$path'";
        $result = $con->query($sql);
        $sql = "INSERT INTO `travelimagefavor`(`UserName`,`ImageID`,`Path`,`UID`) VALUES ('$username','$imageid','$path','$uid')";
        $result = $con->query($sql);
    }
    echo " <script   language = 'javascript' type = 'text/javascript' > ";

    echo "window.location.href='../html/detail.php?path=";
    echo $path;
//    echo '&title=';
//    echo $title;
//    echo '&description=';
//    echo $des;
//    echo '&country=';
//    echo $country;
//    echo '&city=';
//    echo $city;
//    echo '&content=';
//    echo $content;
//    echo '&author=';
//    echo $author;
//    echo '&favorNum=';
//    echo $favoredNum;
//    echo '&favored=';
//    echo 'true';
    echo '\'';
    echo " </script > ";

    mysqli_free_result($result);
    mysqli_close($con);//关闭mysql链接答
}