<?php require_once 'inc/top.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
} else if (isset($_SESSION['username']) && $_SESSION['role'] === 'author') {
    header('Location: index.php');
}
?>


</head>

<body>

<div id="wrapper">

    <?php require_once 'inc/header.php'; ?>

    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">

                <?php require_once 'inc/sidebar.php'; ?>

            </div>

            <div class="col-md-9">
                <h1 class="text-primary"><i class="fa fa-user-plus"></i> Add new user
                    <small class="text-secondary">users</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-user-plus"></i> Users
                        </li>
                    </ol>
                </nav>

                <?php
                if (isset($_POST['submit'])) {
                    $full_name = $_POST['full_name'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $username_trim = preg_replace('/\s+/', '', $username);
                    $password = $_POST['password'];
                    $role = $_POST['role'];
                    $image = $_FILES['image']['name'];
                    $image_tmp = $_FILES['image']['tmp_name'];

                   $check_query = $con->prepare("SELECT * FROM users WHERE username = '$username' or email = '$email'");
                    $check_query->execute();
                    $hashpass = sha1($password);

                    if (empty($full_name) || empty($username) || empty($email) || empty($image)) {
                        $error = 'All (*) fields are Required';
                    } else if ($username !== $username_trim) {
                        $error = 'Don\'t Use spaces in Username';
                    }

//                   $check = checkItem("username", "users",$username);

                    else if ($check_query->rowCount() > 0) {
                        $error = 'Username or Email Already Exist';
                        $theMsg = '<div class="alert alert-danger">Sorry This User is Exist</div>';
                    } else {



                        $insert_query = $con->prepare("INSERT INTO 
                                                   users (date, full_name, username, email, password , role, image) 
                                                   VALUES (now(), :zfull_name, :zusername, :zemail, :zpassword, :zrole,:zimage)");
                        $insert_query->execute(array(
                            'zfull_name'  => $full_name,
                            'zusername'   => $username,
                            'zemail'      => $email,
                            'zpassword'   => $hashpass,
                            'zrole'       => $role,
                            'zimage'     => $image

                        ));

                            $msg = 'User Has Been Added';
                            move_uploaded_file($image_tmp, "img/$image");
                            $image_check = $con->prepare('SELECT * FROM users ORDER BY id DESC LIMIT 1') ;
                            $image_check->execute();
                            $image_row = $image_check->fetch();
                            $check_image = $image_row['image'];

                            $full_name = '';
                            $email = '';
                            $username= '';
                    }
                }
                ?>
                <div class="row">
                    <div class="col-md-8">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="full_name">Full Name:*</label>
                                <?php
                                if (isset($error)) {
                                    echo "<span class='pull-right' style='color:red;'>$error</span>";
                                } else if (isset($msg)) {
                                    echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                }
                                ?>
                                <input type="text" id="full_name" name="full_name" class="form-control"
                                       value="<?php if (isset($full_name)) {
                                           echo $full_name;
                                       } ?>" placeholder="Full Name">
                            </div>

                            <div class="form-group">
                                <label for="username">Username:*</label>
                                <input type="text" id="username" name="username" class="form-control"
                                       value="<?php if (isset($username)) {
                                           echo $username;
                                       } ?>" placeholder="Username">
                            </div>

                            <div class="form-group">
                                <label for="email">Email:*</label>
                                <input type="text" id="email" name="email" class="form-control"
                                       value="<?php if (isset($email)) {
                                           echo $email;
                                       } ?>" placeholder="Email Address">
                            </div>

                            <div class="form-group">
                                <label for="Password">Password:*</label>
                                <input type="password" id="password" name="password" class="form-control"
                                       placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label for="role">Role:*</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="author">Author</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Profile Picture:*</label>
                                <input type="file" id="image" name="image" required>
                            </div>

                            <input type="submit" value="Add User" name="submit"
                                   class="btn btn-primary btn-md waves-effect waves-light">
                        </form>
                    </div>
                    <div class="col-md-4">
                        <?php
                        if (isset($check_image)) {
                            echo "<img src='img/$check_image' width='100%'>";
                        }
                        ?>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <?php require_once 'inc/footer.php'; ?>
