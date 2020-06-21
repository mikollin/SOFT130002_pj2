<?php
session_start();
//echo $_SESSION['username'];
if(isset($_SESSION['username'])):
    ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">



 

    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css"/>
    <script src="../jquery-1.10.2/jquery-1.10.2.js"></script>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <script src="../bootstrapValidator/js/bootstrapValidator.min.js"></script>
    <link href="../bootstrapValidator/css/bootstrapValidator.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/upload.css" />
<title>my_pj_上传</title>







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

<div id="uploadcontent">


   <div class="up_til">UPLOAD</div>

    <form action="../php/upload.php" method="POST" name="to_upload" enctype="multipart/form-data">
                   <div id="up_pic">


                   <div id="up_line">the picture hasn't been uploaded</div>

<br>
                   <img id="ready_to_up_pics" src="" name="pics" alt=" hasn't been uploaded..."/>
<br>
                   <!--<input id="up_trigger" type="button" value="Upload" onclick="show()" required>
                   -->
                   <!--<input id="up_button" name="upload_pics" accept="*/gif,*/jpeg,*/jpg,*/png"  type="file" onchange="previewFile()" >
                   -->

                       <div class="form-group">
                           <input class="form-control" id="up_button" name="upload_pics" accept="*/gif,*/jpeg,*/jpg,*/png"  type="file" onchange="previewFile()" required>
                       </div>



                   <!--<script>
                   function show(){
                       	document.getElementById("up_button").style.display="block";
                      	document.getElementById("up_line").style.display="none";
	
                        }
                   </script>-->


<br>

                   <script>
                   function previewFile() {
                         document.getElementById("up_line").style.display="none";
                       	 var preview = document.getElementById('ready_to_up_pics');
                       	 var file  = document.getElementById('up_button').files[0];
                         var reader = new FileReader();
                         if (file) {
                              reader.readAsDataURL(file);
                              } 
                         else {
                              preview.src = "";
                              }
                         reader.onloadend = function () {
                         preview.src = reader.result;
                          }
                         }
                   //将文件内容读入内存，读取操作完成时，设置图片src为读取文件结果，如果文件成功获取用data:url的字符串形式表示来读取文件，否则不设置src
                   </script>
                   </div>


<br>


        
                   <div id="up_descp">


                           <div class="form-group">
                               <label>Picture's Title</label>
                               <input class="form-control" name="upload_pic_title" type="text"  required>
                           </div>

                           <div class="form-group">
                               <label>Picture's Description</label>
                               <textarea class="form-control" name="upload_pic_description" cols="6" type="text"  required></textarea>
                           </div>


                           <div class="form-group">
                               <label>Shooting Country</label>
                               <!--<input class="form-control" name="upload_pic_country" type="text"  required> -->
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
                                   $con->query("SET NAMES utf8");


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
                           </div>

                           <div class="form-group">
                               <label>Shooting City</label>
                              <!-- <input class="form-control" name="upload_pic_city" type="text"  required> -->
                               <select id="second" class="form-control" name="upload_pic_city" required>
                                   <option selected="selected" value=""disabled selected hidden >CITY</option>
                               </select>
                           </div>

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

                               // $.ajaxSetup({
                               //     error: function (x, e) {
                               //         alert(e);
                               //     }
                               // });

                           }


                       </script>




                       <div class="form-group">
                           <label>Shooting Theme</label>
                             <select  class="form-control" name="upload_pic_theme" required>
                               <option selected="selected" value=""disabled selected hidden>CONTENT</option>
                                 <option>Building</option>
                                 <option>Wonder</option>
                                 <option>Scenery</option>
                                 <option>City</option>
                                 <option>People</option>
                                 <option>Animal</option>
                                 <option>Other</option>
                           </select>
                       </div>


                           <div class="form-group">
                               <button type="submit" id="upload_submit" name="register_submit" class="btn btn-primary">Upload</button>
                               <!--因为插件用的是jquery的submit 方法，不能用name="submit" 属性-->
                           </div>



                   </div>
   </form>

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

<script src="../js/upload.js"></script>
<script src="../js/modify.js"></script>
<script defer>
   <?php
            if($_GET['cityCode']!=''&&$_GET['countryCode']!='')
            {
                $cityCode=$_GET['cityCode'];
                $countryCode=$_GET['countryCode'];

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

   function getQueryVariable(variable)
   {
       let query = window.location.search.substring(1);
       let vars = query.split("&");
       for (let i=0;i<vars.length;i++) {
           let pair = vars[i].split("=");
           if(pair[0] == variable){return pair[1];}
       }
       return(false);
   }
   let mcountrycode=getQueryVariable('countryCode');
   let mcityCode=getQueryVariable('cityCode');

   if(mcountrycode!=false&&mcityCode!=false) {

       let country = document.getElementById('first');
       let city = document.getElementById('second');

       for (let i = 0; i < <?php echo $count; ?>; i++) {
           if (country.options[i].value == "<?php echo $country; ?>") {
               country.options[i].selected = true;
               break;
           }

       }
       city.options.length = 1; // 清除second下拉框的所有内容

       $.getJSON("../php/findRelatedCity.php", {first: $("#first").val()}, function (json) {

           $.each(json, function (index, array) {

               //var option = "<option value='"+array['id']+"'>"+array['title']+"</option>";
               city.options.add(new Option(array['city'], array['city']));
           });


           for (let i = 0; i < city.options.length; i++) {
               if (city.options[i].innerText == "<?php echo $city; ?>") {
                   city.options[i].selected = true;
                   break;
               }

           }
       });

   }

</script>



<?php else:
    echo 'Please log in first!';
    echo "<script>window.location.href='login.html'</script>";
?>
<?php endif ?>
