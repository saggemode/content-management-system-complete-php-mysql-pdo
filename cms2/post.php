<?php
require_once('inc/top.php'); ?>


<?php
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    $views_query = "UPDATE posts SET views = views + 1 WHERE  id = $post_id";
    mysqli_query($con, $views_query);

    $query = "SELECT * FROM posts WHERE status = 'publish' and id = $post_id";
    $run = mysqli_query($con, $query);
    if (mysqli_num_rows($run) > 0) {
        $row = mysqli_fetch_array($run);
        $id = $row['id'];
        $date = getdate($row['date']);
        $day = $date['mday'];
        $month = $date['month'];
        $year = $date['year'];
        $title = mysqli_real_escape_string($con,$row['title']);
        $image = $row['image'];
        $author_image = $row['author_image'];
        $author = $row['author'];
        $categories = $row['categories'];
        $tags = mysqli_real_escape_string($con,$row['tags']);
        $post_data = mysqli_real_escape_string($con,$row['post_data']);
    } else {
        header('Location: index.php');
    }
}
?>

</head>

<body>

<?php require_once('inc/header.php'); ?>


<div class="jumbotron text-center jumbotron-design">

    <!--Title-->
    <h4 class="card-title font-bold pb-2"><strong>COMPUTER SCIENCE DEPARTMENT</strong></h4>

    <!--Card image-->
    <div class="view overlay my-4">
        <img src="img/banner%20fpno.jpg" class="img-fluid" alt="Example photo">
        <a href="#">
            <div class="mask rgba-white-slight"></div>
        </a>
    </div>

    <h5 class="indigo-text font-bold mb-4"></h5>

    <p class="card-text"></p>

    <!--Linkedin-->
    <a class="fa-lg p-2 m-2 li-ic"><i class="fa fa-linkedin grey-text"> </i></a>
    <!--Twitter-->
    <a class="fa-lg p-2 m-2 tw-ic"><i class="fa fa-twitter grey-text"> </i></a>
    <!--Dribbble-->
    <a class="fa-lg p-2 m-2 fb-ic"><i class="fa fa-facebook grey-text"> </i></a>

</div>


