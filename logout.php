<?php


//did the users browser send a cookie for the session 
if(isset($_COOKIE[session_name()])){
    //empty the cookie
    setcookie(session_name(),'',time()-86400,'/');
}

//clear session-variables
session_unset();
//destroy session
session_destroy(); 

include('includes/header.php');
?>

<h1>Logged out</h1>

<p class="lead">You've been logged out. See you next time!</p>

<?php
include('includes/footer.php');
?>