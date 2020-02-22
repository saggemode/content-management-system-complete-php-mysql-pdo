<?php require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}

$session_username = $_SESSION['username'];

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    $edit_query = $con->prepare("SELECT * FROM users WHERE id = $edit_id");
    $edit_query->execute(array($edit_id));
    if($edit_query->rowCount() > 0){
        $edit_row = $edit_query->fetch();

            $e_full_name = $edit_row['full_name'];
            $e_password = $edit_row['password'];
            $e_image = $edit_row['image'];
            $e_details = $edit_row['details'];
    }
    else{
        header('location: index.php');
    }
}
else{
    header("location: index.php");
}
?>


</head>

<body>

<div id="wrapper">

    <?php require_once('inc/header.php') ?>

    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">

                <?php require_once('inc/sidebar.php') ?>

            </div>

            <div class="col-md-9">
                <h1 class="text-primary"><i class="fa fa-user"></i> Edit profile
                    <small class="text-secondary">Edit profile</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-user"></i> Edit profile
                        </li>
                    </ol>
                </nav>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id = $_POST['edit'];
                    $full_name = $_POST['full_name'];
                    $image = $_FILES['image']['name'];
                    $image_tmp = $_FILES['image']['tmp_name'];
                    $details = $_POST['details'];

                    $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
                    if(empty($image)){
                        $image = $e_image;
                    }

                    if(empty($full_name) or empty($details) or empty($image)){
                        $error = "All (*) fields are Required";
                    }
                    else{
                        $update_query = $con->prepare( "UPDATE users SET full_name = ?, image = ?, details = ?, password = ? WHERE id = ?");
                        $update_query->execute(array($full_name,$image,$details,$pass, $id));

                        if($update_query->execute()){
                            $msg = "User Has Been Updated";
                            header("refresh:0; url=edit-profile.php?edit=$edit_id");
                            $path = "img/$image";
                            if(!empty($image)){
                                move_uploaded_file($image_tmp, "img/$image");
                                copy($path, "../$path");
                            }
                        }
                        else{
                            $error = "User Has Not Been Updated";
                        }
                    }
                }
                ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="edit" value="<?php echo $edit_id ?> ">
                                <div class="form-group">
                                    <label for="full_name">Full Name:*</label>
                                    <?php
                                    if(isset($error)){
                                        echo "<span class='pull-right' style='color:red;'>$error</span>";
                                    }
                                    else if(isset($msg)){
                                        echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                    }
                                    ?>

                                    <input type="text" id="full_name" name="full_name" class="form-control"
                                           placeholder="Full Name" value="<?php echo $e_full_name;?>" >
                                </div>

                                <div class="form-group">
                                    <label for="Password">Password:*</label>
                                    <input type="hidden" name="oldpassword" value="<?php echo $e_password; ?>">
                                    <input type="password" id="password" name="newpassword" class="form-control" value=""
                                           placeholder="Leave black if you dont want to change it ">
                                </div>

                                <div class="form-group">
                                    <label for="image">Profile Picture:*</label>
                                    <input type="file" id="image" name="image">
                                </div>

                                <div class="form-group">
                                    <label for="details">Details:*</label>
                                    <textarea name="details" id="details" cols="30" rows="10"
                                              class="form-control"><?php echo $e_details;?></textarea>
                                </div>

                                <input type="submit" value="update User" name="submit" class="btn btn-primary">
                            </form>
                        </div>
                        <div class="col-md-4">
                            <?php
                            echo "<img src='img/$e_image' width='100%'>";
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require_once('inc/footer.php') ?>
