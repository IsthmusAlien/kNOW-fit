<?php
session_destroy();

setcookie('userData', '', time() - 3600, "/", '.wuaze.com');

header("Location: home.html", true, 301);  
exit(); 

?>