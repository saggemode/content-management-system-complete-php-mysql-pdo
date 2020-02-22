<?php
require_once 'inc/top.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php');

}
?>

<body>
<div id="wrapper">
    <?php require_once 'inc/header.php'; ?>
    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">
                <?php require_once 'inc/sidebar.php'; ?>
            </div>
            <div class="col-md-9">
                <h1 class="text-primary"><i class="fa fa-tachometer"></i> Dashboard
                    <small class="text-secondary">statistics overview</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><i class="fa fa-tachometer"></i> Dashboard</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="card bg-primary text-white mb-3" style="max-width: 18rem;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-3"><i class="fa fa-comments fa-4x"></i></div>
                                    <div class="col-9">
                                        <div class="text-right huge">
                                            <?php echo checkItem('status', 'comments', 'pending') ?>
                                        </div>
                                        <div class="text-right">New Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="card-footer bg-light"><span class="float-left">View All Comments</span>
                                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card bg-danger text-white mb-3" style="max-width: 18rem;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-3"><i class="fa fa-file-text fa-4x"></i></div>
                                    <div class="col-9">
                                        <div class="text-right huge">
                                            <?php echo countItems('id', 'posts') ?>
                                        </div>
                                        <div class="text-right">All post</div>
                                    </div>
                                </div>
                            </div>
                            <a href="post.php">
                                <div class="card-footer bg-light"><span class="float-left">View All post</span> <span
                                            class="float-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card bg-success text-white mb-3" style="max-width: 18rem;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-3"><i class="fa fa-users fa-4x"></i></div>
                                    <div class="col-9">
                                        <div class="text-right huge">
                                            <?php echo countItems('id', 'users') ?>
                                        </div>
                                        <div class="text-right">All users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="card-footer bg-light"><span class="float-left">View All users</span> <span
                                            class="float-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card bg-warning text-white mb-3" style="max-width: 18rem;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-3"><i class="fa fa-folder-open fa-4x"></i></div>
                                    <div class="col-9">
                                        <div class="text-right huge">
                                            <?php echo countItems('id', 'categories') ?>
                                        </div>
                                        <div class="text-right">all categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="category.php">
                                <div class="card-footer bg-light"><span class="float-left">View All Categories</span>
                                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
                $stmt = $con->prepare('SELECT * FROM users ORDER BY id DESC LIMIT 5');
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    ?>
                    <h3 class="text-primary">New users</h3>
                    <table class="table table-bordered text-center table-responsive-md" id="example" width="100%"
                           cellspacing="0">
                        <thead class="bg-dark text-white">
                        <tr>
                            <th>Sr #</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $stmt->fetch()) {
                            $users_id = $row['id'];
                            $users_date = getdate($row['date']);
                            $users_day = $users_date['mday'];
                            $users_month = substr($users_date['month'], 0, 3);
                            $users_year = $users_date['year'];
                            $fullname = $row['full_name'];
                            $users_username = $row['username'];
                            $users_role = $row['role'];
                            ?>
                            <tr>
                                <td><?php echo $users_id; ?></td>
                                <td><?php echo "$users_day $users_month $users_year"; ?></td>
                                <td><?php echo $fullname; ?></td>
                                <td><?php echo ucfirst($users_username); ?></td>
                                <td><?php echo ucfirst($users_role); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <a href="users.php" class="btn btn-primary">View All Users</a>
                    <hr>
                <?php } ?>

                <?php
                $stmt = $con->prepare('SELECT * FROM posts ORDER BY id DESC LIMIT 5');
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    ?>

                    <h3 class="text-primary">New Post</h3>
                    <table class="table table-bordered text-center table-responsive-md" id="example" width="100%"
                           cellspacing="0">
                        <thead class="bg-dark text-white">
                        <tr>
                            <th>Sr #</th>
                            <th>Date</th>
                            <th>Post title</th>
                            <th>Category</th>
                            <th><i class="fa fa-eye"></i> views</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $stmt->fetch()) {
                            $posts_id = $row['id'];
                            $posts_date = getdate($row['date']);
                            $posts_day = $posts_date['mday'];
                            $posts_month = substr($posts_date['month'], 0, 3);
                            $posts_year = $posts_date['year'];
                            $posts_title = $row['title'];
                            $posts_categories = $row['categories'];
                            $posts_views = $row['views'];
                            ?>
                            <tr>
                                <td><?php echo $posts_id; ?></td>
                                <td><?php echo "$posts_day $posts_month $posts_year"; ?></td>
                                <td><?php echo $posts_title; ?></td>
                                <td><?php echo ucfirst($posts_categories); ?></td>
                                <td><?php echo $posts_views; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <a href="post.php" class="btn btn-primary">View All Posts</a>
                <?php } ?>

            </div>

            <script type="text/javascript">
                window.twttr = (function (d, s, id) {
                    var t, js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);
                    return window.twttr || (t = {
                        _e: [], ready: function (f) {
                            t._e.push(f)
                        }
                    });
                }(document, "script", "twitter-wjs"));
            </script>

            <!-- Place this tag where you want the widget to render. -->


            <!-- Place this tag after the last widget tag. -->
            <script type="text/javascript">
                (function () {
                    var po = document.createElement('script');
                    po.type = 'text/javascript';
                    po.async = true;
                    po.src = 'https://apis.google.com/js/platform.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(po, s);
                })();
            </script>

        </div>
    </div>
    <?php require_once 'inc/footer.php'; ?>
