<?php
require_once('inc/top.php');
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$session_username = $_SESSION['username'];
$session_role = $_SESSION['role'];
$session_author_image = $_SESSION['author_image'];

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    if ($session_role == 'admin') {
        $get_query = $con->prepare("SELECT * FROM posts WHERE id = ?");
        $get_query->execute(array($edit_id));
    } else if ($session_role == 'author') {
        $get_query = $con->prepare("SELECT * FROM posts WHERE id = ? and author = ?");
        $get_query->execute(array($edit_id, $session_username));
    }

    if ($get_query->rowCount() > 0) {
        $get_row = $get_query->fetch();
        $title = $get_row['title'];
        $post_data = $get_row['post_data'];
        $tags = $get_row['tags'];
        $image = $get_row['image'];
        $status = $get_row['status'];
        $categories = $get_row['categories'];
    } else {
        header('location: posts.php');
    }
} else {
    header('location: posts.php');
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
                if (isset($_POST['update'])) {
                    $up_title = $_POST['title'];
                    $up_post_data = $_POST['post-data'];
                    $up_categories = $_POST['categories'];
                    $up_tags = $_POST['tags'];
                    $up_status = $_POST['status'];
                    $up_image = $_FILES['image']['name'];
                    $up_tmp_name = $_FILES['image']['tmp_name'];

                    if (empty($up_image)) {
                        $up_image = $image;
                    }

                    if (empty($up_title) or empty($up_post_data) or empty($up_tags) or empty($up_image)) {
                        $error = "All (*) Fields Are Required";

                    } else {
                        $update_query = $con->prepare("UPDATE posts SET title = ?, image = ?, categories = ?,tags = ?, post_data = ?, status = ? WHERE id = ?");
                        $update_query->execute(array($up_title,$up_image,$up_categories,$up_tags,$up_post_data,$up_status,$edit_id));
                        if ($update_query->execute()) {
                            $msg = "Post Has Been Updated";
                            $path = "img/$up_image";
//                            header("location: edit-post.php?edit=$edit_id");
                            if (!empty($up_image)) {
                                if (move_uploaded_file($up_tmp_name, $path)) {
                                    copy($path, "../$path");
                                }
                            }
                        } else {
                            $error = "Post Has not Been Updated";
                        }
                    }
                }
                ?>


                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post" enctype="multipart/form-data">
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
                                       } ?>"
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <a href="media.php" class="btn btn-primary">Add Media</a>
                            </div>

                            <div class="form-group">
                                <textarea name="post-data" id="textarea" rows="10"
                                          class="form-control"><?php if (isset($post_data)) {
                                        echo $post_data;
                                    } ?></textarea>
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
                                        <select class="form-control" name="categories" id="categories"><?php
                                            $query = $con->prepare("SELECT * FROM categories ORDER BY id DESC");
                                            $query->execute();
                                            if ($query->rowCount() > 0) {
                                                while ($row = $query->fetch()) {
                                                    $cat_name = $row['category'];
                                                    echo "<option value='" . $cat_name . "' " . ((isset($categories) and $categories == $cat_name) ? "selected" : "") . ">" . ucfirst($cat_name) . "</option>";
                                                }
                                            } else {
                                                echo "<cetner><h6>No Category Available</h6></center>";
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
                                               class="form-control input-group-lg" value="<?php if (isset($tags)) {
                                            echo $tags;
                                        } ?>">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="status">Status:*</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="publish" <?php if (isset($status) and $status == 'publish') {
                                                echo "selected";
                                            } ?>>Publish
                                            </option>
                                            <option value="draft" <?php if (isset($status) and $status == 'draft') {
                                                echo "selected";
                                            } ?>>Draft
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Add Post" name="update">
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <?php require_once('inc/footer.php') ?>
