<?php
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Delete the remember_me cookie if it exists
if (isset($_COOKIE["remember_me_key"])) {
    // Overwrite cookie with expired time
    setcookie("remember_me_key", "", time() - 3600, "/");
}

header("Location: http://127.0.0.1/MyProject/SignIn.php");
exit();
?>
<!-- The code above will redirect the user to the login page after signing out -->