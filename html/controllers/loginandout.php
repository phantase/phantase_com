<?php

session_start();

/* Simple encryption and decryption for password */
function encrypt($string){
    return base64_encode(base64_encode(base64_encode($string)));
}
 
function decrypt($string){
    return base64_decode(base64_decode(base64_decode($string)));
}
 
if(isset($_POST['action']) && $_POST['action'] == 'login'){ // Check the action `login`
    $username       = htmlentities($_POST['username']); // Get the username
    $password       = htmlentities($_POST['password']); // Get the password

    if($username == 'phantase' && $password == 'MonPassword'){
        $_SESSION['userid']     = 1;
        $_SESSION['username']   = 'phantase';
        echo 1;
    } else {
        echo 0;
    }
} else if(isset($_POST['action']) && $_POST['action'] == 'logout'){ // Check the action `login`
	if( session_destroy() )
		echo 1;
	else
		echo 0;
}
?>