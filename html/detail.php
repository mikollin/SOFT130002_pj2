<?php
session_start();
//echo $_SESSION['username']; ;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">



 

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
     <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../css/detail.css" />
<title>my_pj_图片详情</title>
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
                    <li><a href="browse.php">Browse</a></li>
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
<br>
<section>

<div id="detail">


   <div class="til">DETAILS</div>
<?php


$user = 'root';
$password = 'root';
$db = 'Pj2';
$host = 'localhost';
$port = 3306;
$serve = 'localhost:3306';

$username=$_SESSION['username'];
$con = new Mysqli($serve, $user, $password, $db);
$con->query("SET NAMES utf8");

$path = $_GET['path'];
$sql="select * from travelimage where path='$path'";
$result=$con->query($sql);
$pic=$result->fetch_row();


?>


                     <div class="size"><?php echo $pic[1]; ?></div>
    <?php

    $sql="select traveluser.username,travelimage.uid,travelimage.imageid from travelimage inner join traveluser on traveluser.uid=travelimage.uid where path='$path'";
    $result=$con->query($sql);
    $row=$result->fetch_row();
    $user=$row[0];
    $imageid=$row[2];
    ?>

                     <div class="size2"><i class="fa fa-camera" aria-hidden="true"></i>  taken by : <?php echo $user; ?></div>

<br>
                     <div id="content">

                     <div>
                     <img  id="con_pic" src="../upfile/<?php echo $path; ?>"/>
                     </div>


                <div id="column">
                     <div class="con_word">

                         <?php
                         $sql="select * from travelimagefavor where imageid='$row[2]'";
                         $result=$con->query($sql);
                         $count = mysqli_num_rows($result);
                         ?>

                     <div class="size"><?php echo $count; ?></div>

                     <p>PEOPLE LIKE THIS <i id="likeit" class="fa fa-heart" aria-hidden="true"></i></p>

                     </div>



                     <div class="con_word">


                     <p><i class="fa fa-camera-retro" aria-hidden="true"></i> IMAGE DETAILS</p>
                     <table>
                     <tr><td>Content : <?php echo $pic[10];?></td></tr>
                         <?php

                         $sql="select geocountries.CountryName,travelimage.CountryCodeISO,travelimage.CityCode,travelimage.PATH from travelimage inner join geocountries on travelimage.`CountryCodeISO`=geocountries.ISO where path='$path'";
                         $result=$con->query($sql);
                         $row=$result->fetch_row();
                         $country=$row[0];
                         $citycode=$row[2];

                         $sql="SELECT * FROM geocities WHERE `GeoNameID`='$citycode'";
                         $result=$con->query($sql);
                         $row=$result->fetch_row();
                         $city=$row[1];


                         echo '<tr><td>Country : ';
                         echo $country;
                         echo '</td></tr>';
                          echo '<tr><td>City : ';
                         echo $city;
                         echo '</td></tr>';


                         ?>


                     </table>
                     </div>

                     <div class="con_word">

                     <div class="size2">LIKE THIS <a id="like" href="#" onclick=""><i class="fa fa-heart" aria-hidden="true"></i></a></div>



                     </div>

                </div>




                     </div>

                     <div id="description">
                         <h3>DESCRIPTION : </h3>
                     <p><?php echo $pic[2]; ?></p>
                     </div>

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
<script src="../js/setFavor.js"></script>
<script defer>
    //alert(document.getElementById('con_pic').width+380);
    //alert(document.getElementById('content').style.getPropertyValue('min-width'));

    if(document.getElementById('con_pic').width+380>1200){
        document.getElementById('content').style.setProperty('width',document.getElementById('con_pic').width+380+250+'px');
        document.getElementById('detail').style.setProperty('width',document.getElementById('con_pic').width+380+250+'px');
        document.getElementsByTagName('header')[0].style.setProperty('width',document.getElementById('con_pic').width+380+290+'px');
        document.getElementsByClassName('top')[0].style.setProperty('width',document.getElementById('con_pic').width+380+290+'px');
        document.getElementsByTagName('footer')[0].style.setProperty('width',document.getElementById('con_pic').width+380+290+'px');


    }


    let notlike= document.getElementById('like');
    <?php


    $sql="select * from traveluser where username='$username'";
    $result=$con->query($sql);
    $row=$result->fetch_row();
    $uid=$row[0];

    $sql="select * from travelimagefavor where imageid='$imageid' and uid='$uid'";
    $result=$con->query($sql);
    $valid='false';


    if(mysqli_num_rows($result)>0)
        $valid='true';
    else
        $valid='false';



    ?>

    if(<?php echo $valid; ?>){
        notlike.style.color="red";
        notlike.setAttribute('href','../php/detailCancelFavored.php?path='+'<?php echo $path; ?>');
        notlike.onclick = function () {
            //alert('若已登陆马上取消收藏，若未登录跳转到登录界面，请登录后操作...');
        }
    }
    else{
        notlike.style.color="white";
        notlike.setAttribute('href','../php/setFavored.php?path='+'<?php echo $path; ?>');
        notlike.onclick = function () {
            //alert('若已登陆马上收藏，若未登录跳转到登录界面，请登录后操作...');
        }
    }

</script>

<?php
mysqli_free_result($result);
mysqli_close($con);//关闭mysql链接答
?>