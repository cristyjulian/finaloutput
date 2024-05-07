<?php
$host= "localhost";
$username = "root";
$password = "";
$database = "finaloutput";
$connection = new mysqli($host,$username,$password,$database);
$conn = new mysqli($host,$username,$password,$database);
if($connection->connect_error){ die("connection failed".$connection->connect_error); }
?>
