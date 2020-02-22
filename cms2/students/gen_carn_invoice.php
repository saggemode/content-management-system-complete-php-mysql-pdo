<?php require_once 'inc/top.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
}

$session_email = $_SESSION['email'];
$session_name = $_SESSION['name'];
$session_regid = $_SESSION['regid'];
$session_program = $_SESSION['program'];
$session_image = $_SESSION['image'];

?>


</head>

<body>

<div id="wrapper">

    <?php require_once 'inc/header.php' ?>

    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">

                <?php require_once 'inc/sidebar.php' ?>

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
                            <h3 class="text-primary float-left">Generate Carnival Invoice </h3>
                        </div>

                        <br> <br>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $session = $_POST['session'];
                            $level = $_POST['level'];
                            $payment_type = $_POST['payment_type'];
                            $chars_invoice = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                            $chars_confirm_code = '0123456789';
                            $invoice = substr(str_shuffle($chars_invoice), 0, 8);
                            $confirmation_code = substr(str_shuffle($chars_confirm_code), 0, 8);


                            $check_query = $con->prepare('SELECT * FROM carnival_invoice WHERE invoice_no = ?');
                            $check_query->execute(array($invoice));

                            if ($check_query->rowCount() > 0) {
                                $error = 'This Invoice number  is already registered please logout and login again to proceed';
                            } else {
                                $insert_query = $con->prepare('INSERT INTO carnival_invoice (date,name, session,level, payment, program, regid, carnival_fee, invoice_no,confirmation_code)
                                                                              VALUES      
                                                                                         (now(),:zname,:zsession,:zlevel,:zpayment,:zprogram, :zregid, :zfee, :zinvoice_no, :zconfirm)');

                                $insert_query->execute(array(
                                    'zname' => $session_name,
                                    'zsession' => $session,
                                    'zlevel' => $level,
                                    'zpayment' => $payment_type,
                                    'zprogram' => $session_program,
                                    'zregid' => $session_regid,
                                    'zfee' => 'carnival fee',
                                    'zinvoice_no' => $invoice,
                                    'zconfirm' => $confirmation_code

                                ));

                                $msg = ' Invoice Generated';
                                header('location: carnival_invoice.php');

                            }

                        }

                        ?>
                        <form action="" method="POST" role="form" enctype="multipart/form-data">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php
                                    if (isset($error)) {
                                        echo "<div class='alert alert-info'>$error</div>";
                                    } elseif (isset($msg)) {
                                        echo "<div class='alert alert-success'> $msg</div>";
                                    }
                                    ?>
                                    <label for="status" class="text-primary">Session</label>
                                    <select class="form-control" name="session" id="session">
                                        <?php
                                        $query = $con->prepare('SELECT * FROM session_year ORDER BY id DESC');
                                        $query->execute();
                                        if ($query->rowCount() > 0) {
                                            while ($row = $query->fetch()) {
                                                $cat_year = $row['year'];
                                                echo "<option value='" . $cat_year . "' " . ((isset($session_year) and $year === $cat_year) ? 'selected' : '') . '>' . ucfirst($cat_year) . '</option>';
                                            }
                                        } else {
                                            echo '<center><h6>No Session Available</h6></center>';
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
                                    <label for="status" class="text-primary">Payment Amount</label>
                                    <select class="form-control" name="payment_type" id="payment_type">
                                        <?php
                                        $query = $con->prepare('SELECT * FROM carnival_fee ORDER BY id DESC');
                                        $query->execute();
                                        if ($query->rowCount() > 0) {
                                            while ($row = $query->fetch()) {
                                                $cat_year = $row['amount'];
                                                echo "<option value='" . $cat_year . "' " . ((isset($carnival_fee) and $carnival_fee === $cat_year) ? 'selected' : '') . '>' . ucfirst($cat_year) . '</option>';
                                            }
                                        } else {
                                            echo '<center><h6>No Session Available</h6></center>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="submit" name="submit" class="btn btn-success btn-block" value="Proceed">
                            </div>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>


    <?php require_once('inc/footer.php') ?>
