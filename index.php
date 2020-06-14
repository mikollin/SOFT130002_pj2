<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">




    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
     <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" media="screen" href="css/home.css" />
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css"/>
<title>my_pj_首页</title>
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
                    
                    <li><a id="now" href="index.php">Home</a></li>
                    <li><a href="html/browse.php">Browse</a></li>
                    <li><a href="html/search.php">Search</a></li>
                 <!-- </ul> -->



                    <li id="my_account">   <!-- id="my account" -->
                        <?php if(isset($_SESSION['username'])) : ?>
                        <a href="#">My Account</a>
                        <ul>
                            <li id="upload"><a href="html/upload.php"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload</a></li>
                            <li id="pics"><a href="html/mypics.php"><i class="fa fa-camera-retro" aria-hidden="true"></i> My Pics</a></li>
                            <li id="favor"><a href="html/myfavor.php"><i class="fa fa-gratipay" aria-hidden="true"></i> My Favorite</a></li>
                            <li id="log"><a href="php/logout.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Log out</a></li>
                        </ul>
                        <?php else: ?>
                        <a href="html/login.html">Log in</a>

                        <?php endif ?>
                    </li>



                    </ul>        
                    
                        
  </div>


<section >

                        <a href="#" onclick="gototop()">
                        <img id="backtotop" src="img/回到顶部.png"/>
                        </a>


                        <a href="index.php?fresh=true" onclick="alert('已刷新')">
                        <img id="refresh" src="img/刷新.png"/>
                        </a>

                        <script>
                        function gototop(){
                            window.scrollTo('0','0');  //回到顶部
                            }
                        </script>




          <img id="first" src="img/头图.jpg"/>

          <!-- 热门图片展示 -->
    <?php

    $user = 'root';
    $password = 'root';
    $db = 'Pj2';
    $host = 'localhost';
    $port = 3306;
    $serve='localhost:3306';



    $con = new Mysqli($serve,$user,$password,$db);

if($_GET["fresh"]==true){
    $sql="select * from travelimage order by Rand() limit 0,8";
    //unset($_SESSION['fresh']);
}else {
    $sql = "select * from travelimage order by FavoredNum desc limit 0,8"; //如果收藏数>0的小于8个之后按照imageid递减
}


    $result=$con->query($sql);


    if(mysqli_num_rows($result)>0) {
    while ($row = $result->fetch_row()) {
        echo "<div>";
        echo '<a href="html/detail.php?path=';
        echo $row[9];
//        echo '&title=';
//        echo $row[1];
//        echo '&description=';
//        echo $row[2];
//        echo '&country=';
//        echo $row[11];
//        echo '&city=';
//        echo $row[12];
//        echo '&content=';
//        echo $row[10];
//        echo '&author=';
//        echo $row[8];
//        echo '&favorNum=';
//        echo $row[13];

        echo '">';
        echo '<img class="pic1" src="upfile/';
        echo $row[9];
        echo '"/></a>';
        echo '<p class="word1">';
        echo $row[1];
        echo '</p>';
        echo '<p class="word1">';
        echo $row[2];
        echo '</p></div>';

    }
    }


?>

</section>

</body>











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
                    <img id="icon" src="img/二维码.jpg" />

                </p>

            </div>



        </div>


    </footer>

 

</body>

 
</html>