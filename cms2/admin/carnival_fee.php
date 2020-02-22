<?php require_once 'inc/top.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
} else if (isset($_SESSION['username']) && $_SESSION['role'] === 'author') {
    header('Location: index.php');
}

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
}

if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
        $del_query = $con->prepare('DELETE FROM carnival_fee WHERE id = ?');
        $del_query->execute(array($del_id));
        if ($del_query->execute()) {
            $del_msg = 'Carnival Amount Has Been Deleted';
            header('refresh:2; url=carnival_fee.php');
        } else {
            $del_error = 'Carnival Amount Has not Been Deleted';
            header('refresh:2; url=carnival_fee.php');
        }
    }
}

if (isset($_POST['submit'])) {
    $cat_name =  strtolower($_POST['cat-name']);
    if (empty($cat_name)) {
        $error = 'Must Fill This Field';
    } else {
        $check_query = $con->prepare('SELECT * FROM carnival_fee  WHERE amount = ?');
        $check_query->execute(array($cat_name));
        if ($check_query->rowCount() > 0) {
            $error = 'carnival Amount Already Exist';

        } else {
            $insert_query = $con->prepare("INSERT INTO carnival_fee (amount) VALUES ('$cat_name')");
//            $insert_query->execute(array($cat_name));
            if ($insert_query->execute()) {
                $msg = 'carnival Amount Has Been Added';
                header('refresh:2; url=carnival_fee.php');
            } else {
                $error = 'carnival Amount Has not Been Added';
                header('refresh:2; url=carnival_fee.php');
            }
        }
    }
}

if (isset($_POST['update'])) {
    $cat_name =  strtolower($_POST['cat-name']);
    if (empty($cat_name)) {
        $up_error = 'Must Fill This Field';
    } else {
        $check_query = $con->prepare('SELECT * FROM carnival_fee WHERE amount = ? ');
        $check_query->execute(array($cat_name));
        if ($check_query->rowCount() > 0) {
            $up_error = 'carnival Amount Already Exist';
        } else {
            $update_query = $con->prepare('UPDATE carnival_fee SET amount = ? WHERE id = ? ');
            $update_query->execute(array($cat_name,$edit_id));
            if ($update_query->execute()) {
                $up_msg = 'carnival Amount Has Been Updated';
                header('refresh:2; url=carnival_fee.php');
            } else {
                $up_error = 'Category Has not Been Updated';
                header('refresh:2; url=carnival_fee.php');
            }
        }
    }
}
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
                <h1 class="text-primary"><i class="mdi mdi-layers"></i> Carnival Fee
                    <small class="text-secondary">carnival</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="mdi mdi-layers"></i>
                            Carnival Fee
                        </li>
                    </ol>
                </nav>


                <div class="row">
                    <div class="col-md-4 mb-4">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="category">amount</label>
                                <?php
                                if (isset($msg)) {
                                    echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                } else if (isset($error)) {
                                    echo "<span class='pull-right' style='color:red;'>$error</span>";
                                }
                                ?>
                                <input type="text" placeholder="amount" class="form-control" name="cat-name">
                            </div>
                            <input type="submit" name="submit" value="Add amount"
                                   class="btn btn-primary btn-md waves-effect waves-light">
                        </form>
                        <?php
                        if (isset($_GET['edit'])) {
                            $edit_check_query = $con->prepare('SELECT * FROM carnival_fee WHERE id = ?');
                            $edit_check_query->execute(array($edit_id));
                            if ($edit_check_query->rowCount() > 0) {

                                $edit_row = $edit_check_query->fetch();
                                $up_carnival = $edit_row['amount'];
                                ?>
                                <hr>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="category">update carnival amount</label>
                                        <?php
                                        if (isset($up_msg)) {
                                            echo "<span class='pull-right' style='color:green;'>$up_msg</span>";
                                        } else if (isset($up_error)) {
                                            echo "<span class='pull-right' style='color:red;'>$up_error</span>";
                                        }
                                        ?>
                                        <input type="text" placeholder="category name" class="form-control"
                                               name="cat-name" value="<?php echo $up_carnival; ?>">
                                    </div>
                                    <input type="submit" name="update" value="update amount"
                                           class="btn btn-primary btn-md waves-effect waves-light">
                                </form>

                                <?php
                            }
                        }
                        ?>

                    </div>
                    <div class="col-md-8 mb-4 "><br>
                        <?php
                        $get_query = $con->prepare('SELECT * FROM carnival_fee ORDER BY id DESC');
                        $get_query->execute();
                        if ($get_query->rowCount() > 0) {

                            if (isset($del_msg)) {
                                echo "<span class='pull-right' style='color:green;'>$del_msg</span>";

                            } else if (isset($del_error)) {
                                echo "<span class='pull-right' style='color:red;'>$del_error</span>";
                            }
                            ?>

                            <table id="example"
                                   class="text-center table table-hover table-striped table-bordered table-responsive-md">
                                <thead class="bg-dark text-white">
                                <tr>
                                    <th>Sr #</th>
                                    <th>carnival amount</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($get_row = $get_query->fetch()) {
                                    $id = $get_row['id'];
                                    $carnival_amount = $get_row['amount'];
                                    ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td>#<?php echo ucfirst($carnival_amount); ?></td>
                                        <td><a href="carnival_fee.php?edit=<?php echo $id; ?>"><i
                                                    class="btn  btn-info btn-md waves-effect waves-light  btn-sm fa fa-edit"></i></a>
                                        </td>
                                        <td><a href="carnival_fee.php?del=<?php echo $id; ?>"><i
                                                    class="btn btn-danger btn-md waves-effect waves-light  btn-sm fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            echo '<center><h3>No carnival Fee Found</h3></center>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require_once 'inc/footer.php' ?>