<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="post">
                    <div class="row">
                        <div class="col-md-2  post-date">
                            <div class="day">
                                <?php echo $day; ?>
                            </div>
                            <div class="month">
                                <?php echo $month; ?>
                            </div>
                            <div class="year">
                                <?php echo $year; ?>
                            </div>
                        </div>
                        <div class="col-md-8 post-title">
                            <a href="post.php?post_id=<?php echo $id; ?>">
                                <h2>
                                    <?php echo $title; ?>
                                </h2>
                            </a>

                            <p>Written by: <span><?php echo ucfirst($author); ?></span></p>
                        </div>
                        <div class="col-md-2 profile-picture">
                            <img src="img/<?php echo $author_image; ?>" alt="profile picture" class="rounded-circle">
                        </div>
                    </div>
                    <a href="img/<?php echo $image; ?>"><img width="100%" height="400px" src="img/<?php echo $image; ?>"
                                                             alt="image"></a>

                    <p class="desc">
                        <?php echo $post_data; ?>
                    </p>


                    <div class="bottom">
                        <span><i class="fa fa-folder"></i> <a href="#"><?php echo ucfirst($categories); ?></a></span> |
                        <span><i class="fa fa-comment"></i> <a href="#">Comments</a></span>
                        <span><i class="fa fa-tags"></i>Tags: </span>
                        <span class="tags-item">

                               <?php
                               $all_tags = explode(",", $tags);
                               foreach ($all_tags as $tag){
                                   $tag = str_replace(' ','', $tag);
                                   $lowertag = strtolower($tag);
                                   echo "<a href='index.php?tag = {$lowertag}'>" . $tag . '</a> ' ;
                               }
                               ?>

                            </span>
                    </div>
                </div>

                <div class="related-posts">
                    <h3>Related posts</h3>
                    <hr>
                    <div class="row">
                        <?php
                        $r_query = "SELECT * FROM posts WHERE status = 'publish' AND tags LIKE '%$tags%' LIMIT 3";
                        $r_run = mysqli_query($con, $r_query);
                        while ($r_row = mysqli_fetch_array($r_run)) {
                            $r_id = $r_row['id'];
                            $r_title = $r_row['title'];
                            $r_image = $r_row['image'];
                            ?>
                            <div class="col-sm-4">
                                <a href="post.php?post_id=<?php echo $r_id; ?>">
                                    <img width="100%" height="70px" src="img/<?php echo $r_image; ?>" alt="">
                                    <h6> <?php echo $r_title; ?> </h6>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="author">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="img/<?php echo $author_image; ?>" alt="" class="rounded-circle img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <h4>
                                <?php echo ucfirst($author); ?>
                            </h4>

                            <?php
                            $bio_query = "SELECT * FROM users WHERE username = '$author'";
                            $bio_run = mysqli_query($con, $bio_query);
                            if (mysqli_num_rows($bio_run) > 0) {
                                $bio_row = mysqli_fetch_array($bio_run);
                                $author_details = $bio_row['details'];

                                ?>
                                <p>
                                    <?php echo $author_details; ?> </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php
                $c_query = "SELECT * FROM comments WHERE status = 'approve' and post_id = $post_id ORDER BY id DESC LIMIT 5";
                $c_run = mysqli_query($con, $c_query);
                if (mysqli_num_rows($c_run) > 0) {
                    ?>
                    <div class="comment">
                        <h3>Comments</h3>
                        <?php
                        while ($c_row = mysqli_fetch_array($c_run)) {
                            $c_id = $c_row['id'];
                            $c_name = $c_row['name'];
                            $c_username = $c_row['username'];
                            $c_image = $c_row['image'];
                            $c_comment = $c_row['comment'];
                            ?>
                            <hr>
                            <div class="row single-comment">
                                <div class="col-sm-2">
                                    <img height="20px" src="img/<?php echo $c_image; ?>" alt="image"
                                         class="rounded-circle img-fluid img-thumbnail">
                                </div>
                                <div class="col-sm-10">
                                    <h4>
                                        <?php echo ucfirst($c_name); ?>
                                    </h4>
                                    <p>
                                        <?php echo $c_comment; ?> </p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php }
                if (isset($_POST['submit'])) {
                    $cs_name = $_POST['name'];
                    $cs_email = $_POST['email'];
                    $cs_website = $_POST['website'];
                    $cs_comment = $_POST['comment'];
                    $cs_date = time();
                    if (empty($cs_name) or empty($cs_email) or empty($cs_comment)) {
                        $error_msg = "All (*) fields are Required";
                    } else {
                        $cs_query = "INSERT INTO comments (id, date, name, username, post_id, email, website, image, comment, status) VALUES (NULL, '$cs_date', '$cs_name', 'user', '$post_id', '$cs_email', '$cs_website', 'unknown-picture.png', '$cs_comment', 'pending')";
                        if (mysqli_query($con, $cs_query)) {
                            $msg = "Comment Submitted and waiting for Approval";
                            header("refresh:8; url=post.php?post_id=$post_id");
                            $cs_name = "";
                            $cs_email = "";
                            $cs_website = "";
                            $cs_comment = "";
                        } else {
                            $error_msg = "Comment has not be submitted";
                            header("refresh:8; url=post.php?post_id=$post_id");
                        }
                    }
                }

                ?>


                <div class="comment-box">
                    <div class="row">
                        <div class="col-12">
                            <form action="" method="POST" role="form" enctype="multipart/form-data">
                                <fieldset class="md-form">
                                    <label for="fullname">Full Name</label>
                                    <input type="text" class="form-control" id="" placeholder="" name="name"
                                           value="<?php if (isset($cs_name)) {
                                               echo $cs_name;
                                           } ?>">
                                </fieldset>
                                <fieldset class="md-form">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="" placeholder="" name="email"
                                           value="<?php if (isset($cs_email)) {
                                               echo $cs_email;
                                           } ?>">
                                </fieldset>
                                <fieldset class="md-form">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control" id="" placeholder="" name="website"
                                           value="<?php if (isset($cs_website)) {
                                               echo $cs_website;
                                           } ?>">
                                </fieldset>
                                <fieldset class="md-form">
                                    <label for="">Comments</label>
                                    <textarea class="form-control" id="" rows="10" cols="30"
                                              name="comment"> <?php if (isset($cs_comment)) {
                                            echo $cs_comment;
                                        } ?></textarea>
                                </fieldset>
                                <input type="submit" name="submit" class="btn btn-primary rounded"
                                       value="Submit Comment">

                                <?php
                                if (isset($error_msg)) {
                                    echo "<div class='alert alert-danger' role='alert'>$error_msg</div>";
                                } else if (isset($msg)) {
                                    echo "<div class='alert alert-success' role='alert'>$msg</div>";
                                }
                                ?>


                            </form>


                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-4">
                <?php require_once('inc/sidebar.php'); ?>
            </div>
        </div>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>
