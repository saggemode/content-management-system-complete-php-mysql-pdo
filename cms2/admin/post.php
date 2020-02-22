<?php include 'inc/top.php' ?>

<?php

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$session_username = $_SESSION['username'];


if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    if ($_SESSION['role'] == 'admin') {
        $del_check_query = $con->prepare('SELECT * FROM posts WHERE id = :zid');
        $del_check_query->execute(array('zid' => $del_id));
    } else if ($_SESSION['role'] == 'author') {
        $del_check_query = $con->prepare("SELECT * FROM posts WHERE id = $del_id and author = ?");
        $del_check_query->execute(array($session_username));
    }
    if ($del_check_query->rowCount() > 0) {
        $del_query = $con->prepare('DELETE FROM posts WHERE id = :zid');
        $del_query->execute(array('zid' => $del_id));
        if ($del_query->execute()) {
            $msg = 'post Has Been Deleted';
            header('refresh:2; url=post.php');
        } else {
            $error = 'postHas Not Been Deleted';
            header('refresh:2; url=post.php');
        }
    } else {
        header('location: index.php');
    }
}

if (isset($_POST['checkboxes'])) {

    foreach ($_POST['checkboxes'] as $user_id) {

        $bulk_option = $_POST['bulk-options'];

        if ($bulk_option === 'delete') {
            $bulk_delete_query = $con->prepare('DELETE FROM posts WHERE id = ? ');
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

    <?php include 'inc/header.php'; ?>

    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">

                <?php require_once 'inc/sidebar.php'; ?>

            </div>

            <div class="col-md-9">
                <h1 class="text-primary"><i class="fa fa-file"></i> Posts
                    <small class="text-secondary">view all post</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-file"></i> Posts</li>
                    </ol>
                </nav>

                <?php
                if ($_SESSION['role'] === 'admin') {
                    $stmt = $con->prepare('SELECT * FROM posts ORDER BY id DESC');
                    $stmt->execute();
                } elseif ($_SESSION['role'] === 'author') {
                    $stmt = $con->prepare("SELECT * FROM posts WHERE author = '$session_username' ORDER BY id DESC");
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
                                            <option value="publish">Publish</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <input type="submit" value="Apply"
                                           class="btn btn-success btn-md waves-effect waves-light">
                                    <a href="add-post.php" class="btn btn-primary btn-md waves-effect waves-light">Add
                                        new</a>
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
                    <table id="example" class=" table table-hover table-striped table-bordered table-responsive-md">
                        <thead class="bg-dark text-white">
                        <tr>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>image</th>
                            <th>Category</th>
                            <th><i class="fa fa-eye"></i> Views</th>
                            <th>Status</th>
                            <th>Controls</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $stmt->fetch()) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $author = $row['author'];
                            $views = $row['views'];
                            $categories = $row['categories'];
                            $image = $row['image'];
                            $status = $row['status'];
                            $date = getdate($row['date']);
                            $day = $date['mday'];
                            $month = substr($date['month'], 0, 3);
                            $year = $date['year'];
                            ?>
                            <tr>
                                <td><input type="checkbox" class="checkboxes" name="checkboxes[]"
                                           value="<?php echo $id; ?>"></td>

                                <td><?php echo "$day $month $year"; ?></td>
                                <td><?php echo "$title"; ?></td>
                                <td><?php echo $author; ?></td>
                                <td><img src="../img/<?php echo $image; ?>" width="50px" height="20px"></td>
                                <td><?php echo $categories; ?></td>
                                <td><?php echo $views; ?></td>

                                <td>
                                    <?php
                                    if ($status === 'publish') {
                                        echo '<span class="badge badge-primary">';
                                    } else if ($status === 'draft') {
                                        echo '<span class="badge badge-danger">';
                                    }
                                    ?><?php echo ucfirst($status); ?>
                                </td>

                                <td>
                                    <a href="edit-post.php?edit=<?php echo $id; ?>"><i
                                                class="fa fa-edit btn btn-success btn-sm"></i></a>
                                    <a href="post.php?del=<?php echo $id; ?>"><i
                                                class="fa fa-trash  btn btn-danger btn-sm "></i> </a>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    } else {
                        echo "<h2 class='text-center'>No Post Available</h2>";
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>

    <?php require_once 'inc/footer.php'; ?>
