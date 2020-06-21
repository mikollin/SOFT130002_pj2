<?php
session_start();
//echo $_SESSION['username']; ;
$user = 'root';
$password = 'root';
$db = 'Pj2';
$host = 'localhost';
$port = 3306;
$serve = 'localhost:3306';
$con = new Mysqli($serve, $user, $password, $db);
$con->query("SET NAMES utf8");//解决中文乱码问题
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">



 

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../jquery-1.10.2/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../css/browse.css" />
<title>my_pj_浏览</title>
</head>




<body>

<header>
   <div>

            <div id="title">Hello World</div>

            <div id="titlebottom">

                Welcome to the "Hello World" to share your great pictures with us!
               

            </div>
</div>
           
</header>

<div class="top">
                 <ul> 
                   <!--  <ul id="1">  -->
                    
                    <li><a href="../index.php">Home</a></li>
                    <li><a id="now" href="browse.php">Browse</a></li>
                    <li><a href="search.php">Search</a></li>
                 <!-- </ul> --> 
                   

                     <li id="my_account">
                         <?php if(isset($_SESSION['username'])) : ?>
                             <a href="#">My Account</a>
                             <ul>
                                 <li id="upload"><a href="upload.php"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload</a></li>
                                 <li id="pics"><a href="mypics.php"><i class="fa fa-camera-retro" aria-hidden="true"></i> My Pics</a></li>
                                 <li id="favor"><a href="myfavor.php"><i class="fa fa-gratipay" aria-hidden="true"></i> My Favorite</a></li>
                                 <li id="log"><a href="../php/logout.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Log out</a></li>
                             </ul>
                         <?php else: ?>
                             <a href="login.html">Log in</a>

                         <?php endif ?>
                    </li>
                    </ul>
          
                    
                        
  </div>

<section>

<div id="sidebar">
    <div id="sidesearch">
                    <p><i class="fa fa-ravelry" aria-hidden="true"></i> SEARCH BY TITLE</p>
                    <form action="" method="GET" name="to_browse">
                    <!-- 两个均用name=“to_browse”来命名form -->
                    <i class="fa fa-search" aria-hidden="true"></i> <input name="browse_search" type="search" >
                    <input name="search" type="submit" value="search" onclick="alert('已搜索')">
                    <!-- 解决放到github上之后的405not allowed 问题 -->
                    </form>
    </div>

<br>

    <div id="hot_content">
                    <p><i class="fa fa-fire" aria-hidden="true"></i> HOT CONTENTS</p>
                    <table>
                        <?php

                        $sql="SELECT DISTINCT count( * ) AS count,`Content` FROM travelimage GROUP BY Content ORDER BY count DESC";
                        $result = $con->query($sql);
                        if (mysqli_num_rows($result) > 0) {
                            $i=0;
                            while($row = $result->fetch_row()) {
                                if($row[1]!=null) {
                                    echo '<tr><th><a href="browse.php?hot_content=';
                                    echo $row[1];
                                    echo '" onclick="alert(\'已筛选\')">';
                                    echo $row[1];
                                    echo '</a></th></tr>';
                                    $i++;
                                    if($i==4)
                                        break;
                                }
                            }
                        }

                        ?>
                       </table>
   </div>
<br>

   <div id="hot_country">
                    <p><i class="fa fa-fire" aria-hidden="true"></i> HOT COUNTRIES</p>
                    <table>
                        <?php

                        $sql="SELECT DISTINCT count( * ) AS count,`CountryCodeISO` FROM travelimage GROUP BY CountryCodeISO ORDER BY count DESC";
                        $result = $con->query($sql);
                        if (mysqli_num_rows($result) > 0) {
                            $i=0;
                            while($row = $result->fetch_row()) {
                                if($row[1]!=null) {
                                    $sql="select geocountries.CountryName,geocountries.ISO from geocountries where ISO='$row[1]'";
                                    $res=$con->query($sql);
                                    $country=$res->fetch_row();
                                    echo '<tr><th><a href="browse.php?hot_country=';
                                    echo $row[1];
                                    echo '" onclick="alert(\'已筛选\')">';
                                    echo $country[0];
                                    echo '</a></th></tr>';
                                    $i++;
                                    if($i==4)
                                        break;
                                }
                            }
                        }


                ?>
                    </table>
   </div>
