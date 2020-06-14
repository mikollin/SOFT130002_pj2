<?php
header("Content-type:text/html;charset-utf-8");
header("Access-Control-Allow-Origin: *"); //解决跨域
header('Access-Control-Allow-Methods:POST');// 响应类型

//$upload="upload";
session_start();
$username=$_SESSION['username'] ;
//$_SESSION['upload'] = $_SESSION['username'];
//echo $_SESSION['username'];
//echo $_SESSION['upload'];

$title=$_POST['upload_pic_title'];
$description=$_POST['upload_pic_description'];
$country=$_POST['upload_pic_country'];
$city=$_POST['upload_pic_city'];
$theme=$_POST['upload_pic_theme'];
$pic=$_FILES['upload_pics'];
$json_arr=array("upload_pic_title"=>$title,"upload_pic_description"=>$description,"upload_pic_country"=>$country,"upload_pic_city"=>$city,"upload_pic_theme"=>$theme);
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
$con->query("SET NAMES utf8");//

echo $city;


$valid=isset($_FILES['upload_pics']);
echo json_encode(array('valid'=>$valid));
$valid=is_uploaded_file($_FILES['upload_pics']['tmp_name']);
echo json_encode(array('valid'=>$valid));

if($username!=null&&$title!=null&&$pic!=null&&$description!=null&&$theme!=null&&$country!=null&&$city!=null) {
    if (isset($_FILES['upload_pics'])
        && is_uploaded_file($_FILES['upload_pics']['tmp_name'])) {
        $imgFile = $_FILES['upload_pics'];
        $upErr = $imgFile['error'];
        if ($upErr == 0) {

            $imgFileName = $imgFile['name'];
            echo $imgFileName;
            $imgSize = $imgFile['size'];
            $imgTmpFile = $imgFile['tmp_name'];

//             将文件从临时文件夹移到上传文件夹中。
//            注意：upfile这个文件夹必须先创建好，不然会报错。

            $sql="select * from travelimage where path='$imgFileName'";
            $result=$con->query($sql);

            $valid = false;
            if(mysqli_num_rows($result)>0)//exists
                $valid=true;


            if (file_exists('../upfile/' . $imgFileName)||$valid) {
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"文件已存在有被覆盖的危险！系统自动将文件名声明为副本\");\r\n";
                // echo " history.back();\r\n";
                echo "</script>";
                $tmp = 1;
                $str = $imgFileName;
                while (file_exists('../upfile/' . $str)) {
                    $tmp++;
                    $str = $tmp . '-' . $imgFileName;
                }
                $imgFileName = $tmp . '-' . $imgFileName;
                echo $imgFileName;
            }

            $valid = move_uploaded_file($imgTmpFile, '../upfile/' . $imgFileName);

            echo json_encode(array('valid' => $valid));

            //判断文件名是否重名


            //显示上传后的文件的信息。
            $strPrompt = sprintf("文件%s上传成功<br>"
                . "文件大小: %s字节<br>"
                . "<img src='../upfile/%s'>"
                , $imgFileName, $imgSize, $imgFileName
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
        echo "出错！";
    }

}
echo 'dodo';

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



if($username!=null&&$title!=null&&$imgFileName!=null&&$description!=null&&$theme!=null&&$country!=null&&$city!=null) {
    $sentence = "INSERT INTO `travelimage`(`Title`, `Description`,`Content`,`PATH`,`Country`,`City`,`UserName`,`CountryCodeISO`,`CityCode`,`UID`) VALUES ('$title','$description','$theme','$imgFileName','$country',\"$city\",'$username','$countryCode','$cityCode','$uid')";

    if (!$con){//如果连接失败
        die('Could not connect: ' . mysqli_error());//输出错误信息并退出脚本
    }
    $res = $con->query($sentence);

    $sql="select * from travelimage where path='$imgFileName'";
    $result=$con->query($sql);
//$data=array();

    $valid = false;
    if(mysqli_num_rows($result)>0)//exists
        $valid=true;

    echo json_encode(array('valid'=>$valid));
    echo $title;
    echo $username;
    echo $imgFileName;
    echo $description;
    echo $theme;
    echo $country;
    echo $city;
}

mysqli_free_result($result);
mysqli_free_result($res);
mysqli_close($con);//关闭mysql链接答

echo " <script   language = 'javascript' type = 'text/javascript' > ";
echo "window.location.href='../html/mypics.php'";
echo " </script > ";


?>
