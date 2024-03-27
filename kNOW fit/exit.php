<?php

session_destroy();

header("Location: home.html", true, 301);  
exit(); 

?>