<?php require_once('inc/top.php'); ?>

</head>


<body>

    <?php require_once('inc/header.php');
    
      $number_of_posts = 3;
      
      if(isset($_GET['page'])){
          $page_id = $_GET['page'];
      }
      else{
          $page_id = 1;
      }
    
     if(isset($_GET['cat'])){
          $cat_id = $_GET['cat'];
          $cat_query = "SELECT * FROM categories WHERE id = $cat_id";
          $cat_run = mysqli_query($con, $cat_query);
          $cat_row = mysqli_fetch_array($cat_run);
          $cat_name = $cat_row['category'];
      }
    
    if(isset($_POST['search'])){
          $search = $_POST['search-title'];
          $all_posts_query = "SELECT * FROM posts WHERE status = 'publish'";
          $all_posts_query .= " and tags LIKE '%$search%'";
          $all_posts_run = mysqli_query($con, $all_posts_query);
          $all_posts = mysqli_num_rows($all_posts_run);
          $total_pages = ceil($all_posts / $number_of_posts);
          $posts_start_from = ($page_id - 1) * $number_of_posts;
      }
      else{
    
    $all_posts_query = "SELECT * FROM posts WHERE status = 'publish'";
          if(isset($cat_name)){
              $all_posts_query .= " and categories = '$cat_name'";
          }
          $all_posts_run = mysqli_query($con, $all_posts_query);
          $all_posts = mysqli_num_rows($all_posts_run);
          $total_pages = ceil($all_posts / $number_of_posts);
          $posts_start_from = ($page_id - 1) * $number_of_posts;
          
      }
    
    ?>

    <div class="jumbotron text-center">

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



                    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                        <!--Indicators-->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-2" data-slide-to="1"></li>
                            <li data-target="#carousel-example-2" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <div class="view">
                                    <img class="d-block w-100" src="img/slider-img1.jpg" alt="First slide">
                                    <div class="mask rgba-black-light"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive">Light mask</h3>
                                    <p>First text</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <!--Mask color-->
                                <div class="view">
                                    <img class="d-block w-100" src="img/slider-img2.jpg" alt="Second slide">
                                    <div class="mask rgba-black-strong"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive">Strong mask</h3>
                                    <p>Secondary text</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <!--Mask color-->
                                <div class="view">
                                    <img class="d-block w-100" src="img/slider-img3.jpg" alt="Third slide">
                                    <div class="mask rgba-black-slight"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive">Slight mask</h3>
                                    <p>Third text</p>
                                </div>
                            </div>
                        </div>
                        <!--/.Slides-->
                        <!--Controls-->
                        <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
                        <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
                        <!--/.Controls-->
                    </div>
               
                    <?php
                        
                    
                     if(isset($_POST['search'])){
                        $search = $_POST['search-title'];
                        $query = "SELECT * FROM posts WHERE status = 'publish'";
                        $query .= " and tags LIKE '%$search%'";
                        $query .= " ORDER BY id DESC LIMIT $posts_start_from, $number_of_posts";
                    }
                    else{
                    
                      $query = "SELECT * FROM posts WHERE status = 'publish'";
                        if(isset($cat_name)){
                            $query .= " and categories = '$cat_name'";
                        }
                        $query .= " ORDER BY id DESC LIMIT $posts_start_from, $number_of_posts";
                    }
                    $run = mysqli_query($con,$query);
                    if(mysqli_num_rows($run) > 0){
                        while($row = mysqli_fetch_array($run)){
                            $id = $row['id'];
                            $date = getdate($row['date']);
                            $day = $date['mday'];
                            $month = $date['month'];
                            $year = $date['year'];
                            $title = $row['title'];
                            $author = $row['author'];
                            $author_image = $row['author_image'];
                            $categories = $row['categories'];
                            $tags = $row['tags'];
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

                                <p>Written by: <span><?php echo $author?></span></p>
                            </div>
                               <div class="col-md-2 profile-picture">
                                <img src="img/<?php echo $author_image; ?>" alt="profile picture" class="rounded-circle">
                            </div>
                            </div>
                            <a href="post.php?post_id=<?php echo $id;?>"><img width="100%" height="400px" src="img/<?php echo $image; ?>" alt="image"></a>

                            <p class="desc">
                             <?php echo substr($post_data,0,300)."......";?>
                            </p>
                            <a href="post.php?post_id=<?php echo $id;?>" class="btn btn-primary btn-sm">Read more...</a>

                            <div class="bottom">
                            <span><i class="fa fa-folder"></i> <a href="#"><?php echo ucfirst($categories);?></a></span> |
                            <span><i class="fa fa-comment"></i> <a href="#">Comments</a></span> |
                            <span><i class="fa fa-thumbs-up"></i> </span>
                            <span class="btn btn-light btn-sm"><?php echo ucfirst($tags);?></span>
                        </div>
                        </div>

                        <?php
                         }
                    }
                    else{
                       echo "<br>";
                        echo "<center><h2 class='alert alert-info'>No Posts Available</h2></center>";
                    }
                    ?>
                        <ul class="pagination text-center">
                            <?php
                                for ($i = 1; $i <= $total_pages; $i++) {
                     echo "<li class='" . ($page_id == $i ? 'page-item active' : ' ') . "'><a class='page-link'  href='index.php?page=".$i."&".(isset($cat_name)?"cat=$cat_id":" ")."'>$i</a></li>";
                  
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


    <?php require_once('inc/footer.php'); ?>
