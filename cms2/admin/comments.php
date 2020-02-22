<?php include 'inc/top.php'; ?>
<?php

if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
else if(isset($_SESSION['username']) && $_SESSION['role'] === 'author'){
    header('Location: index.php');
}

$session_username = $_SESSION['username'];

if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $del_query = $con->prepare('DELETE FROM comments WHERE id = :zid');
    $del_query->execute(array('zid' => $del_id));

    if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
        if ($del_query->execute()) {
            $msg = 'Comment Has Been Deleted';
            header('refresh:2; url=comments.php');
        } else {
            $error = 'Comment Has Not Been Deleted';
            header('refresh:2; url=comments.php');
        }
    }
}

if (isset($_GET['approve'])) {
    $approve_id = $_GET['approve'];
    $approve = $con->prepare("UPDATE comments SET status = 'approve' WHERE id = :zid");
    $approve->execute(array('zid' => $approve_id));

    if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
        if ($approve->execute()) {
            $msg = 'Comment Has Been approved';
        } else {
            $error = 'Comment Has Not Been approve';
        }
    }
}

if (isset($_GET['unapprove'])) {
    $unapprove_id = $_GET['unapprove'];
    $unapprove = $con->prepare("UPDATE comments SET status = 'unapprove' WHERE id = :zid");
    $unapprove->execute(array('zid' => $unapprove_id));

    if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
        if ($unapprove->execute()) {
            $msg = 'Comment Has Been unapprove';
        } else {
            $error = 'Comment Has Not Been unapprove';
        }
    }
}

if(isset($_POST['checkboxes'])){

    foreach($_POST['checkboxes'] as $user_id){

        $bulk_option = $_POST['bulk-options'];

        if($bulk_option === 'delete'){
            $bulk_delete_query = $con->prepare('DELETE FROM comments WHERE id = ? ');
            $bulk_delete_query->execute(array($user_id));
        }
        else if($bulk_option === 'approve'){
            $bulk_author_query = $con->prepare("UPDATE comments SET status = 'approve' WHERE id = $user_id") ;
            $bulk_author_query->execute(array($user_id));
        }
        else if($bulk_option === 'unapprove'){
            $bulk_admin_query = $con->prepare("UPDATE comments SET status = 'unapprove' WHERE id = $user_id") ;
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
                <h1 class="text-primary"><i class="fa fa-comments"></i> comments
                    <small class="text-secondary">view all comments</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-comments"></i> comments
                        </li>
                    </ol>
                </nav>

                <?php
                if(isset($_GET['reply'])){
                $reply_id = $_GET['reply'];
                $reply_check = $con->prepare('SELECT * FROM comments WHERE post_id = ?');
                $reply_check->execute(array($reply_id));
                if($reply_check->rowCount() > 0) {
                if(isset($_POST['reply'])){
                    $comment_data = $_POST['comment'];
                    if(empty($comment_data)){
                        $comment_error = 'Must Fill This Field';
                    }
                    else{
                        $get_user_data = $con->prepare( 'SELECT * FROM users WHERE username = ?');
                        $get_user_data->execute(array($session_username));
                        $get_user_row = $get_user_data->fetch();
                        $date = time();
                        $full_name = $get_user_row['full_name'];
                        $email = $get_user_row['email'];
                        $image = $get_user_row['image'];

                        $insert_comment_query = $con->prepare("INSERT INTO comments 
                                        (date,name,username,post_id,email,image,comment,status) 
                                VALUES  ('$date','$full_name','$session_username','$reply_id','$email','$image','$comment_data','approve')");

                        if($insert_comment_query->execute()){
                            $comment_msg = 'Comment Has Been Submitted';
                            header('refresh:2; url=comments.php');
                        }
                        else{
                            $comment_error = 'Comment Has Not Been Submitted';
                        }
                    }
                }

                ?>
               

                        <div class="row">
                            <div class="col-sm-12 col-sm-8 col-md-6 col-lg-6">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="comment" class="sr-only-focusable">Comment:*</label>
                                        <?php
                                        if(isset($comment_error)){
                                            echo "<span class='pull-right' style='color:red;'>$comment_error</span>";
                                        }
                                        else if(isset($comment_msg)){
                                            echo "<span class='pull-right' style='color:green;'>$comment_msg</span>";
                                        }
                                        ?>
                                        
                                        <textarea name="comment" id="comment" cols="30" rows="10"
                                                  placeholder="Your Comment Here" class="form-control"></textarea>
                                    </div>
                                    <input type="submit" name="reply" class="btn btn-primary btn-md waves-effect waves-light" value="reply">
                                </form>
                            </div>
                        </div>
                        <hr>

                <?php
                  }
                }
                $stmt = $con->prepare('SELECT * FROM comments ORDER BY id DESC');
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                ?>

                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-4 col-md-4">
                                    <div class="form-group">
                                        <select name="bulk-options" id="" class="form-control">
                                            <option value="delete">Delete</option>
                                            <option value="approve">Approve</option>
                                            <option value="pending">Unapprove</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8 col-md-8">
                                    <input type="submit" value="Apply" class="btn mb-4 btn-success btn-md waves-effect waves-light">
                                </div>
                            </div>

                        </div>
                    </div>


                    <?php
                    if(isset($error)){
                        echo "<span style='color:red;' class='pull-right'>$error</span>";
                    }
                    else if(isset($msg)){
                        echo "<span style='color:green;' class='pull-right'>$msg</span>";
                    }
                    ?>
                   <table class="table table-bordered text-center table-responsive-md text-sm" id="example" width="100%" cellspacing="0">
                        <thead class="bg-dark text-white">
                        <tr>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Date</th>
                            <th>Username</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Control</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($row = $stmt->fetch()) {
                            $id = $row['id'];
                            $username = $row['username'];
                            $status = $row['status'];
                            $comment = $row['comment'];
                            $post_id = $row['post_id'];
                            $date = getdate($row['date']);
                            $day = $date['mday'];
                            $month = substr($date['month'],0,3);
                            $year = $date['year'];
                        ?>
                            <tr>
                                <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>

                                <td><?php echo "$day $month $year";?></td>

                                <td><?php echo $username;?></td>

                                <td><?php echo $comment;?></td>

                                <td>
                                    <?php
                                    if($status === 'approve'){
                                        echo '<span class="badge badge-primary">';
                                    }
                                    else if($status === 'pending'){
                                        echo '<span class="badge badge-info">';
                                    }
                                    else if($status === 'unapprove'){
                                        echo '<span class="badge badge-danger">';
                                    }
                                    ?><?php echo ucfirst($status);?>
                                </td>

                                <td>
                                    <a href="comments.php?approve=<?php echo $id;?>"><i
                                            class="btn btn-sm btn-primary  fa fa-thumbs-up"></i></a>
                                    <a href="comments.php?unapprove=<?php echo $id;?>"><i
                                            class="btn btn-sm btn-info fa fa-thumbs-down"></i></a>
                                    <a href="comments.php?reply=<?php echo $post_id;?>"><i
                                            class="btn btn-sm btn-indigo fa fa-reply"></i></a>
                                    <a href="comments.php?del=<?php echo $id;?>"><i
                                            class="btn btn-sm btn-danger  fa fa-times"></i></a>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                    <?php
                    } else {
                        echo "<h2 class='text-center'>No Comments Available</h2>";
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>

    <?php require_once('inc/footer.php'); ?>
