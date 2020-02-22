<?php

ob_start();
session_start();
header('Location: login.php');
session_destroy();
ob_flush();
?>
