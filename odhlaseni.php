<?php
  session_start();
  unset($_SESSION["uzivatel"]);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>