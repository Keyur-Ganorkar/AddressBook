<?php
session_start();

include('includes/functions.php');
// connect to database
include('includes/connection_ab.php');
// if login form was submitted
if( isset( $_POST['login'] ) ) {
    
    // create variables
    // wrap data with validate function
    $formEmail = validateFormData( $_POST['email'] );
    $formPass = validateFormData( $_POST['password'] );
    
    // create query
    $query = "SELECT name, password FROM users WHERE email='$formEmail'";
    
    // store the result
    $result = mysqli_query( $conn, $query );
    // var_dump($result);
    // verify if result is returned
    // var_dump(mysqli_fetch_assoc($result));
    if( mysqli_num_rows ($result) > 0 ) {
        
        // store basic user data in variables
        // while( $row = mysqli_fetch_assoc($result) ) {
        //     $name       = $row['name'];
        //     $hashedPass = $row['password'];
        // }
        $row = mysqli_fetch_assoc ($result);
        $name       = $row['name'];
        $hashedPass = $row['password'];
        echo $name;
        echo $hashedPass;
        // echo '<br>'. $formPass .'<br>';
        // echo password_hash('abc123', PASSWORD_DEFAULT);
        // echo '<br>';
        // var_dump(password_verify($formPass, $hashedPass)) ;
        // verify hashed password with submitted password
        if( password_verify( $formPass, $hashedPass ) ) {
            
            // correct login details!
            // store data in SESSION variables
            $_SESSION['loggedInUser'] = $name;
            
            // redirect user to clients page
            header( "Location: clients.php" );
        } else { // hashed password didn't verify
            
            // error message
            $loginError = "<div class='alert alert-danger'>Wrong username / password combination. Try again.</div>";
        }
        
    } else { // there are no results in database
        
        // error message
        $loginError = "<div class='alert alert-danger'>No such user in database. Please try again. <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
    
}else{
    // $formEmail = '';
    // $formPass = '';
}
// Robert change 4

// close mysql connection
// Robert changes 2
if(isset($conn) || !is_null($conn)){
    mysqli_close($conn);
}


include('includes/header.php');

//$password = password_hash("abc123", PASSWORD_DEFAULT);
//echo $password;

?>

<h1>Client Address Book</h1>
<p class="lead">Log in to your account.</p>

<?php 
// Robert changes 3
if(isset($loginError)){
    echo $loginError;
}
?>

<form class="form-inline" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
    <div class="form-group">
        <label for="login-email" class="sr-only">Email</label>
        <input type="text" class="form-control" id="login-email" placeholder="email" name="email" value="<?php echo isset($formEmail) ? $formEmail : ''; ?>">
    </div>
    <div class="form-group">
        <label for="login-password" class="sr-only">Password</label>
        <input type="password" class="form-control" id="login-password" placeholder="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>

<?php
include('includes/footer.php');
?>