<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontAwesome-4/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animated.css">
    <link rel="stylesheet" href="css/style.css">


</head>

<body>

    <div id="wrapper">
        <nav class="navbar fixed-top navbar-dark bg-primary navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="index.php">Admin </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria- expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"> <i class="fa fa-plus-square"></i> Add post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-user-plus"></i> Add user</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="contact-us.html"> <i class="fa fa-user"></i> Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="contact-us.html"> <i class="fa fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid body-section">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <a href="index.php" class="list-group-item active">
                        <i class="fa fa-tachometer"></i> Dashboard
                    </a>
                        <a href="#" class="list-group-item list-group-item-action">
                        <span class="badge badge-primary badge-pill float-right">14</span>
                        <i class="fa fa-file-text"></i> All Posts
                    </a>
                        <a href="#" class="list-group-item list-group-item-action">
                        <span class="badge badge-primary badge-pill float-right">10</span>
                        <i class="fa fa-comment"></i> Comments
                    </a>
                        <a href="category.php" class="list-group-item list-group-item-action">
                        <span class="badge badge-primary badge-pill float-right">10</span>
                        <i class="fa fa-folder-open"></i> Categories
                    </a>
                        <a href="#" class="list-group-item list-group-item-action">
                        <span class="badge badge-primary badge-pill float-right">10</span>
                        <i class="fa fa-users"></i> users
                    </a>
                    </div>


                </div>
                <div class="col-md-9">
                    <h1 class="text-primary"><i class="fa fa-tachometer"></i> Category
                        <small class="text-secondary">Different</small>
                    </h1>
                    <hr>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-folder-open"></i> Category</li>
                        </ol>
                    </nav>


                </div>
            </div>
        </div>


        <footer>
            &copy;copyright by <a href="#"> class 1 </a> <span class=""> 2011 - 2018 </span>
        </footer>
    </div>

    <script src="vendor/jquery-3/jquery-3.3.1.js"></script>
    <script src="vendor/popper.js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
