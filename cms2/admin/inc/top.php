<?php
ob_start();
session_start();
require_once 'inc/init.php';

$session_username2 = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome: <?php echo ucfirst($session_username2); ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="vendor/fontAwesome-4/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animated.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/mdb.min.css" rel="stylesheet">

    <link rel="stylesheet" href="vendor/bootstrap-fileinput-master/css/fileinput.css">
    <link rel="stylesheet" href="vendor/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.css">
    <link rel="stylesheet" href="vendor/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <link rel="stylesheet" href="vendor/jquery.selectBoxIt.js/stylesheets/jquery.selectBoxIt.css">

    <link rel="stylesheet" href="vendor/MaterialDesign-Webfont-master/css/materialdesignicons.min.css" type="text/css">
    <link rel="stylesheet" href="vendor/gig/css/gijgo.min.css" type="text/css">