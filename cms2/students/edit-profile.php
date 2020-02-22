<?php require_once('inc/top.php');
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}

$session_email = $_SESSION['email'];
$session_regid = $_SESSION['regid'];
$session_program = $_SESSION['program'];


if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    $edit_query = $con->prepare("SELECT * FROM student_table WHERE id = $edit_id");
    $edit_query->execute(array($edit_id));
    if($edit_query->rowCount() > 0){
        $edit_row = $edit_query->fetch();

        $e_name = $edit_row['name'];
        $e_password = $edit_row['password'];
        $e_email = $edit_row['email'];
        $e_phone = $edit_row['phone'];
        $e_program = $edit_row['program'];
        $e_gender = $edit_row['gender'];
        $e_level = $edit_row['level'];
        $e_dob = $edit_row['dob'];
        $e_image = $edit_row['image'];
        $e_regno = $edit_row['regno'];
        $e_regid = $edit_row['regid'];
    }
    else{
        header('location: index.php');
    }
}
else{
    header("location: index.php");
}

?>


</head>

<body>

<div id="wrapper">

    <?php require_once('inc/header.php') ?>

    <div class="container-fluid body-section">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['edit'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $program = $_POST['program'];
            $gender = $_POST['gender'];
            $level = $_POST['level'];
            $regno = $_POST['regno'];
            $dob = $_POST['dob'];

            $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];



            if(empty($name) or empty($phone) ){
                $error = "Full name or Phone number  are Required";
            } else {
                $update_query = $con->prepare( "UPDATE student_table SET name = ?, password = ?, email = ?, phone = ?, program = ?, gender = ?, level = ?, dob = ?, image = ?, regno = ?, regid = ? WHERE id = ?");
                $update_query->execute(array($name,$pass,$email,$phone,$program,$gender,$level,$dob,$image,$regno,$session_regid,$id));

                $msg = " You have been successfully Updated Your Profile ";
                move_uploaded_file($image_tmp, "img/$image");
                header("refresh: 2; url=index.php");

            }

        }

        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit" value="<?php echo $edit_id ?> ">
            <div class="card text-center my-4">
                <div class="card-header alert alert-primary">
                    <h4 class="text-primary fa fa-edit fa-4x">Edit Profile</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9 bg-light">


                            <blockquote class="blockquote bq-warning">
                                <p class="bq-title">Instructions and Warning</p>
                                <p>Responsive tables make use of <code>overflow-y: hidden</code>, which clips off any
                                    content that goes beyond the bottom or top edges of the table. In particular, this
                                    can clip off dropdown menus and other third-party widgets. Lorem ipsum dolor sit
                                    amet, consectetur adipisicing elit. Harum reprehenderit nam saepe eum quidem,
                                    impedit, similique pariatur illum molestiae. Ab earum aliquid fugit, debitis. Vel
                                    sequi doloribus, hic dolorem quod. Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Aspernatur cum, deleniti dolores, eaque excepturi facere impedit
                                    maxime natus odit placeat provident quidem saepe voluptatum. Itaque, molestias,
                                    unde. Delectus, neque, saepe?Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit. Harum reprehenderit nam saepe eum quidem, impedit, similique pariatur illum
                                    molestiae. Ab earum aliquid fugit, debitis. Vel sequi doloribus, hic dolorem quod.
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur cum, deleniti
                                    dolores, eaque excepturi facere impedit maxime natus odit placeat provident quidem
                                    saepe voluptatum. Itaque, molestias, unde. Delectus, neque, saepe?Lorem ipsum dolor
                                    sit amet, consectetur adipisicing elit. Harum reprehenderit nam saepe eum quidem,
                                    impedit, similique pariatur illum molestiae. Ab earum aliquid fugit, debitis. Vel
                                    sequi doloribus, hic dolorem quod
                                </p>
                            </blockquote>


                        </div>

                        <div class="col-md-3">

                            <input type="file" name="image" id="image" data-preview-file-type="any" accept="image/*"  required>

                        </div>
                    </div>


                </div>
            </div>

            <h4 class="alert alert-primary">Update bio Data</h4>
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
                        <input type="hidden" name="edit" value="<?php echo $edit_id ?> ">
                        <label for="name" class="text-primary">Full Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Your Full Name" class="form-control"
                               maxlength="20" value="<?php echo $e_name; ?>" required>

                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email" class="text-primary">Email</label>
                        <input type="text" name="email" id="email" placeholder="Enter Valid Email" class="form-control"
                               value="<?php echo $e_email;  ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="phone" class="text-primary">Phone Number</label>
                        <input type="text" name="phone" id="phone" placeholder="Enter your Phone NUmber"
                               class="form-control" maxlength="11" value="<?php echo $e_phone; ?>" required>
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="status" class="text-primary">Program</label>
                        <select class="form-control" name="program" id="program" >
                            <option value="morning" <?php if (isset($e_program) and $e_program == 'morning') {
                                echo "selected";
                            } ?>>Morning
                            </option>
                            <option value="evening" <?php if (isset($e_program) and $e_program == 'evening') {
                                echo "selected";
                            } ?>>Evening
                            </option>
                            <option value="weekend" <?php if (isset($e_program) and $e_program == 'weekend') {
                                echo "selected";
                            } ?>>Weekend
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="status" class="text-primary">Gender</label>
                        <select class="form-control" name="gender" id="gender" >

                            <option value="male" <?php if (isset($e_gender) and $e_gender == 'male') {
                                echo "selected";
                            } ?>>Male
                            </option>
                            <option value="female" <?php if (isset($e_gender) and $e_gender == 'female') {
                                echo "selected";
                            } ?>>Female
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="status" class="text-primary">Level</label>
                        <select class="form-control" name="level" id="level">

                            <option value="nd1" <?php if (isset($e_level) and $e_level == 'nd1') {
                                echo "selected";
                            } ?>>ND1
                            </option>
                            <option value="nd2" <?php if (isset($e_level) and $e_level == 'nd2') {
                                echo "selected";
                            } ?>>ND2
                            </option>
                            <option value="hnd1" <?php if (isset($e_level) and $e_level == 'hnd1') {
                                echo "selected";
                            } ?>>HND1
                            </option>
                            <option value="hnd2" <?php if (isset($e_level) and $e_level == 'hnd2') {
                                echo "selected";
                            } ?>>HND2
                            </option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="status" class="text-primary">Registration Number</label>
                        <input type="text" name="regno" id="regno" placeholder="Enter your Reg Number"
                               class="form-control" value="<?php echo $e_regno; ?>" >
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="status" class="text-primary">Date Of Birth</label>
                        <input type="date" name="dob" id="dob" placeholder="Enter your date of birth" value="<?php echo $e_dob; ?>"
                               class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="status" class="text-primary">Password</label>
                        <input type="hidden" name="oldpassword" value="<?php echo $e_password; ?>">
                        <input type="password" id="password" name="newpassword" class="form-control" value=""
                               placeholder="Leave black if you don't want to change it ">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn  btn-mdb-color waves-ripple rounded btn-md waves-effect waves-light"
                    name="submit">
                <span class="fa fa-send mr-1"></span> &nbsp; Update Data
            </button>
        </form>

    </div>


    <?php require_once('inc/footer.php') ?>
