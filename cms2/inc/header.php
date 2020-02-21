<nav class="navbar fixed-top navbar-dark bg-dark navbar-expand-lg navbar-light double-nav scrolling-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php"> computer science </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria- expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Category</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <?php
                  $query = 'SELECT * FROM categories ORDER BY id DESC';
                  $run = mysqli_query($con,$query);
                  if(mysqli_num_rows($run) > 0){
                      while($row = mysqli_fetch_array($run)){
                          $category = ucfirst($row['category']);
                          $id = $row['id'];
                          echo"<a class='dropdown-item' href='index.php?cat=".$id."'>$category</a>";

                      }
                  }
                 else{
                    echo "<a class='dropdown-item' href='#'>No Categories for now</a>";
                  }
                  ?>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a href="" class="nav-link" >About Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="students/register.php">Register</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="students/login.php">Login</a>
                </li>

                

                <li class="nav-item">
                    <a class="nav-link " href="admin/login.php">Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


