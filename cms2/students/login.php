<?php
ob_start();
session_start();
require_once 'inc/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPass = sha1($password);

    $check_query = $con->prepare('SELECT * FROM student_table WHERE email = ? and password = ?');
    $check_query->execute(array($email, $hashedPass));

    $row = $check_query->fetch();

    $db_name = $row['name'];
    $db_email = $row['email'];
    $db_image = $row['image'];
    $db_regid = $row['regid'];
    $db_program = $row['program'];
    $db_phone = $row['phone'];

    if ($check_query->rowCount() > 0) {
        $_SESSION ['email'] = $db_email;
        $_SESSION['name'] = $db_name;
        $_SESSION['regid'] = $db_regid;
        $_SESSION['image'] = $db_image;
        $_SESSION['program'] = $db_program;
        $_SESSION['phone'] = $db_phone;

        header('Location: index.php'); // Redirect to dashboard page
        exit();
    } else {
        $error = 'Wrong email or Password';
    }

}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Student Login</title>
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
                            <i class="fa fa-lock deep-purple-text"></i> Student Login:</h3>
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
                        <input type="email" class="form-control  " name="email" id="dpurpleForm-email" required/>
                        <label for="dpurpleForm-email">Your email</label>
                    </div>

                    <div class="md-form">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="dpurpleForm-pass" name="password" class="form-control" data-toggle="dpurpleForm-pass" required>
                        <label for="dpurpleForm-pass">Your password</label>
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
