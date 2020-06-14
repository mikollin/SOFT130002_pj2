<?php

header("Content-type:text/html;charset-utf-8");
header("Access-Control-Allow-Origin: *"); //解决跨域
header('Access-Control-Allow-Methods:POST');// 响应类型

//$upload="upload";
session_start();
$username = $_SESSION['username'];
//$_SESSION['upload'] = $_SESSION['username'];
//echo $_SESSION['username'];
//echo $_SESSION['upload'];
$path=$_GET["path"];
$title = $_POST['upload_pic_title'];
$description = $_POST['upload_pic_description'];
$country = $_POST['upload_pic_country'];
$city = $_POST['upload_pic_city'];
$theme = $_POST['upload_pic_theme'];
$pic = $_FILES['upload_pics'];
echo $title;
echo $description;
echo $country;
echo $city;
echo $theme;


$user = 'root';
$password = 'root';
$db = 'Pj2';
$host = 'localhost';
$port = 3306;
$serve = 'localhost:3306';
$con = new Mysqli($serve, $user, $password, $db);
$con->query("SET NAMES utf8");//解决中文乱码问题

$sql="select * from traveluser where username='$username'";
$result=$con->query($sql);
$row=$result->fetch_row();
$uid=$row[0];

$sql="select uid from travelimage where path='$path'";
$result=$con->query($sql);
$row=$result->fetch_row();
$uploader=$row[0];


if ($username != null && $title != null && $pic != null && $description != null && $theme != null && $country != null && $city != null&&($uid==$uploader)) {
    if (isset($_FILES['upload_pics'])
        && is_uploaded_file($_FILES['upload_pics']['tmp_name'])) {
        $imgFile = $_FILES['upload_pics'];
        $upErr = $imgFile['error'];
        if ($upErr == 0) {

            $imgFileName = $imgFile['name'];
            $imgSize = $imgFile['size'];
            $imgTmpFile = $imgFile['tmp_name'];

//             将文件从临时文件夹移到上传文件夹中。
//            注意：upfile这个文件夹必须先创建好，不然会报错。


            $imgFileName=$path;
            $valid = move_uploaded_file($imgTmpFile, '../upfile/' . $path);




            //显示上传后的文件的信息。
            $strPrompt = sprintf("文件%s上传成功<br>"
                . "文件大小: %s字节<br>"
                . "<img src='../upfile/%s'>"
                , $path, $imgSize, $path
            );
            echo $strPrompt;

        } else {
            echo "文件上传失败。<br>";
            switch ($upErr) {
                case 1:
                    echo "超过了php.ini中设置的上传文件大小。";
                    break;
                case 2:
                    echo "超过了MAX_FILE_SIZE选项指定的文件大小。";
                    break;
                case 3:
                    echo "文件只有部分被上传。";
                    break;
                case 4:
                    echo "文件未被上传。";
                    break;
                case 5:
                    echo "上传文件大小为0";
                    break;
            }
        }
    } else {

    }

}

$sql="select geocountries.CountryName,geocountries.ISO from geocountries where geocountries.CountryName='$country'";
$result=$con->query($sql);
$row=$result->fetch_row();
$countryCode=$row[1];
$sql="select geocities.AsciiName,geocities.GeoNameID from geocities where geocities.AsciiName=\"$city\"";
$result=$con->query($sql);
$row=$result->fetch_row();
$cityCode=$row[1];
$sql="select * from traveluser where username='$username'";
$result=$con->query($sql);
$row=$result->fetch_row();
$uid=$row[0];


if($username!=null&&$title!=null&&$description!=null&&$theme!=null&&$country!=null&&$city!=null&&($uid==$uploader)) {
    $sql = "UPDATE `travelimage` SET `Title` = '$title', `Description` = '$description',`Content`='$theme',`Country`='$country',`City`=\"$city\",`CountryCodeISO`='$countryCode',`CityCode`='$cityCode' WHERE `travelimage`.`path` = '$path'";

//if($username!=null)
    $result = $con->query($sql);
}

mysqli_free_result($result);
mysqli_close($con);//关闭mysql链接答
echo " <script   language = 'javascript' type = 'text/javascript' > ";
echo "window.location.href='../html/mypics.php'";
echo " </script > ";



?>