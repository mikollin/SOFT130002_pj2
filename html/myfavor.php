<?php
session_start();
//echo $_SESSION['username'];
if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">



 

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
     <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css"/>
    
    <link rel="stylesheet" type="text/css" media="screen" href="../css/myfavor.css" />
    
<title>my_pj_我的收藏</title>
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
                   
                 <!--  <ul id="2">  --> 
                    <li id="my_account">
                        <a href="#">My Account</a>
                        <ul>
                            <li id="upload"><a href="upload.php"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload</a></li>
                            <li id="pics"><a href="mypics.php"><i class="fa fa-camera-retro" aria-hidden="true"></i> My Pics</a></li>
                            <li id="favor"><a href="myfavor.php"><i class="fa fa-gratipay" aria-hidden="true"></i> My Favorite</a></li>
                            <li id="log"><a href="login.html"><i class="fa fa-sign-in" aria-hidden="true"></i> Log out</a></li>
                        </ul>
                    </li>
                    </ul>        
                    
                        
  </div>

<section>
<div id="myfavorcontent">

   <div class="myfavor_til">MY FAVORITE</div>

    <?php


    $username=$_SESSION['username'];
    $user = 'root';
    $password = 'root';
    $db = 'Pj2';
    $host = 'localhost';
    $port = 3306;
    $serve='localhost:3306';



    $con = new Mysqli($serve,$user,$password,$db);
    $con->query("SET NAMES utf8");

    $sql="select * from traveluser where username='$username'";
    $result=$con->query($sql);
    $row=$result->fetch_row();
    $uid=$row[0];

    $sql="select * from travelimagefavor where uid='$uid'";
    $result=$con->query($sql);
//
//    if(!mysqli_num_rows($result)){
//
//        $sql="select * from travelimagefavor where username='$username'";
//        $result=$con->query($sql);
//    }

    $page =empty($_GET['page']) ? 1:$_GET['page'];
    $pageRes = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    //每页显示数 每页显示五条
    $num = 5;
    //根据每页显示数可以求出来总页数
    $pageCount = ceil($count/$num);  //ceil取整
    if($pageCount>5)
        $pageCount=5;
    //根据总页数求出偏移量
    $offset = ($page-1)*$num; //起始位置
    $sql="select * from travelimagefavor where uid='$uid' limit $offset,$num";
    $res=$con->query($sql);
//    if(!mysqli_num_rows($res)){
//
//        $sql="select * from travelimagefavor where username='$username' limit $offset,$num";
//        $res=$con->query($sql);
//    }

    if(mysqli_num_rows($res)>0)
    {

        while($rowfavor=$res->fetch_row()){
            //while ($row=mysqli_fetch_assoc($res)){

            $sql="select * from travelimage where imageid=$rowfavor[3]";
            $result=$con->query($sql);


            $row=$result->fetch_row();

            echo '<div class="favoreach">
';
            echo '<a href="./detail.php?path=';
            echo $row[9];

            echo '">';
            echo '<img class="favorpics" src="../upfile/';
            echo $row[9];
            echo   '">';
            echo '</a>';


            echo '<article class="pic_word">';
            echo '<h2>';
            echo $row[1];
            echo '</h2>';

            echo '<p class="picword">';
            echo $row[2];
            echo '</p>';
            echo '</article>';
            echo '<div class="con_word">
                    <div class="size2">DON\'T LIKE <a class="like" ';
            echo 'name="';
            echo $row[9];
            echo '" href="../php/myfavorCancelFavored.php?path=';
            echo $row[9];
            echo '&username=';
            echo $username;
            echo '" onclick="alert(\'取消收藏\')">';
            echo '<i class="fa fa-heart" aria-hidden="true"></i></a></div>
                    </div></div>';
            }

            echo '<div id="page"> <a href="./myfavor.php?page=';
            echo ($page-1)>0 ? $page-1:1;
            echo '" >&lt&lt&nbsp</a>';
            $i=1;
            for(;$i<=$pageCount;$i=$i+1){
                if($i==$page){
                    echo '<a style="font-size:40px;color:#00CCCC;"';
                }
                else{
                    echo '<a ';
                }
                echo 'href="./myfavor.php?page=';
                echo $i;
                echo '" > &nbsp'.$i.' &nbsp</a> ';
            }
            echo '<a href="./myfavor.php?page=';
        echo ($page+1)<=$pageCount ? $page+1:$pageCount;
        echo '" > >> </a></div>';



    }
    else{
        echo "<div id=\"pic_line\">You haven't favored any pictures!
                <br>
                Please create sth!!</div>";
    }


    mysqli_free_result($result);
    mysqli_close($con);


    ?>


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

<?php }else{
    echo 'Please log in first!';
    echo "<script>window.location.href='login.html'</script>";
}?>