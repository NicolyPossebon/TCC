<?php
   //inicio da session;
   session_start();
   
   //destroi todas as sessions, assim o usuário não pode acessar mais nada;
   session_destroy();
   
   //redireciona;
   header("location: usuario_login_back.php");   
   
?>