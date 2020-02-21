<div class="widget">
    <form action="index.php" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="search...." aria-label="search"
                   aria-describedby="basic-addon2" name="search-title">

            <div class="input-group-append">
                <input type="submit" class="btn btn-outline-secondary" value="GO!" name="search">
            </div>
        </div>
    </form>
</div>

<div class="widget popular">
    <h5>Popular News Feeds</h5>

    <?php
    $p_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY views DESC LIMIT 3";
    $p_run = mysqli_query($con, $p_query);
    if (mysqli_num_rows($p_run) > 0) {
        while ($p_row = mysqli_fetch_array($p_run)) {
            $p_id = $p_row['id'];
            $p_date = getdate($p_row['date']);
            $p_day = $p_date['mday'];
            $p_month = $p_date['month'];
            $p_year = $p_date['year'];
            $p_title = $p_row['title'];
            $p_image = $p_row['image'];
            ?>

            <hr>
            <div class="row">
                <div class="col-4 ">
                    <a href="post.php?post_id=<?php echo $p_id; ?>"><img width="100%" height="50px"
                                                                         src="img/<?php echo $p_image; ?>"
                                                                         alt="Image 1"></a>
                </div>
                <div class="col-8 details">
                    <a href="post.php?post_id=<?php echo $p_id; ?>">
                        <h6 class="font-small">
                            <?php echo $p_title; ?>
                        </h6>
                    </a>

                    <p><i class="fa fa-clock-o"></i>
                        <?php echo "$p_day $p_month $p_year"; ?>
                    </p>
                </div>
            </div>

            <?php
        }
    } else {
        echo "<h6 class='alert alert-info'>No News Feeds  Available</h6>";
    }
    ?>

</div>


<div class="widget popular">
    <h5>Recent News Feeds</h5>
    <?php
    $p_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY views DESC LIMIT 3";
    $p_run = mysqli_query($con, $p_query);
    if (mysqli_num_rows($p_run) > 0) {
        while ($p_row = mysqli_fetch_array($p_run)) {
            $p_id = $p_row['id'];
            $p_date = getdate($p_row['date']);
            $p_day = $p_date['mday'];
            $p_month = $p_date['month'];
            $p_year = $p_date['year'];
            $p_title = $p_row['title'];
            $p_image = $p_row['image'];
            ?>

            <hr>
            <div class="row">
                <div class="col-4 ">
                    <a href="post.php?post_id=<?php echo $p_id; ?>"><img width="100%" height="50px"
                                                                         src="img/<?php echo $p_image; ?>"
                                                                         alt="Image 1"></a>
                </div>
                <div class="col-8 details">
                    <a href="post.php?post_id=<?php echo $p_id; ?>">
                        <h6 class="font-small">
                            <?php echo $p_title; ?>
                        </h6>
                    </a>

                    <p><i class="fa fa-clock-o"></i>
                        <?php echo "$p_day $p_month $p_year"; ?>
                    </p>
                </div>
            </div>

            <?php
        }
    } else {
        echo "<h6 class='alert alert-info'>No News Feed Available</h6>";
    }
    ?>
</div>

<div class="widget categories">

    <h4>Category</h4>
    <hr>
    <div class="row">
        <div class="col-6">
            <ul>
                <?php
                $c_query = "SELECT * FROM categories";
                $c_run = mysqli_query($con, $c_query);
                if (mysqli_num_rows($c_run) > 0) {
                    $count = 2;
                    while ($c_row = mysqli_fetch_array($c_run)) {
                        $c_id = $c_row['id'];
                        $c_category = $c_row['category'];
                        $count = $count + 1;

                        if (($count % 2) === 1) {
                            echo "<li><a href='index.php?cat=" . $c_id . "'>" . ucfirst($c_category) . "</a></li>";
                        }

                    }
                } else {
                    echo "<h3 class='alert alert-info'>No News Available</h3>";
                }
                ?>
            </ul>
        </div>
        <div class="col-6">
            <ul>
                <?php
                $c_query = "SELECT * FROM categories";
                $c_run = mysqli_query($con, $c_query);
                if (mysqli_num_rows($c_run) > 0) {
                    $count = 2;
                    while ($c_row = mysqli_fetch_array($c_run)) {
                        $c_id = $c_row['id'];
                        $c_category = $c_row['category'];
                        $count = $count + 1;

                        if (($count % 2) == 0) {
                            echo "<li><a href='index.php?cat=" . $c_id . "'>" . (ucfirst($c_category)) . "</a></li>";
                        }

                    }
                } else {
                    echo "<p class='alert alert-info'>No News Available</p>";
                }
                ?>
            </ul>
        </div>
    </div>