<br>



   <div id="hot_city">
                    <p><i class="fa fa-fire" aria-hidden="true"></i> HOT CITIES</p>
                    <table>
                        <?php

                        $sql="SELECT DISTINCT count( * ) AS count,`CityCode` FROM travelimage GROUP BY CityCode ORDER BY count DESC";
                        $result = $con->query($sql);
                        if (mysqli_num_rows($result) > 0) {
                            $i=0;
                            while($row = $result->fetch_row()) {
                                if($row[1]!=null) {
                                    $sql="select AsciiName from geocities where geonameid='$row[1]'";
                                    $res=$con->query($sql);
                                    $city=$res->fetch_row();
                                    echo '<tr><th><a href="browse.php?hot_city=';
                                    echo $row[1];
                                    echo '" onclick="alert(\'已筛选\')">';
                                    echo $city[0];
                                    echo '</a></th></tr>';
                                    $i++;
                                    if($i==4)
                                        break;
                                }
                            }
                        }


                        ?>
                              </table>
   </div>
</div>



<div id="filter">
   <div id="filtitle">FILTER</div>

   <div id="fil">
                    <form action="" method="GET" name="to_browse">
                    <select name="select_content" required>
                     <option selected="selected" value=""disabled selected hidden>CONTENT</option>
                        <option>Building</option>
                        <option>Wonder</option>
                        <option>Scenery</option>
                        <option>City</option>
                        <option>People</option>
                        <option>Animal</option>
                        <option>Other</option>
                    </select>

                        <select id="first" class="form-control" name="upload_pic_country" onChange="change()" required>
                            <option selected="selected" value=""disabled selected hidden>COUNTRY</option>

                            <?php
                            $user = 'root';
                            $password = 'root';
                            $db = 'Pj2';
                            $host = 'localhost';
                            $port = 3306;
                            $serve='localhost:3306';



                            $con = new Mysqli($serve,$user,$password,$db);
                            $con->query("SET NAMES utf8");//解决中文乱码问题


                            $sql="select geocountries.CountryName,geocountries.ISO from geocountries";
                            $result=$con->query($sql);
                            $count = mysqli_num_rows($result);
                            while($row=$result->fetch_row()){
                                echo '<option>';
                                echo  $country=$row[0];
                                echo '</option>';
                            }

                            ?>

                            <!--                                   <option>China</option>-->
                            <!--                                   <option>Japan</option>-->
                            <!--                                   <option>Italy</option>-->
                            <!--                                   <option>America</option>-->
                        </select>


           <select id="second" class="form-control" name="upload_pic_city" required>
               <option selected="selected" value=""disabled selected hidden>CITY</option>
        </select>


    <script>

        function change(){

            let x = document.getElementById("first");

            let y = document.getElementById("second");

            y.options.length = 0; // 清除second下拉框的所有内容

            let i = 0;
            let count=x.options.length;

            /*
            jquery
            先获取大类选择框的值，并通过$.getJSON方法传递给后台，读取后台返回的JSON数据，
            并通过$.each方法遍历JSON数据，最后将option追加到小类里。
            * */

            $.getJSON("../php/findRelatedCity.php",{first:$("#first").val()},function(json){
                let second = $("#second");

                $.each(json,function(index,array){
                    //var option = "<option value='"+array['id']+"'>"+array['title']+"</option>";
                    y.options.add(new Option(array['city'], array['city']));
                });
            });

        }


    </script>



    <input name="filter" type="submit" value="FILTER" onclick="alert('已搜索')">

                    </form>

<hr>
   </div>



                     <div id="filpic">
<?php


