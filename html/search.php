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
    <link rel="stylesheet" type="text/css" media="screen" href="../css/search.css" />
<title>my_pj_搜索页</title>
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
                    
                    <li><a  href="../index.php">Home</a></li>
                    <li><a href="browse.php">Browse</a></li>
                    <li><a id="now" href="search.php">Search</a></li>
                 <!-- </ul> --> 
                   
                 <!--  <ul id="2">  --> 
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

<div id="filter">
  <div class="til">SEARCH</div>
                     <div id="choice">
                     <form action="#" method="GET" name="to_search">
                     <input name="choice" value="Filter_by_Title" type="radio" checked/>Filter by Title
                     <br>
                     <input id="frame1" name="filter_title" type="search" />
                     <br>
                     <br>
                     <input name="choice" value="Filter_by_Description" type="radio" />Filter by Description
                     <textarea id="frame2" name="filter_description" cols="6"></textarea>
                     <br>
                     <input id="fil" name="filter" type="submit" value="Filter" onclick="alert('已筛选')">
                     </form>
                     </div>
</div>


<div id="result">
   <div class="til">RESULT</div>

    <?php
   if($_SERVER["REQUEST_METHOD"] != "GET"||($_GET['filter_description']==null&&$_GET['filter_title']==null)){
        echo "<h2>Please input something to search!</h2>";
    }
   else {

       $description = $_GET['filter_description'];
       $title = $_GET['filter_title'];
       $choice = $_GET['choice'];

       if ($choice == "Filter_by_Title") {
           $which = 0;
       } else if ($choice == "Filter_by_Description") {
           $which = 1;
       }

//       if($_GET['which']=0){
//           $which=0;
//       }
//       else if($_GET['which']=0){
//           $which=1;
//       }

       $user = 'root';
       $password = 'root';
       $db = 'Pj2';
       $host = 'localhost';
       $port = 3306;
       $serve = 'localhost:3306';
       $con = new Mysqli($serve, $user, $password, $db);
       $con->query("SET NAMES utf8");//解决中文乱码问题

       if ($which == 0) {
           $sql = "select * from travelimage where title like '%$title%'";
           $result = $con->query($sql);
       } else if ($which == 1) {
           $sql = "select * from travelimage where description like '%$description%'";
           $result = $con->query($sql);
       }


       $page = empty($_GET['page']) ? 1 : $_GET['page'];
       $pageRes = mysqli_fetch_assoc($result);
       $count = mysqli_num_rows($result);
       //每页显示数 每页显示五条
       $num = 5;
       //根据每页显示数可以求出来总页数
       $pageCount = ceil($count / $num);  //ceil取整
       if($pageCount>5)
           $pageCount=5;
       //根据总页数求出偏移量
       $offset = ($page - 1) * $num; //起始位置

       if ($which == 0) {
           $sql = "select * from travelimage where title like '%$title%' limit $offset,$num";
           $result = $con->query($sql);

       } else if ($which == 1) {
           $sql = "select * from travelimage where description like '%$description%' limit $offset,$num";
           $result = $con->query($sql);
       }

       if (mysqli_num_rows($result) > 0) {

           while ($row = $result->fetch_row()) {
               //while ($row=mysqli_fetch_assoc($res)){


               echo '<div class="result1">
';
               echo '<a href="./detail.php?path=';
               echo $row[9];
//               echo '&title=';
//               echo $row[1];
//               echo '&description=';
//               echo $row[2];
//               echo '&country=';
//               echo $row[11];
//               echo '&city=';
//               echo $row[12];
//               echo '&content=';
//               echo $row[10];
//               echo '&author=';
//               echo $row[8];
//               echo '&favorNum=';
//               echo $row[13];
//
//               $sql = "select * from travelimagefavor where username='$username' and path='$row[9]'";
//               $res = $con->query($sql);
//               if (mysqli_num_rows($res) > 0) {
//                   echo '&favored=true';
//
//               }


               echo '">';

               echo '<img class="res_pic" src="../upfile/';
               echo $row[9];
               echo '">';
               echo '</a>';


               echo '<article class="res_word">';
               echo '<h2>';
               echo $row[1];
               echo '</h2>';

               echo '<p class="resword">';
               echo $row[2];
               echo '</p>';
               echo '</article>';
               echo '</div>';


           }

           echo '<div id="page"> <a href="./search.php?page=';
           echo ($page-1)>0 ? $page-1:1;
           echo '&choice=';
               echo $choice;
               echo '&filter_title=';
               echo $title;
               echo '&filter_description=';
               echo $description;
               echo '" >&lt&lt&nbsp</a>';
           $i = 1;
           for (; $i <= $pageCount; $i = $i + 1) {
               if ($i == $page) {
                   echo '<a style="font-size:40px;color:#00CCCC;"';
               } else {
                   echo '<a ';
               }
               echo 'href="./search.php?page=';
               echo $i;
               echo '&choice=';
               echo $choice;
               echo '&filter_title=';
               echo $title;
               echo '&filter_description=';
               echo $description;
               echo '" > &nbsp' . $i . ' &nbsp</a> ';
           }
           echo '<a href="./search.php?page=';
           echo ($page+1)<=$pageCount ? $page+1:$pageCount;
           echo '&choice=';
           echo $choice;
           echo '&filter_title=';
           echo $title;
           echo '&filter_description=';
           echo $description;
           echo '" > >> </a></div>';
       }
       else{
           echo "<h2>No results</h2>";
       }


       mysqli_free_result($result);
       mysqli_close($con);

   }



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
<!--<script src="../js/search.js"></script>-->