</div>


<?php
if (isset($_POST['send_message'])) {
    $sender_name = mysqli_real_escape_string($con, $_POST['sender_name']);
    $sender_email = mysqli_real_escape_string($con, $_POST['sender_name']);
    $sender_reason = mysqli_real_escape_string($con, $_POST['sender_reason']);
    $sender_message = mysqli_real_escape_string($con, $_POST['sender_message']);
    if (empty($sender_name) || empty($sender_email) || empty($sender_reason) || empty($sender_message)) {
        $error = 'All fields Are Required';
    } else {
        $insert_query = "INSERT INTO contact_us 
                            (name, email,reason,message,date) VALUES ('$sender_name','$sender_email','$sender_reason','$sender_message',now())";
        if (mysqli_query($con, $insert_query)) {
            $msg = 'message Has Been send';
            $sender_name = '';
            $sender_email = '';
            $sender_reason = '';
            $sender_message = '';
        } else {
            $error = 'Post Has not Been Added';
        }
    }
}
?>


<!-- contact form start -->
<div class="widget categories">
    <div id="wrapper">
        <div id="contact_form">
            <h6 class="alert alert-secondary">Contact Us</h6>
            <form method="post" action="" id="">
                <table align=center>
                    <tr>
                        <td>Enter Your Name :</td>
                        <td><input type="text" id="sender_name" name="sender_name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Enter Your Email :</td>
                        <td><input type="email" id="sender_email" name="sender_email" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Contact Reason :</td>
                        <td><input type="text" id="reason" name="sender_reason" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Message :</td>
                        <td><textarea id="message" name="sender_message" class="form-control"></textarea></td>
                    </tr>
                </table>
                <br>
                <?php
                if (isset($msg)) {
                    echo "<div class='alert alert-success'>$msg</div>";
                } else if (isset($error)) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                ?>

                <p><input type="submit" name="send_message" value="SUBMIT FORM" class="btn btn-primary btn-block"></p>

            </form>
        </div>
    </div>
</div>
<!-- contact form end -->

<!--<div class="widget categories">-->
<!--    <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalContactForm">Contact Us</a>-->
<!--</div>-->

<!--news letter-->

<div id="newsletter_form" class="bg-white" style=" padding:20px; border-radius: 10px;  border:1px solid #E3E3E3;">
    <h6 class="alert alert-success text-center">Subscribe To Get Email Updates </h6>
    <form action="" method="post">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <input class="form-control " type="text" name="user_name" id="user_name"
                           placeholder="Enter Your Name">
                </div>
                <div class="col-sm-7">
                    <input class="form-control" type="text" name="email" id="email" placeholder="Enter Your Email Id"/>
                </div>
            </div>
            <br>
            <input class="btn btn-primary btn-primary btn-block rounded-circle btn-md" type="submit" value="Subscribe"
                   name="submit_form"/>
            <input class="btn btn-danger btn-danger btn-block rounded-circle btn-md" type="button" value="No Thanks"
                   onclick="close_form();"/>
        </div>
    </form>
</div>


<div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Write to us</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <input type="text" id="form34" class="form-control validate" name="sender_name">
                    <label data-error="wrong" data-success="right" for="form34">Your name</label>
                </div>

                <div class="md-form mb-5">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input type="email" id="form29" class="form-control validate" name="sender_email">
                    <label data-error="wrong" data-success="right" for="form29">Your email</label>
                </div>

                <div class="md-form mb-5">
                    <i class="fa fa-tag prefix grey-text"></i>
                    <input type="text" id="form32" class="form-control validate" name="sender_reason" >
                    <label data-error="wrong" data-success="right" for="form32">Subject</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-pencil prefix grey-text"></i>
                    <textarea type="text" id="form8" class="md-textarea form-control" rows="4" name="sender_message"></textarea>
                    <label data-error="wrong" data-success="right" for="form8">Your message</label>
                </div>
            </div>
            <?php
            if (isset($msg)) {
                echo "<div class='alert alert-success'>$msg</div>";
            } else if (isset($error)) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
            ?>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-unique" name="send_message">Send <i class="fa fa-paper-plane-o ml-1"></i></button>

            </div>
        </div>
    </div>
</div>





