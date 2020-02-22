<?php
ob_start();
session_start();
require_once 'inc/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPass = sha1($password);

    $check_query = $con->prepare('SELECT * FROM users WHERE username = ?');
    $check_query->execute(array($username));

    $row = $check_query->fetch();
    $db_username = $row['username'];
    $db_role = $row['role'];
    $db_author_image = $row['image'];

    if ($check_query->rowCount() > 0) {

        header('Location: index.php'); // Redirect to dashboard page

        $_SESSION['username'] = $db_username;
        $_SESSION['role'] = $db_role;
        $_SESSION['author_image'] = $db_author_image;



    } else {
        $error = 'Wrong Username or Password';
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Login</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="vendor/fontAwesome-4/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="css/login.css" rel="stylesheet" type="text/css" media="screen">
    <link href="css/mdb.min.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>

<div class="signin-form">

    <div class="container">


        <form class="form-signin" method="post" id="login-form" action="<?php echo $_SERVER['PHP_SELF'] ?>">


            <div class="text-center deep-purple-text">
                <h3>
                    <i class="fa fa-lock deep-purple-text"></i> Admin Login:</h3>
                <hr class="mt-2 mb-2">
            </div>

            <div id="error">
                <?php
                if (isset($error)) {
                    echo "<div class='alert alert-danger alert-md'> $error</div>";
                }
                ?>
            </div>

            <div class="md-form">
                <i class="fa fa-envelope prefix grey-text"></i>
                <input type="text" class="form-control  " name="username" id="dpurpleForm-email" required/>
                <label for="dpurpleForm-email">Enter your username</label>
            </div>

            <div class="md-form">
                <i class="fa fa-lock prefix grey-text"></i>
                <input type="password" id="dpurpleForm-pass" name="password" class="form-control" data-toggle="dpurpleForm-pass" required>
                <label for="dpurpleForm-pass">Enter your Password</label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default waves-ripple rounded" name="btn-login" id="btn-login">
                    <span class="fa fa-sign-in"></span> &nbsp; Sign In
                </button>
            </div>
            <div class="modal-footer">
                <div class="options">
                    <p>Forgot
                        <a href="#">Password?</a>
                    </p>
                </div>
            </div>
        </form>

    </div>

</div>






<script type="text/javascript" src="vendor/jquery-3/jquery-3.3.1.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<script type="text/javascript" src="vendor/popper.js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/mdb.min.js"></script>
<script src="vendor/jQuery-Password-Visibility-Toggler-Bootstrap4/bootstrap-password-toggler.min.js"></script>


</body>

</html>
