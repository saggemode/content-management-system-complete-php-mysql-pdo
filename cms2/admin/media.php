<?php
require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
?>
</head>

<body>
<div id="wrapper">
    <?php require_once('inc/header.php'); ?>
    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('inc/sidebar.php'); ?>
            </div>
            <div class="col-md-9">
                <h1 class="text-primary"><i class="fa fa-databaser"></i> Media
                    <small class="text-secondary">statistics overview</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><i class="fa fa-tachometer"></i> Dashboard</li>
                        <li class="breadcrumb-item active"><i class="fa fa-database"></i> media</li>
                    </ol>
                </nav>

                <?php
                if(isset($_POST['submit'])){
                    if(count($_FILES['media']['name']) > 0){
                        for($i = 0; $i < count($_FILES['media']['name']); $i++){
                            $image = $_FILES['media']['name'][$i];
                            $tmp_name = $_FILES['media']['tmp_name'][$i];

                            $query = $con->prepare("INSERT INTO media (image) VALUES ('$image')");
                            $query->execute();
                                $path = "media/$image";
                                if(move_uploaded_file($tmp_name, $path)){
                                    copy($path, "../$path");
                                }
                        }
                    }
                }
                ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-4 col-8">
                            <input type="file" name="media[]" required multiple>
                        </div>
                        <div class="col-sm-4 col-4">
                            <input type="submit" name="submit" class="btn btn-primary btn-md waves-effect waves-light" value="Add Media">
                        </div>
                    </div>
                </form>
                <hr>

                <div class="row">

                    <?php
                    $get_query = $con->prepare("SELECT * FROM media ORDER BY id DESC") ;
                    $get_query->execute();
                    if($get_query->rowCount() > 0){

                        while($get_row  = $get_query->fetch()){
                            $get_image = $get_row['image'];

                            ?>
                            <div class="col-lg-2 col-md-3 col-sm-3 col-6 ">
                                <a href="media/<?php echo $get_image;?>" class="thumbnail">
                                    <img src="media/<?php echo $get_image;?>" width="100%" alt="">
                                </a>
                            </div>
                            <?php
                        }
                    }
                    else{
                        echo "<center><h2>No Media Available</h2></center>";
                    }
                    ?>
                  
                </div>

            </div>
        </div>
    </div>
    <?php require_once('inc/footer.php') ?>
