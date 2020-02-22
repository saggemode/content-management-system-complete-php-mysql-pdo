<?php include 'inc/top.php' ?>

<?php

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$session_username = $_SESSION['username'];


if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    if ($_SESSION['role'] == 'admin') {
        $del_check_query = $con->prepare('SELECT * FROM carnival_invoice WHERE id = :zid');
        $del_check_query->execute(array('zid' => $del_id));
    } else if ($_SESSION['role'] == 'author') {
        $del_check_query = $con->prepare("SELECT * FROM posts WHERE id = $del_id and author = ?");
        $del_check_query->execute(array($session_username));
    }
    if ($del_check_query->rowCount() > 0) {
        $del_query = $con->prepare('DELETE FROM carnival_invoice WHERE id = :zid');
        $del_query->execute(array('zid' => $del_id));
        if ($del_query->execute()) {
            $msg = 'invoice Has Been Deleted';
            header('refresh:2; url=carnival.php');
        } else {
            $error = 'invoice Has Not Been Deleted';
            header('refresh:2; url=carnival.php');
        }
    } else {
        header('location: index.php');
    }
}

if (isset($_POST['checkboxes'])) {

    foreach ($_POST['checkboxes'] as $user_id) {

        $bulk_option = $_POST['bulk-options'];

        if ($bulk_option === 'delete') {
            $bulk_delete_query = $con->prepare('DELETE FROM carnival_invoice WHERE id = ? ');
            $bulk_delete_query->execute(array($user_id));
        } else if ($bulk_option === 'publish') {
            $bulk_author_query = $con->prepare("UPDATE posts SET status = 'publish' WHERE id = $user_id");
            $bulk_author_query->execute(array($user_id));
        } else if ($bulk_option === 'draft') {
            $bulk_admin_query = $con->prepare("UPDATE posts SET status = 'draft' WHERE id = $user_id");
            $bulk_admin_query->execute(array($user_id));
        }

    }

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
                <h1 class="text-primary"><i class="mdi mdi-layers"></i> Carnival Payment
                    <small class="text-secondary">view all carnival payment</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="mdi mdi-layers"></i> carnival payment</li>
                    </ol>
                </nav>


                <?php
                if ($_SESSION['role'] === 'admin') {
                    $stmt = $con->prepare('SELECT * FROM carnival_invoice ORDER BY id DESC');
                    $stmt->execute();
                }
                if ($stmt->rowCount() > 0) {
                ?>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <select name="bulk-options" id="" class="form-control">
                                            <option value="delete">Delete</option>
<!--                                            <option value="author">change to author</option>-->
<!--                                            <option value="admin">change to admin</option>-->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8">
                                     <input type="submit" value="Apply" class="btn mb-4 btn-success btn-md waves-effect waves-light">
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php
                    if (isset($error)) {
                        echo "<span style='color:red;' class='pull-right'>$error</span>";
                    } else if (isset($msg)) {
                        echo "<span style='color:green;' class='pull-right'>$msg</span>";
                    }
                    ?>

                     <table class="table table-bordered text-center table-responsive-md" id="example" width="100%" cellspacing="0">
                        <thead class="bg-dark text-white">
                        <tr>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Sr #</th>
                            <th>Date</th>
                            <th>Full Name</th>
                            <th>Session</th>
                            <th>Level</th>
                            <th>Program</th>
                            <th>Registration id</th>
                            <th>invoice no</th>
                            <th>confirmation code</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $stmt->fetch()) {
                        $id = $row['id'];
                        $date = $row['date'];
                        $name = $row['name'];
                        $session = $row['session'];
                        $level = $row['level'];
                        $program = $row['program'];
                        $regid = $row['regid'];
                        $invoice_no = $row['invoice_no'];
                        $confirmation_code = $row['confirmation_code'];

                        ?>
                            <tr>
                                <td><input type="checkbox" class="checkboxes" name="checkboxes[]"
                                           value="<?php echo $id; ?>"></td>

                                <td><?php echo $id; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $session; ?></td>
                                <td><?php echo $level; ?></td>
                                <td><?php echo $program; ?></td>
                                <td><?php echo $regid; ?></td>
                                <td><?php echo $invoice_no; ?></td>
                                <td><?php echo $confirmation_code; ?></td>

                        <?php } ?>
                        </tbody>
                    </table>


                    <?php
                    } else {
                        echo "<h2 class='text-center'>No carnival invoice Available</h2>";
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>

    <?php require_once 'inc/footer.php' ?>
