<?php
require_once 'inc/top.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$session_username = $_SESSION['username'];
$session_author_image = $_SESSION['author_image'];

?>
</head>

<body>
<div id="wrapper">
    <?php require_once 'inc/header.php'; ?>
    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">
                <?php require_once 'inc/sidebar.php'; ?>
            </div>
            <div class="col-md-9">
                <h1 class="text-primary"><i class="fa fa-podcast"></i> Add Post
                    <small class="text-secondary">add post</small>
                </h1>
                <hr>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><i class="fa fa-tachometer"></i> Dashboard</li>
                        <li class="breadcrumb-item active"><i class="fa fa-podcast"></i> add post</li>
                    </ol>
                </nav>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $date = time();
                    $title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
                    $post_data = filter_var($_POST['post-data'], FILTER_SANITIZE_STRING);
                    $categories = $_POST['categories'];
                    $tags = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);
                    $status = $_POST['status'];
                    $image = $_FILES['image']['name'];
                    $tmp_name = $_FILES['image']['tmp_name'];


                    if (empty($title) || empty($post_data) || empty($tags) || empty($image)) {
                        $error = 'All (*) Fields Are Required';

                    } else {

                        $stmt = $con->prepare("INSERT INTO
                                                    posts (date,title, author,author_image,image,categories,tags,post_data,views,status )
                                            VALUES
                                                          (:zdate, :ztitle, :zauthor,:zauthor_image,:zimage,:zcategories,:ztags, :zpost_data, '0', :zstatus )");
                        $stmt->execute(array(

                                'zdate' => $date,
                                'ztitle' => $title,
                                'zauthor' => $session_username,
                                'zauthor_image' =>$session_author_image,
                                'zimage' => $image,
                                'zcategories' => $categories,
                                'ztags' => $tags,
                                'zpost_data' => $post_data,
                                'zstatus' => $status
                        ));


                        $msg = 'Post Has Been Added';
                        $path = "img/$image";
                        $title = '';
                        $post_data = '';
                        $tags = '';
                        $status = '';
                        $categories = '';
                        if (move_uploaded_file($tmp_name, $path)) {
                            copy($path, "../$path");
                        } else {
                            $error = 'Post Has not Been Added';
                        }
                    }
                }
                ?>


                <div class="row">
                    <div class="col-md-12">
                        <form  method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <label for="title">Title:*</label>
                                <?php
                                if (isset($msg)) {
                                    echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                } else if (isset($error)) {
                                    echo "<span class='pull-right' style='color:red;'>$error</span>";
                                }
                                ?>
                                <input type="text" name="title" placeholder="Type Post Title Here"
                                       value="<?php if (isset($title)) {
                                           echo $title;
                                       } ?>" class="form-control">
                            </div>

                            <div class="form-group">
                                <a href="media.php" class="btn btn-primary btn-md waves-effect waves-light">Add
                                    Media</a>
                            </div>

                            <div class="form-group">
                                <textarea name="post-data" id="textarea" rows="10"  class="form-control post-data "><?php if(isset($post_data)){echo $post_data;}?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="file">Post Image:*</label>
                                        <input type="file" name="image" id="image" multiple=true
                                               data-preview-file-type="any" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="categories">Categories:*</label>
                                        <select class="form-control" name="categories" id="categories">
                                            <?php
                                            $query = $con->prepare('SELECT * FROM categories ORDER BY id DESC');
                                            $query->execute();
                                            if ($query->rowCount() > 0) {
                                                while ($row = $query->fetch()) {
                                                    $cat_name = $row['category'];
                                                    echo "<option value='" . $cat_name . "' " . ((isset($categories) and $categories === $cat_name) ? 'selected' : '') . '>' . ucfirst($cat_name) . '</option>';
                                                }
                                            } else {
                                                echo '<center><h6>No Category Available</h6></center>';
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tags">Tags:*</label>
                                        <input data-role="tagsinput" type="text" name="tags" id="tags"
                                               placeholder="Your Tags Here"
                                               class="form-control input-group-lg" value="<?php if(isset($tags)){echo $tags;}?>">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="status">Status:*</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="publish" <?php if(isset($status) && $status === 'publish'){echo 'selected';}?>>Publish</option>
                                            <option value="draft" <?php if(isset($status) && $status === 'draft'){echo 'selected';}?>>Draft</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary btn-md waves-effect waves-light"
                                   value="Add Post" name="submit">
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <?php require_once 'inc/footer.php'; ?>
