<?php
require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}

$session_username = $_SESSION['username'];

$query = $con->prepare( "SELECT * FROM users WHERE username = '$session_username'");
$query->execute(array($session_username));

$row = $query->fetch();

$image = $row['image'];
$id = $row['id'];
$date = getdate($row['date']);
$day = $date['mday'];
$month = substr($date['month'],0,3);
$year = $date['year'];
$full_name = $row['full_name'];
$username = $row['username'];
$email = $row['email'];
$role = $row['role'];
$details = $row['details'];
?>
    </head>

    <body>
        <div id="wrapper">
            <?php require_once('inc/header.php'); ?>
            <div class="container-fluid body-section">
                <div class="row">
                    <div class="col-md-3">
                        <?php require_once('inc/sidebar.php'); ?>
                    </div>
                    <div class="col-md-9">
                        <h1 class="text-primary"><i class="fa fa-user"></i> Profile
                            <small class="text-secondary">Personal details</small>
                        </h1>
                        <hr>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard </a>
                                </li>
                                <li class="breadcrumb-item active"><i class="fa fa-user"></i> profile</li>
                            </ol>
                        </nav>

                        <div class="row">
                            <div class="col-12">
                                <center><img src="img/<?php echo $image;?>" width="200px" class="rounded-circle img-thumbnail" id="profile-image"></center>
                                <a href="edit-profile.php?edit=<?php echo $id;?>" class="btn btn-primary pull-right btn-md waves-effect waves-light">Edit
                            Profile</a><br><br>
                                <center>
                                    <h3 class="text-primary">Profile Details</h3>
                                </center>
                                <br>
                                <table class="table table-bordered table-responsive-sm table-striped">
                                    <tr>

                                        <td><b>Signup Date:</b></td>
                                        <td><?php echo "$day $month $year";?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Full Name:</b></td>
                                        <td><?php echo $full_name;?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Username:</b></td>
                                        <td><?php echo $username;?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Role:</b></td>
                                        <td><?php echo $role;?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email:</b></td>
                                        <td><?php echo $email;?></td>
                                    </tr>
                                </table>
                                <div class="row">
                                    <div class="col-lg-8 col-sm-12">
                                        <b>Details:</b>

                                         <div><?php echo $details;?></div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php require_once('inc/footer.php') ?>
