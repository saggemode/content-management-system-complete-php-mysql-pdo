<?php include 'inc/top.php'; ?>
<?php

if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
else if(isset($_SESSION['username']) && $_SESSION['role'] === 'author'){
    header('Location: index.php');
}

if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $del_query = $con->prepare('DELETE FROM users WHERE id = :zid');
    $del_query->execute(array('zid' => $del_id));

    if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
        if ($del_query->execute()) {
            $msg = 'User Has Been Deleted';
            header('refresh:2; url=users.php');
        } else {
            $error = 'User Has Not Been Deleted';
            header('refresh:2; url=users.php');
        }
    }
}


if(isset($_POST['checkboxes'])){

    foreach($_POST['checkboxes'] as $user_id){

        $bulk_option = $_POST['bulk-options'];

        if($bulk_option === 'delete'){
            $bulk_delete_query = $con->prepare('DELETE FROM users WHERE id = ?');
            $bulk_delete_query->execute(array($user_id));
        }
        else if($bulk_option === 'author'){
            $bulk_author_query = $con->prepare("UPDATE users SET role = 'author' WHERE id = $user_id") ;
            $bulk_author_query->execute(array($user_id));
        }
        else if($bulk_option == 'admin'){
            $bulk_admin_query = $con->prepare("UPDATE users SET role = 'admin' WHERE id = $user_id") ;
            $bulk_admin_query->execute(array($user_id));
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
                <h1 class="text-primary"><i class="fa fa-users"></i> users
                    <small class="text-secondary">view all users</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-users"></i> Users</li>
                    </ol>
                </nav>

                <?php
                $stmt = $con->prepare('SELECT * FROM users ORDER BY id DESC');
                $stmt->execute();

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
                                            <option value="author">change to author</option>
                                            <option value="admin">change to admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="submit" value="Apply"
                                           class="btn btn-success btn-md waves-effect waves-light">
                                    <a href="add-user.php" class="btn btn-primary btn-md waves-effect waves-light">Add
                                        new</a>
                                </div>
                            </div>

                        </div>
                    </div>


                    <table class="table table-bordered text-center table-responsive-md" id="example" width="100%"
                           cellspacing="0">
                        <?php
                        if (isset($error)) {
                            echo "<div class='alert alert-success'><i class='fa fa-user'></i> $error</div>";
                        } elseif (isset($msg)) {
                            echo "<div class='alert alert-success'><i class='fa fa-user'></i> $msg</div>";
                        }
                        ?>
                        <thead class="bg-dark text-white">
                        <tr>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Sr #</th>
                            <th>Date</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $stmt->fetch()) {
                            $id = $row['id'];
                            $fullname = ucfirst($row['full_name']);
                            $email = $row['email'];
                            $username = $row['username'];
                            $role = ucfirst($row['role']);
                            $image = $row['image'];
                            $date = getdate($row['date']);
                            $day = $date['mday'];
                            $month = substr($date['month'], 0, 3);
                            $year = $date['year'];
                            ?>
                            <tr>
                                <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo "$day $month $year"; ?></td>
                                <td><?php echo $fullname ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><img src="img/<?php echo $image; ?>" width="50px"></td>
                                <td><?php echo $role; ?></td>
                                <td>
                                    <a href="edit-user.php?edit=<?php echo $id; ?>"><i
                                                class="fa fa-edit btn btn-success btn-sm"></i></a>
                                    <a href="users.php?del=<?php echo $id; ?>"><i
                                                class="fa fa-trash  btn btn-danger btn-sm"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>

                    </table>
                    <?php
                    } else {
                        echo "<h2 class='text-center'>No Users Available</h2>";
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>

    <?php require_once('inc/footer.php') ?>
