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

    <?php require_once('inc/header.php') ?>

    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">

                <?php require_once('inc/sidebar.php'); ?>

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
                            <h3 class="text-primary float-left">View All the Payments</h3>
                        </div>
                        <br> <br>


                        <table id="example" class="table table-striped table-bordered table-hover " style="width:100%">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Reg No</th>
                                <th>Fee</th>
                                <th>Semester</th>
                                <th>Level</th>
                                <th>Amount</th>
                                <th>Session</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>15eh/0001/cs</td>
                                <td>department fee</td>
                                <td>first</td>
                                <td>ND1</td>
                                <td>500</td>
                                <td>2017/2018</td>
                                <td>2016-11-04</td>
                                <td><span class="btn btn-sm btn-success">view receipt</span></td>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>15eh/0001/cs</td>
                                <td>carnival fee</td>
                                <td>first</td>
                                <td>HND1</td>
                                <td>500</td>
                                <td>2017/2018</td>
                                <td>2017-11-04</td>
                                <td><span class="btn btn-sm btn-success">view receipt</span></td>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>19eh/0001/cs</td>
                                <td>T shirt fee</td>
                                <td>second</td>
                                <td>HND2</td>
                                <td>2000</td>
                                <td>2017/2018</td>
                                <td>2018-11-04</td>
                                <td><span class="btn btn-sm btn-success">view receipt</span></td>
                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Reg No</th>
                                <th>Fee</th>
                                <th>Semester</th>
                                <th>Level</th>
                                <th>Amout</th>
                                <th>Session</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>


            </div>
        </div>
    </div>


    <?php require_once('inc/footer.php') ?>
