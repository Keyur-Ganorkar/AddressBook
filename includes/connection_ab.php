<?php
$server= "localhost";
$username="root";
$password="";
$db ="db_clientaddressbook";
// i didnt add password because if i add it must contain some
//create connection
$conn= mysqli_connect($server,$username,$password,$db);

//check connection
if (!$conn) {
    die("connection failed".mysqli_connect_error());
}
else {
    //echo "connected successfully";
}

?>