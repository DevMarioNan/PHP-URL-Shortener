<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to the sign-in page or homepage
header("Location: home.php");
exit();
?>