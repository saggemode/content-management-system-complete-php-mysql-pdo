
<?php require_once('inc/top.php');

if(!isset($_SESSION['email'])){
    header('Location: login.php');
}

$session_email = $_SESSION['email'];
$session_name = $_SESSION['name'];
$session_regid = $_SESSION['regid'];
$session_program = $_SESSION['program'];
$session_image = $_SESSION['image'];

$query = $con->prepare( "SELECT * FROM student_table WHERE email = '$session_email'");
$query->execute(array($session_email));

$row = $query->fetch();

$id = $row['id'];
$regno = $row['regno'];
$name = $row['name'];
$email = $row['email'];
$gender = $row['gender'];
$level = $row['level'];
$dob = $row['dob'];
$phone = $row['phone'];
$image = $row['image'];
$program = $row['program'];
$regid = $row['regid'];

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
                <div class="row">
                    <div class="col-md-10">
                         <h1 class="text-primary"><i class="fa fa-user"></i> 
                    <small class="text-secondary">Computer Science <span class="text-danger">Portal</span></small> <br>
                    <small class="text-secondary"><?php echo ucfirst($program); ?> : PROGRAM</small>
                </h1>
                    </div>
                    <div class="col-md-2">
                        <img class="img-thumbnail rounded-circle" src="img/<?php echo  $image; ?>" alt="" width="100px" height="100px"> <br>
                         <strong><?php echo $session_name; ?></strong> <br>
                         <span>ID: <strong class="text-info" ><?php echo $regid; ?></strong></span>
                    </div> 
                </div>
                
                <hr>
                
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-user-md"></i> Profile
                        </li>
                    </ol>
                </nav>
                
                  <div class="row">
                            <div class="col-12">
                                <center>
                                    <h3 class="text-primary">Profile Details</h3>
                                    <a href="edit-profile.php?edit=<?php echo $id;?>" class="btn btn-primary pull-right btn-md waves-effect waves-light">Edit
                                        Profile</a><br><br>
                                </center>
                                <br>
                                <table class="table table-bordered table-responsive-sm table-striped">
                                    <tr>

                                        <td><b>Registration Number:</b></td>
                                        <td>
                                            <?php echo $regno;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Full Name:</b></td>
                                        <td>
                                            <?php echo $name;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone Number:</b></td>
                                        <td>
                                            <?php echo $phone;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Date Of Birth:</b></td>
                                        <td>
                                            <?php echo $dob;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Email:</b></td>
                                        <td>
                                            <?php echo $email;?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td><b>Gender:</b></td>
                                        <td>
                                            <?php echo $gender;?>
                                        </td>
                                    </tr>
                                    
                                     <tr>
                                        <td><b>Level:</b></td>
                                        <td>
                                            <?php echo $level;?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                
            </div>
        </div>
    </div>


    <?php require_once('inc/footer.php') ?>
