<?php
$session_role2 = $_SESSION['role'];
$session_username2 = $_SESSION['username'];
$session_image = $_SESSION['author_image'];
?>

<nav class="navbar fixed-top navbar-dark bg-primary navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="mdi mdi-home"></i><?php echo ucfirst($session_username2); ?> Home </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria- expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="">Welcome: <i
                                class="mdi mdi-account-outline"></i> <?php echo ucfirst($session_username2); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add-post.php"> <i class="mdi mdi-christiantiy"></i> Add post</a>
                </li>

                <?php
                if ($session_role2 === 'admin') {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="add-user.php"><i class="mdi mdi-account-plus-outline"></i> Add user</a>
                    </li>
                <?php } ?>
                
                


                <li class="nav-item">
                    <a class="nav-link" href="profile.php"> <i class="mdi mdi-account-settings-variant"></i> Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php"> <i class="fa fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
