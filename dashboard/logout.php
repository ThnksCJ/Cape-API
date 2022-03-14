<?php
require_once ('config.php');

  session_start(); /* Starts the session */
  session_destroy(); /* Destroy started session */

  header("location:login.php");  /* Redirect to login page */
  $log  = "[".date("F j, Y, g:i a")."] User Logged Out Of Admin Panel: | Username: ".$Username.PHP_EOL;
  file_put_contents('../logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
  exit;
