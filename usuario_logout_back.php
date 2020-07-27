<?php
   
   session_start();
   
   session_destroy();
   
   header("location: usuario_login_back.php");   
   
?>
