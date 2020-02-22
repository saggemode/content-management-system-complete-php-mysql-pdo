<?php require_once('inc/top.php') ?>


</head>

<body>

<div id="wrapper">

    <?php require_once('inc/header.php') ?>

    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">

                <?php require_once('inc/sidebar.php') ?>

            </div>

            <div class="col-md-9">
                <h1 class="text-primary"><i class="fa fa-users"></i> users
                    <small class="text-secondary">view all users</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-users"></i> Users</li>
                    </ol>
                </nav>

              

                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <select name="bulk-options" id="" class="form-control">
                                            <option value="delete">Delete</option>
                                            <option value="author">change to author</option>
                                            <option value="admin">change to admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8">
                              <input type="submit" value="Apply" class="btn mb-4 btn-success btn-md waves-effect waves-light">
                                </div>
                            </div>

                        </div>
                    </div>

                   

                     <table class="table table-bordered text-center table-responsive-md" id="example" width="100%" cellspacing="0">
                        <thead class="bg-dark text-white">
                        <tr>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Sr #</th>
                            <th>Date</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Role</th>
                            <th>Actions</th>


                        </tr>
                        </thead>
                        <tbody>
                      
                            <tr>
                                <td><input type="checkbox" class="checkboxes" name="checkboxes[]"
                                           value=""></td>
                                <td>
                                   1
                                </td>
                                <td>
                                    45 june 1991
                                </td>
                                <td>
                                    umeh oUUUU
                                </td>
                                <td>
                                    BMARIO
                                </td>
                                <td>
                                    umeh288@gmail.com
                                </td>
                                <td><img src="img/Facebook-Page-Cover-photo.png" width="30px"></td>
                                <td>
                                    admin
                                </td>
                                <td>
                                    <a href=""><i
                                            class="fa fa-pencil btn btn-success btn-sm"></i></a>
                                    <a href=""><i
                                            class="fa fa-trash  btn btn-danger btn-sm"></i></a></td>
                            </tr>
                     
                        </tbody>
                    </table>

                  

                </form>

            </div>
        </div>
    </div>

    <?php require_once('inc/footer.php') ?>
