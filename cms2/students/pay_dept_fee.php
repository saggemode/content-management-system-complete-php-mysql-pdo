<?php require_once 'inc/top.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
}

$session_email = $_SESSION['email'];
$session_name = $_SESSION['name'];
$session_regid = $_SESSION['regid'];
$session_program = $_SESSION['program'];
$session_image = $_SESSION['image'];
$session_phone = $_SESSION['phone'];

?>

</head>

<body>

    <div id="wrapper">

        <?php require_once 'inc/header.php' ?>

        <div class="container-fluid body-section">
            <div class="row">
                <div class="col-md-3">

                    <?php require_once 'inc/sidebar.php'; ?>

                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-10">
                            <h1 class="text-primary"><i class="fa fa-user"></i>
                                <small class="text-secondary">Computer Science <span class="text-danger">Portal</span>
                                </small>
                                <br>
                                <small class="text-secondary"><?php echo ucfirst($session_program); ?> : PROGRAM</small>
                            </h1>
                        </div>
                        <div class="col-md-2">
                            <img class="img-thumbnail rounded-circle" src="img/<?php echo $session_image; ?>" alt=""
                                 width="100px" height="100px"> <br>
                            <strong><?php echo $session_name; ?></strong> <br>
                            <span>ID: <strong class="text-info"><?php echo $session_regid; ?></strong></span>
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
                            <div class="col-sm-6">
                                <h3 class="text-primary float-left">Pay Department Fee</h3>
                            </div> <br> <br>

                            <?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $confirm = $_POST['confirm'];
                                $check_query = $con->prepare('SELECT * FROM department_invoice WHERE confirmation_code = ?');
                                $check_query->execute(array($confirm));


                                if ($check_query->rowCount() > 0) {
                                    header('location: department_receipt.php');
                                }else{
                                    $error = 'confirmation number does not exist';
                                }
                            }
                            ?>

                            <form action="" method="POST" role="form" enctype="multipart/form-data">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php
                                        if (isset($error)) {
                                            echo "<div class='alert alert-danger'>$error</div>";
                                        }
                                        ?>
                                        <label for="status" class="text-primary">Confirmation Number</label>
                                        <input type="text" name="confirm" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <input type="submit" name="submit" class="btn btn-success btn-block" value="Procced">
                                </div>
                            </form>

                        </div>
                    </div>


                </div>
            </div>
        </div>


        <?php require_once('inc/footer.php') ?>
