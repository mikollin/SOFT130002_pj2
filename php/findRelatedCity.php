<?php
header('Content-Type:application/json; charset=utf-8');

$user = 'root';
$password = 'root';
$db = 'Pj2';
$host = 'localhost';
$port = 3306;
$serve='localhost:3306';
$con = new Mysqli($serve,$user,$password,$db);
$con->query("SET NAMES utf8");//解决中文乱码问题
$country= $_GET["first"];

$sql="select geocountries.CountryName,geocities.AsciiName from geocities inner join geocountries on geocities.CountryCodeISO= geocountries.ISO where geocountries.CountryName='$country' order by geocities.AsciiName ";
$result=$con->query($sql);
while($row=$result->fetch_row()){

        $select[]= array("city"=>$row[1]);
    }
echo json_encode($select);




    ?>