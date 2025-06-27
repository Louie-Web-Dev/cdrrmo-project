<?php
session_start();
session_regenerate_id(true); // Regenerate session ID to help prevent session fixation
session_destroy();
header("Location: /cdrrmo-project/login.php");
?>
