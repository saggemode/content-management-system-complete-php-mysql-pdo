<?php require_once 'inc/top.php'; ?>

</head>

<body>

<?php require_once 'inc/header.php';

$number_of_posts = 3;

if (isset($_GET['page'])) {
    $page_id = $_GET['page'];
} else {
    $page_id = 1;
}

if (isset($_GET['cat'])) {
    $cat_id = $_GET['cat'];
    $cat_query = "SELECT * FROM categories WHERE id = $cat_id";
    $cat_run = mysqli_query($con, $cat_query);
    $cat_row = mysqli_fetch_array($cat_run);
    $cat_name = $cat_row['category'];
}

if (isset($_POST['search'])) {
    $search = $_POST['search-title'];
    $all_posts_query = "SELECT * FROM posts WHERE status = 'publish'";
    $all_posts_query .= " and tags LIKE '%$search%'";
    $all_posts_run = mysqli_query($con, $all_posts_query);
    $all_posts = mysqli_num_rows($all_posts_run);
    $total_pages = ceil($all_posts / $number_of_posts);
    $posts_start_from = ($page_id - 1) * $number_of_posts;
}

if (isset($_GET['tag'])) {
    $tag = $_GET['tag'];
    $all_posts_query = "SELECT * FROM posts WHERE status = 'publish'";
    $all_posts_query .= " and tags LIKE '%$tag%'";
    $all_posts_run = mysqli_query($con, $all_posts_query);
    $all_posts = mysqli_num_rows($all_posts_run);
    $total_pages = ceil($all_posts / $number_of_posts);
    $posts_start_from = ($page_id - 1) * $number_of_posts;
} else {

    $all_posts_query = "SELECT * FROM posts WHERE status = 'publish'";
    if (isset($cat_name)) {
        $all_posts_query .= " and categories = '$cat_name'";
    }
    $all_posts_run = mysqli_query($con, $all_posts_query);
    $all_posts = mysqli_num_rows($all_posts_run);
    $total_pages = ceil($all_posts / $number_of_posts);
    $posts_start_from = ($page_id - 1) * $number_of_posts;

}

?>


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
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-8">
                <?php

                $slider_query = "select * from posts where status = 'publish' order by id desc limit 5";
                $slider_run = mysqli_query($con, $slider_query);
                if (mysqli_num_rows($slider_run) > 0){
                $count = mysqli_num_rows($slider_run);

                ?>


                <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">

                    <ol class="carousel-indicators">
                        <?php
                        for ($i = 0; $i < $count; $i++) {
                            if ($i === 0) {
                                echo "<li data-target='#carousel-example-2' data-slide-to='" . $i . "' class='active'></li>";

                            } else {
                                echo "<li data-target='#carousel-example-2' data-slide-to='" . $i . "'></li>";
                            }
                        }
                        ?>

                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $check = 0;
                        while ($slider_row = mysqli_fetch_array($slider_run)){
                        $slider_id = $slider_row['id'];
                        $slider_image = $slider_row['image'];
                        $slider_title = $slider_row['title'];
                        ++$check;
                        if ($check === 1) {
                            echo "<div class='carousel-item active'>";
                        } else {
                            echo "<div class='carousel-item'>";
                        }
                        ?>

                        <div class="view">
                            <a href="post.php?post_id=<?php echo $slider_id; ?>"><img width="100%" height="300px"
                                                                                      class="d-block w-100"
                                                                                      src="img/<?php echo $slider_image; ?>"
                                                                                      alt="First slide"></a>
                            <div class="mask rgba-black-light"></div>
                        </div>

                        <div class="carousel-caption">
                            <h3 class="h3-responsive">
                                <?php echo $slider_title; ?>
                            </h3>
                        </div>
                    </div>

                    <?php } ?>

                </div>

                <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <?php

            }
            if (isset($_POST['search'])) {
                $search = $_POST['search-title'];
                $query = "SELECT * FROM posts WHERE status = 'publish'";
                $query .= " and tags LIKE '%$search%'";
                $query .= " ORDER BY id DESC LIMIT $posts_start_from, $number_of_posts";
            } else {

                $query = "SELECT * FROM posts WHERE status = 'publish'";
                if (isset($cat_name)) {
                    $query .= " and categories = '$cat_name'";
                }
                $query .= " ORDER BY id DESC LIMIT $posts_start_from, $number_of_posts";
            }
            $run = mysqli_query($con, $query);
            if (mysqli_num_rows($run) > 0) {
                while ($row = mysqli_fetch_array($run)) {
                    $id = $row['id'];
                    $date = getdate($row['date']);
                    $day = $date['mday'];
                    $month = $date['month'];
                    $year = $date['year'];
                    $title = $row['title'];
                    $author = $row['author'];
                    $author_image = $row['author_image'];
                    $categories = $row['categories'];
                    $tags = filter_var($row['tags'], FILTER_SANITIZE_STRING);
                    $post_data = $row['post_data'];
                    $views = $row['views'];
                    $status = $row['status'];
                    $image = $row['image'];


                    ?>

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

                                <p>Written by: <span><?php echo $author ?></span></p>
                            </div>
                            <div class="col-md-2 profile-picture">
                                <img src="img/<?php echo $author_image; ?>" alt="profile picture"
                                     class="rounded-circle">
                            </div>
                        </div>
                        <a href="post.php?post_id=<?php echo $id; ?>"><img width="100%" height="400px"
                                                                           src="img/<?php echo $image; ?>" alt="image"></a>

                        <p class="desc">
                            <?php echo substr($post_data, 0, 300) . '......'; ?>

                        </p>
                        <a href="post.php?post_id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Read more...</a>

                        <div class="bottom">
                            <span><i class="fa fa-folder"></i> <a
                                        href="#"><?php echo ucfirst($categories); ?></a></span> |
                            <span><i class="fa fa-comment"></i> <a href="#">Comments</a></span> |
                            <span><i class="fa fa-tags"></i>Tags: </span>
                            <span class="tags-item">

                               <?php
                               $all_tags = explode(',', $tags);
                               foreach ($all_tags as $tag){
                                   $tag = str_replace(' ','', $tag);
                                   $lowertag = strtolower($tag);
                                   echo "<a href='index.php?tag = {$lowertag}'>" . $tag . '</a> ' ;
                               }
                               ?>

                            </span>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo '<br>';
                echo "<center><h2 class='alert alert-info'>No News Available in this category</h2></center>";
            }
            ?>


            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li class='" . ($page_id === $i ? 'page-item active' : ' ') . "'><a class='page-link'  href='index.php?page=" . $i . '&' . (isset($cat_name) ? "cat=$cat_id" : ' ') . "'>$i</a></li>";

                }
                ?>
            </ul>


        </div>

        <div class="col-md-4">
            <?php require_once('inc/sidebar.php'); ?>

        </div>
    </div>
    </div>
</section>

<?php require_once('inc/footer.php'); 
