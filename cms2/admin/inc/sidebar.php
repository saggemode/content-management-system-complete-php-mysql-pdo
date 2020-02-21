<?php
$session_role1 = $_SESSION['role'];
?>


<div class="list-group">
    <a href="index.php" class="list-group-item active">
        <i class="fa fa-tachometer"></i> Dashboard
    </a>
    <a href="post.php" class="list-group-item list-group-item-action">
        <span class='badge badge-primary float-right'></span>
        <i class="mdi mdi-podcast"></i> All Posts
    </a>

    <a href="media.php" class="list-group-item list-group-item-action">
        <span class='badge badge-primary float-right'><?php echo countItems('id', 'media') ?></span>
        <i class="mdi mdi-database"></i> Media
    </a>

    <?php
    if ($session_role1 === 'admin') {

        ?>

        <a href="comments.php" class="list-group-item list-group-item-action">

            <span class='badge badge-primary float-right'> <?php echo countItems('id', 'comments') ?></span>

            <i class="mdi mdi-comment"></i> Comments
        </a>
        <a href="category.php" class="list-group-item list-group-item-action">
            <span class='badge badge-primary float-right'><?php echo countItems('id', 'categories') ?></span>
            <i class="mdi mdi-folder-open"></i> Categories
        </a>
        <a href="users.php" class="list-group-item list-group-item-action">
            <span class='badge badge-primary float-right'><?php echo countItems('id', 'users') ?></span>
            <i class="fa fa-users"></i> users
        </a>

        <a href="session.php" class="list-group-item list-group-item-action">
            <span class='badge badge-primary float-right'><?php echo countItems('id', 'session_year') ?></span>
            <i class="mdi mdi-server-security"></i> Session
        </a>

        <a href="carnival.php" class="list-group-item list-group-item-action">
            <span class='badge badge-primary float-right'><?php echo countItems('id', 'carnival_invoice') ?></span>
            <i class="mdi mdi-layers"></i> Carnival Fee Payment
        </a>

        <a href="carnival_fee.php" class="list-group-item list-group-item-action">
            <i class="mdi mdi-layers"></i> Carnival Fee
        </a>

        <a href="shirt.php" class="list-group-item list-group-item-action">
            <span class='badge badge-primary float-right'> <?php echo countItems('id', 'shirt_invoice') ?> </span>
            <i class="mdi mdi-tshirt-v"></i> T Shirt Fee Payment
        </a>

        <a href="shirt_fee.php" class="list-group-item list-group-item-action">
            <i class="mdi mdi-tshirt-crew"></i> T Shirt Fee
        </a>

        <a href="department.php" class="list-group-item list-group-item-action">
            <span class='badge badge-primary float-right'> <?php echo countItems('id', 'department_invoice') ?> </span>
            <i class="fa fa-stumbleupon"></i> Departmental Fee Payment
        </a>

        <a href="departmental_fee.php" class="list-group-item list-group-item-action">
            <i class="mdi mdi-office"></i> Departmental Fee
        </a>

        <a href="student.php" class="list-group-item list-group-item-action">
            <span class='badge badge-primary float-right'><?php echo countItems('id', 'student_table') ?></span>
            <i class="fa fa-stumbleupon"></i> All Registered Student
        </a>
    <?php } ?>
</div>