if($_SERVER["REQUEST_METHOD"] == "GET"&&$_GET['browse_search']!='')
{

    $title = $_GET['browse_search'];

    $sql = "select * from travelimage where title like '%$title%'";
    $result = $con->query($sql);



    $page = empty($_GET['page']) ? 1 : $_GET['page'];
    $pageRes = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    //每页显示数 每页显示五条
    $num = 20;
    //根据每页显示数可以求出来总页数
    $pageCount = ceil($count / $num);  //ceil取整
    if($pageCount>5)
        $pageCount=5;
    //根据总页数求出偏移量
    $offset = ($page - 1) * $num; //起始位置


        $sql = "select * from travelimage where title like '%$title%' limit $offset,$num";
        $result = $con->query($sql);


    if (mysqli_num_rows($result) > 0) {

        while ($row = $result->fetch_row()) {
            //while ($row=mysqli_fetch_assoc($res)){

            echo '<a href="./detail.php?path=';
            echo $row[9];

            echo '">';

            echo '<img class="pic1" src="../upfile/';
            echo $row[9];
            echo '">';
            echo '</a>';



        }

        echo '<div id="page"> <a href="./browse.php?page=';
        echo ($page-1)>0 ? $page-1:1;
        echo '&browse_search=';
        echo $title;
        echo '" >&lt&lt&nbsp</a>';
        $i = 1;
        for (; $i <= $pageCount; $i = $i + 1) {
            if ($i == $page) {
                echo '<a style="font-size:40px;color:#00CCCC;"';
            } else {
                echo '<a ';
            }
            echo 'href="./browse.php?page=';
            echo $i;
            echo '&browse_search=';
            echo $title;
            echo '" > &nbsp' . $i . ' &nbsp</a> ';
        }
        echo '<a href="./browse.php?page=';
        echo ($page+1)<=$pageCount ? $page+1:$pageCount;
        echo '&browse_search=';
        echo $title;
        echo '" > >> </a></div>';
    } else {
        echo "<h2>No results</h2>";
    }
}
else if($_SERVER["REQUEST_METHOD"] == "GET"&&$_GET['upload_pic_country']!=''&&$_GET['upload_pic_city']!=''&&$_GET['select_content']!='')
{

   $country=$_GET['upload_pic_country'];
   $city=$_GET['upload_pic_city'];
   $content=$_GET['select_content'];


   $sql="select ISO from geocountries where countryname='$country' ";
   $result = $con->query($sql);
   $row = $result->fetch_row();
   $countryCode=$row[0];


    $sql="select GeoNameId from geocities where AsciiName=\"$city\" ";
    $result = $con->query($sql);
    $row = $result->fetch_row();
    $cityCode=$row[0];


    $sql = "select * from travelimage where CountryCodeISO='$countryCode' and cityCode='$cityCode' and Content='$content'";
    $result = $con->query($sql);



    $page = empty($_GET['page']) ? 1 : $_GET['page'];
    $pageRes = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    //每页显示数 每页显示五条
    $num = 20;
    //根据每页显示数可以求出来总页数
    $pageCount = ceil($count / $num);  //ceil取整
    if($pageCount>5)
        $pageCount=5;
    //根据总页数求出偏移量
    $offset = ($page - 1) * $num; //起始位置

    $sql = "select * from travelimage where CountryCodeISO='$countryCode' and cityCode='$cityCode' and Content='$content'";
    $result = $con->query($sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = $result->fetch_row()) {
            //while ($row=mysqli_fetch_assoc($res)){

            echo '<a href="./detail.php?path=';
            echo $row[9];

            echo '">';

            echo '<img class="pic1" src="../upfile/';
            echo $row[9];
            echo '">';
            echo '</a>';



        }

        echo '<div id="page"> <a href="./browse.php?page=';
        echo ($page-1)>0 ? $page-1:1;
        echo '&select_content=';
        echo $content;
        echo '&upload_pic_country=';
        echo $country;
        echo '&upload_pic_city=';
        echo $city;
        echo '" >&lt&lt&nbsp</a>';
        $i = 1;
        for (; $i <= $pageCount; $i = $i + 1) {
            if ($i == $page) {
                echo '<a style="font-size:40px;color:#00CCCC;"';
            } else {
                echo '<a ';
            }
            echo 'href="./browse.php?page=';
            echo $i;
            echo '&select_content=';
            echo $content;
            echo '&upload_pic_country=';
            echo $country;
            echo '&upload_pic_city=';
            echo $city;
            echo '" > &nbsp' . $i . ' &nbsp</a> ';
        }
        echo '<a href="./browse.php?page=';
        echo ($page+1)<=$pageCount ? $page+1:$pageCount;
        echo '&select_content=';
        echo $content;
        echo '&upload_pic_country=';
        echo $country;
        echo '&upload_pic_city=';
        echo $city;
        echo '" > >> </a></div>';
    } else {

        echo "<h2>No results</h2>";
    }
}
else if($_GET['hot_content']!=''){
    $content = $_GET['hot_content'];

    $sql = "select * from travelimage where content='$content'";
    $result = $con->query($sql);



    $page = empty($_GET['page']) ? 1 : $_GET['page'];
    $pageRes = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    //每页显示数 每页显示五条
    $num = 20;
    //根据每页显示数可以求出来总页数
    $pageCount = ceil($count / $num);  //ceil取整
    if($pageCount>5)
        $pageCount=5;
    //根据总页数求出偏移量
    $offset = ($page - 1) * $num; //起始位置


    $sql = "select * from travelimage where content='$content' limit $offset,$num";
    $result = $con->query($sql);


    if (mysqli_num_rows($result) > 0) {

        while ($row = $result->fetch_row()) {
            //while ($row=mysqli_fetch_assoc($res)){

            echo '<a href="./detail.php?path=';
            echo $row[9];

            echo '">';

            echo '<img class="pic1" src="../upfile/';
            echo $row[9];
            echo '">';
            echo '</a>';



        }

        echo '<div id="page"> <a href="./browse.php?page=';
        echo ($page-1)>0 ? $page-1:1;
        echo '&hot_content=';
        echo $content;
        echo '" >&lt&lt&nbsp</a>';
        $i = 1;
        for (; $i <= $pageCount; $i = $i + 1) {
            if ($i == $page) {
                echo '<a style="font-size:40px;color:#00CCCC;"';
            } else {
                echo '<a ';
            }
            echo 'href="./browse.php?page=';
            echo $i;
            echo '&hot_content=';
            echo $content;
            echo '" > &nbsp' . $i . ' &nbsp</a> ';
        }
        echo '<a href="./browse.php?page=';
        echo ($page+1)<=$pageCount ? $page+1:$pageCount;
        echo '&hot_content=';
        echo $content;
        echo '" > >> </a></div>';
    } else {
        echo "<h2>No results</h2>";
    }

}
else if($_GET['hot_country']!=''){
    $countryCode = $_GET['hot_country'];

    $sql="select countryname from geocountries where iso='$countryCode' ";
    $result = $con->query($sql);
    $row = $result->fetch_row();
    $country=$row[0];


    $sql = "select * from travelimage where countrycodeiso='$countryCode'";
    $result = $con->query($sql);

    $page = empty($_GET['page']) ? 1 : $_GET['page'];
    $pageRes = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    //每页显示数 每页显示五条
    $num = 20;
    //根据每页显示数可以求出来总页数
    $pageCount = ceil($count / $num);  //ceil取整
    if($pageCount>5)
        $pageCount=5;
    //根据总页数求出偏移量
    $offset = ($page - 1) * $num; //起始位置


    $sql = "select * from travelimage where countrycodeiso='$countryCode' limit $offset,$num";
    $result = $con->query($sql);


    if (mysqli_num_rows($result) > 0) {

        while ($row = $result->fetch_row()) {
            //while ($row=mysqli_fetch_assoc($res)){

//            echo '<div class="container">';

            echo '<a href="./detail.php?path=';
            echo $row[9];

            echo '">';

            echo '<img class="pic1" src="../upfile/';
            echo $row[9];
            echo '">';
            echo '</a>';
//            echo '</div>';


        }


        echo '<div id="page"> <a href="./browse.php?page=';
        echo ($page-1)>0 ? $page-1:1;
        echo '&hot_country=';
        echo $countryCode;
        echo '" >&lt&lt&nbsp</a>';
        $i = 1;
        for (; $i <= $pageCount; $i = $i + 1) {
            if ($i == $page) {
                echo '<a style="font-size:40px;color:#00CCCC;"';
            } else {
                echo '<a ';
            }
            echo 'href="./browse.php?page=';
            echo $i;
            echo '&hot_country=';
            echo $countryCode;
            echo '" > &nbsp' . $i . ' &nbsp</a> ';
        }
        echo '<a href="./browse.php?page=';
        echo ($page+1)<=$pageCount ? $page+1:$pageCount;
        echo '&hot_country=';
        echo $countryCode;
        echo '" > >> </a></div>';
    } else {
        echo "<h2>No results</h2>";
    }


}
else if($_GET['hot_city']!=''){
    $cityCode = $_GET['hot_city'];


    $sql="select AsciiName from geocities where GeoNameID='$cityCode' ";
    $result = $con->query($sql);
    $row = $result->fetch_row();
    $city=$row[0];

    $sql = "SELECT * FROM travelimage where `CityCode`='$cityCode'";
    $result = $con->query($sql);

    $page = empty($_GET['page']) ? 1 : $_GET['page'];
    $pageRes = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    //每页显示数 每页显示五条
    $num = 20;
    //根据每页显示数可以求出来总页数
    $pageCount = ceil($count / $num);  //ceil取整
    if($pageCount>5)
        $pageCount=5;
    //根据总页数求出偏移量
    $offset = ($page - 1) * $num; //起始位置


    $sql = "SELECT * FROM travelimage where `CityCode`='$cityCode' limit $offset,$num";
    $result = $con->query($sql);


    if (mysqli_num_rows($result) > 0) {

        while ($row = $result->fetch_row()) {
            //while ($row=mysqli_fetch_assoc($res)){

            echo '<a href="./detail.php?path=';
            echo $row[9];

            echo '">';

            echo '<img class="pic1" src="../upfile/';
            echo $row[9];
            echo '">';
            echo '</a>';



        }

        echo '<div id="page"> <a href="./browse.php?page=';
        echo ($page-1)>0 ? $page-1:1;
        echo '&hot_city=';
        echo $cityCode;
        echo '" >&lt&lt&nbsp</a>';
        $i = 1;
        for (; $i <= $pageCount; $i = $i + 1) {
            if ($i == $page) {
                echo '<a style="font-size:40px;color:#00CCCC;"';
            } else {
                echo '<a ';
            }
            echo 'href="./browse.php?page=';
            echo $i;
            echo '&hot_city=';
            echo $cityCode;
            echo '" > &nbsp' . $i . ' &nbsp</a> ';
        }
        echo '<a href="./browse.php?page=';
        echo ($page+1)<=$pageCount ? $page+1:$pageCount;
        echo '&hot_city=';
        echo $cityCode;
        echo '" > >> </a></div>';
    } else {
        echo "<h2>No results</h2>";
    }



}
else{
    $sql = "select * from travelimage";
    $result = $con->query($sql);



    $page = empty($_GET['page']) ? 1 : $_GET['page'];
    $pageRes = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    //每页显示数 每页显示五条
    $num = 20;
    //根据每页显示数可以求出来总页数
    $pageCount = ceil($count / $num);  //ceil取整
    if($pageCount>5)
        $pageCount=5;
    //根据总页数求出偏移量
    $offset = ($page - 1) * $num; //起始位置


    $sql = "select * from travelimage limit $offset,$num";
    $result = $con->query($sql);


    if (mysqli_num_rows($result) > 0) {

        while ($row = $result->fetch_row()) {
            //while ($row=mysqli_fetch_assoc($res)){

            echo '<a href="./detail.php?path=';
            echo $row[9];

            echo '">';

            echo '<img class="pic1" src="../upfile/';
            echo $row[9];
            echo '">';
            echo '</a>';



        }

        echo '<div id="page"> <a href="./browse.php?page=';
        echo ($page-1)>0 ? $page-1:1;

        echo '" >&lt&lt&nbsp</a>';
        $i = 1;
        for (; $i <= $pageCount; $i = $i + 1) {
            if ($i == $page) {
                echo '<a style="font-size:40px;color:#00CCCC;"';
            } else {
                echo '<a ';
            }
            echo 'href="./browse.php?page=';
            echo $i;

            echo '" > &nbsp' . $i . ' &nbsp</a> ';
        }
        echo '<a href="./browse.php?page=';
        echo ($page+1)<=$pageCount ? $page+1:$pageCount;

        echo '" > >> </a></div>';
    }

}

