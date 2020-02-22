<?php require_once 'inc/top.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
}

$session_name = $_SESSION['name'];
$session_image = $_SESSION['image'];

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
                            <small class="text-secondary">Computer Science <span class="text-danger">Portal</span>
                            </small>
                            <br>
                            <small class="text-secondary">Evening</small>
                        </h1>
                    </div>
                    <div class="col-md-2">
                        <img class="img-thumbnail rounded-circle" src="img/avatar-6.jpg" alt="" width="100px"
                             height="100px"> <br> paul smith
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
                            <h3 class="text-primary float-left">Pay Carnival Fee</h3>
                        </center>
                        <br> <br>

                        <form action="" method="POST" role="form" enctype="multipart/form-data">
                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="text-primary">Session</label>
                                    <input type="text" name="" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="text-primary">Session</label>
                                    <select class="form-control" name="session" id="session">
                                        <option value="nd1">ND1</option>
                                        <option value="nd2">ND2</option>
                                        <option value="hnd1">HND1</option>
                                        <option value="hnd2">HND2</option>
                                        <?php
                                        $query = $con->prepare('SELECT * FROM categories ORDER BY id DESC');
                                        $query->execute();
                                        if ($query->rowCount() > 0) {
                                            while ($row = $query->fetch()) {
                                                $cat_name = $row['category'];
                                                echo "<option value='" . $cat_name . "' " . ((isset($categories) and $categories === $cat_name) ? 'selected' : '') . '>' . ucfirst($cat_name) . '</option>';
                                            }
                                        } else {
                                            echo '<center><h6>No Category Available</h6></center>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="text-primary">Level</label>
                                    <select class="form-control" name="level" id="level">
                                        <option value="nd1">ND1</option>
                                        <option value="nd2">ND2</option>
                                        <option value="hnd1">HND1</option>
                                        <option value="hnd2">HND2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="text-primary">Payment Type</label>
                                    <select class="form-control" name="payment_type" id="payment_type">
                                        <option value="carnival_fee">Carnival Fee</option>
                                    </select>
                                </div>
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary" value="Procced">
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>


    <?php require_once('inc/footer.php') ?>
