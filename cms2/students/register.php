<?php require_once 'inc/top.php';

?>


</head>

<body>

    <div id="wrapper">

        <?php require_once 'inc/header.php' ?>

        <div class="container-fluid body-section">
            <?php
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
            $program = $_POST['program'];
            $gender = $_POST['gender'];
            $level = $_POST['level'];
            $regno = $_POST['regno'];
            $dob =  $_POST['dob'];
            $password = $_POST['password'];
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $regid = substr( str_shuffle( $chars ), 0, 8 );
            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];

            $hashPass = sha1($_POST['password']);

            $check_query = $con->prepare('SELECT * FROM student_table WHERE regno = ? or email = ? or phone = ?');
            $check_query->execute(array($regno,$email,$phone));

            if ($check_query->rowCount() > 0) {
                $error = 'This Reg number or email or phone number is already registered';
            } else {
                $insert_query = $con->prepare('INSERT INTO student_table 
                (date,name, password, email, phone, program, gender, level, dob, image, regno, regid)
                                                                                                        VALUES 
                (now(),:zname,:zpassword,:zemail,:zphone,:zprogram,:zgender,:zlevel,:zdob,:zimage,:zregno,:zregid)');
               
                 $insert_query->execute(array(
                            'zname'     => $name,
                            'zpassword' => $hashPass,
                            'zemail'    => $email,
                            'zphone'    => $phone,
                            'zprogram'  => $program,
                            'zgender'   => $gender,
                            'zlevel'    => $level,
                            'zdob'      => $dob,
                            'zimage'    => $image,
                            'zregno'    => $regno,
                            'zregid'    => $regid
                           
                        ));
                
              $msg = ' You have been successfully Registered now Login to access your details and make payment';
                move_uploaded_file($image_tmp, "img/$image");

            }

        }

        ?>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div class="card text-center my-4">
                        <div class="card-header alert alert-primary">
                            <h4 class="text-primary">Student Registration Form</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9 bg-light">


                                    <blockquote class="blockquote bq-warning">
                                        <p class="bq-title">Instructions and Warning</p>
                                        <p>Responsive tables make use of <code>overflow-y: hidden</code>, which clips off any content that goes beyond the bottom or top edges of the table. In particular, this can clip off dropdown menus and other third-party widgets. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum reprehenderit nam saepe eum quidem, impedit, similique pariatur illum molestiae. Ab earum aliquid fugit, debitis. Vel sequi doloribus, hic dolorem quod. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur cum, deleniti dolores, eaque excepturi facere impedit maxime natus odit placeat provident quidem saepe voluptatum. Itaque, molestias, unde. Delectus, neque, saepe?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum reprehenderit nam saepe eum quidem, impedit, similique pariatur illum molestiae. Ab earum aliquid fugit, debitis. Vel sequi doloribus, hic dolorem quod. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur cum, deleniti dolores, eaque excepturi facere impedit maxime natus odit placeat provident quidem saepe voluptatum. Itaque, molestias, unde. Delectus, neque, saepe?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum reprehenderit nam saepe eum quidem, impedit, similique pariatur illum molestiae. Ab earum aliquid fugit, debitis. Vel sequi doloribus, hic dolorem quod
                                        </p>
                                    </blockquote>


                                </div>

                                <div class="col-md-3">

                                    <input type="file" name="image" id="image" data-preview-file-type="any" accept="image/*" required>

                                </div>
                            </div>


                        </div>
                    </div>

                    <h4 class="alert alert-primary">Applicant bio Data</h4>
                    <?php
                                if (isset($error)) {
                                    echo "<div class='alert alert-info'>$error</div>";
                                } elseif (isset($msg)) {
                                    echo "<div class='alert alert-success'> $msg</div>";
                                }
                                ?>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="text-primary">Full Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Your Full Name" class="form-control" maxlength="20" value="<?php if (isset($first_name)) {
                                    echo $name;
                                } ?>" required>

                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="text-primary">Email</label>
                                    <input type="text" name="email" id="email" placeholder="Enter Valid Email" class="form-control" value="<?php if (isset($first_name)) {
                                    echo $email;
                                } ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone" class="text-primary">Phone Number</label>
                                    <input type="text" name="phone" id="phone" placeholder="Enter your Phone NUmber" class="form-control" maxlength="11" value="<?php if (isset($first_name)) {
                                    echo $phone;
                                } ?>" required>
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="text-primary">Program</label>
                                    <select class="form-control" name="program" id="program" required>
                            <option value="">Please Select your program</option>
                            <option value="morning">Morning</option>
                            <option value="evening">Evening</option>
                            <option value="weekend">Weekend</option>
                        </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="text-primary">Gender</label>
                                    <select class="form-control" name="gender" id="gender" required>
                            <option value="">Please Select your gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="text-primary">Level</label>
                                    <select class="form-control" name="level" id="level" required>
                            <option value="">Please Select your level</option>
                            <option value="nd1">ND1</option>
                            <option value="nd2">ND2</option>
                            <option value="hnd1">HND1</option>
                            <option value="hnd2">HND2</option>
                        </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="text-primary">Registration Number</label>
                                    <input type="text" name="regno" id="regno" placeholder="Enter your Reg Number" class="form-control" value="<?php if (isset($first_name)) {
                                    echo $regno;
                                } ?>" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="text-primary">Date Of Birth</label>
                                    <input type="date" name="dob" id="dob" placeholder="Enter your date of birth" value="" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="text-primary">Password</label>
                                    <input type="password" name="password" id="password" placeholder="Enter your Password" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn  btn-mdb-color waves-ripple rounded btn-md waves-effect waves-light" name="submit">
                    <span class="fa fa-send mr-1"></span> &nbsp; Submit Data
                </button>
                </form>

        </div>


        <?php require_once 'inc/footer.php' ?>