mysqli_free_result($res);
mysqli_free_result($result);
mysqli_close($con);

?>
<!---->
<!--    <a href="/detail.html"><img class="pic1" src="../img\travel-images\normal/medium/9494472443.jpg"/></a>-->
<!--                     <a href="/detail.html"><img class="pic1" src="../img\travel-images\normal/medium/8710289254.jpg"/></a>-->


</div>


</section>


 <footer>

        <div>

            <div>

                <p>LEARN MORE</p>

                <p>How it works?</p>

                <p>Meeting tools</p>

                <p>Live streaming</p>

                <p>Contact Method</p>

            </div>

            <div>

                <p>ABOUT US</p>

                <P>About us</P>

                <p>Features</p>

                <p>Privacy police</p>

                <p>Terms & Conditions</p>

            </div>

            <div>

                <p>SUPPORT</p>

                <p>FAQ</p>

                <p>Contact us</p>

                <p>Live chat</p>

                <p>Phone call</p>

            </div>

            <div>

                <p>ENJOY YOUR LIFE</p>

                <p>Copyright &copy 2010-2021 Yiling Zhao. </p>
                <p>All rights reserved.</p>
                  <p> 备案号：18300290055</p>
                
</div>
              
<div>
                <p>

                    <!-- wechat -->
                    <img id="icon" src="../img/二维码.jpg" />  

                </p>

            </div>



        </div>


    </footer>

 

</body>

 
</html>
<script>
<?php
if($_GET['cityCode']!=''&&$_GET['countryCode']!='')
{


    $sql="select geocountries.CountryName from geocountries where ISO='$countryCode'";
    $result=$con->query($sql);
    $row=$result->fetch_row();
    $country=$row[0];

    $sql="SELECT * FROM geocities WHERE `GeoNameID`='$cityCode'";
    $result=$con->query($sql);
    $row=$result->fetch_row();
    $city=$row[1];

    $sql="SELECT * FROM geocities where `CountryCodeISO`='$countryCode'";
    $result=$con->query($sql);

}

?>



</script>
