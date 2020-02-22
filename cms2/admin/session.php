<?php require_once 'inc/top.php' ;
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
        $del_query = $con->prepare('DELETE FROM session_year WHERE id = ?');
        $del_query->execute(array($del_id));
        if ($del_query->execute()) {
            $del_msg = 'Session Has Been Deleted';
            header('refresh:2; url=session.php');
        } else {
            $del_error = 'Session Has not Been Deleted';
            header('refresh:2; url=session.php');
        }
    }
}

if (isset($_POST['submit'])) {
    $cat_name = strtolower($_POST['cat-name']);
    if (empty($cat_name)) {
        $error = 'Must Fill This Field';
    } else {
        $check_query = $con->prepare('SELECT * FROM session_year  WHERE year = ?');
        $check_query->execute(array($cat_name));
        if ($check_query->rowCount() > 0) {
            $error = 'Session Already Exist';

        } else {
            $insert_query = $con->prepare("INSERT INTO session_year (year) VALUES ('$cat_name')");
//            $insert_query->execute(array($cat_name));
            if ($insert_query->execute()) {
                $msg = 'Session Has Been Added';
                header('refresh:2; url=session.php');
            } else {
                $error = 'Session Has not Been Added';
                header('refresh:2; url=session.php');
            }
        }
    }
}

if (isset($_POST['update'])) {
    $cat_name = strtolower($_POST['cat-name']);
    if (empty($cat_name)) {
        $up_error = 'Must Fill This Field';
    } else {
        $check_query = $con->prepare('SELECT * FROM session_year WHERE year = ?');
        $check_query->execute(array($cat_name));
        if ($check_query->rowCount() > 0) {
            $up_error = 'Session Already Exist';
        } else {
            $update_query = $con->prepare('UPDATE session_year SET year = ? WHERE id = ?');
            $update_query->execute(array($cat_name,$edit_id));
            if ($update_query->execute()) {
                $up_msg = 'Session Has Been Updated';
                header('refresh:2; url=session.php');
            } else {
                $up_error = 'session Has not Been Updated';
                header('refresh:2; url=session.php');
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

                <?php require_once 'inc/sidebar.php'  ?>

            </div>

            <div class="col-md-9">
                <h1 class="text-primary"><i class="mdi mdi-server-security"></i> Session
                    <small class="text-secondary">Year</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="mdi mdi-server-security"></i>
                            session
                        </li>
                    </ol>
                </nav>


                <div class="row">
                    <div class="col-md-4 mb-4">
                        <form action="" method="post">
                            <div class="md-form ">
                                <i class="mdi mdi-folder prefix"></i>
                                <label for="category">session</label>
                                <?php
                                if (isset($msg)) {
                                    echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                } else if (isset($error)) {
                                    echo "<span class='pull-right' style='color:red;'>$error</span>";
                                }
                                ?>
                                <input type="text" id="category"  class="form-control" name="cat-name">
                            </div>
                            <input type="submit" name="submit" value="Add Year"
                                   class="btn btn-primary btn-md waves-effect waves-light">
                        </form>
                        <?php
                        if (isset($_GET['edit'])) {
                            $edit_check_query = $con->prepare('SELECT * FROM session_year WHERE id = ?');
                            $edit_check_query->execute(array($edit_id));
                            if ($edit_check_query->rowCount() > 0) {

                                $edit_row = $edit_check_query->fetch();
                                $amount = $edit_row['year'];
                                ?>
                                <hr>
                                <form action="" method="post">
                                    <div class="md-form ">
                                        <i class="mdi mdi-folder-edit prefix"></i>
                                        <label for="category">update session</label>
                                        <?php
                                        if (isset($up_msg)) {
                                            echo "<span class='pull-right' style='color:green;'>$up_msg</span>";
                                        } else if (isset($up_error)) {
                                            echo "<span class='pull-right' style='color:red;'>$up_error</span>";
                                        }
                                        ?>
                                        <input type="text" class="form-control"
                                               name="cat-name" value="<?php echo $amount; ?>">
                                    </div>
                                    <input type="submit" name="update" value="Update Year"
                                           class="btn btn-primary btn-md waves-effect waves-light">
                                </form>

                                <?php
                            }
                        }
                        ?>

                    </div>
                    <div class="col-md-8 mb-4 "><br>
                        <?php
                        $get_query = $con->prepare('SELECT * FROM session_year ORDER BY id DESC');
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
                                    <th>Session</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($get_row = $get_query->fetch()) {
                                    $id = $get_row['id'];
                                    $year = $get_row['year'];
                                    ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo ucfirst($year); ?></td>
                                        <td><a href="session.php?edit=<?php echo $id; ?>"><i
                                                    class="btn  btn-info btn-md waves-effect waves-light  btn-sm fa fa-edit"></i></a>
                                        </td>
                                        <td><a href="session.php?del=<?php echo $id; ?>"><i
                                                    class="btn btn-danger btn-md waves-effect waves-light  btn-sm fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            echo '<center><h3>No departmental Fee Found</h3></center>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require_once 'inc/footer.php'  ?>
