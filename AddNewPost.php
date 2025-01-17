<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("include/db.php");
require_once("include/sessions.php");
require_once("include/functions.php");
?>
<?php Confirm_Login(); ?>

<?php
if (isset($_POST["Submit"])) {
    $Title = mysqli_real_escape_string($connection, $_POST["Title"]);
    $Category = mysqli_real_escape_string($connection, $_POST["Category"]);
    $Post = mysqli_real_escape_string($connection, $_POST["Post"]);
    date_default_timezone_set('Europe/Bucharest');
$CurrentTime = time();
$DateTime = date("d-m-Y H:i:s", $CurrentTime);
$DateTime;
$Admin = "Razvan";
$Image = mysqli_real_escape_string($connection, $_FILES["Image"]["name"]);
$Target = "Upload/".basename($_FILES["Image"]["name"]);
$Sample =  mysqli_real_escape_string($connection, $_FILES["Sample"]["name"]);
$SampleTarget = "Samples/".basename($_FILES["Sample"]["name"]);


    if (empty($Title)) {
        $_SESSION["ErrorMessage"] = "Please fill out the title name";
        Redirect_to("AddNewPost.php");
       
    }elseif (strlen($Title) < 2) {
        $_SESSION["ErrorMessage"] = "Title name is too long";
        Redirect_to("AddNewPost.php");
    } else {
        global $connection;
        $query = "SELECT * FROM admin_panel WHERE title = '$Title'";
        $execute = mysqli_query($connection, $query);
        if (mysqli_num_rows($execute) > 0) {
            $_SESSION["ErrorMessage"] = "A post with the same title already exists";
            Redirect_to("AddNewPost.php");
        } else {
            $query = "INSERT INTO admin_panel(datetime, title, category, author, image, sample, post)
            VALUES('$DateTime', '$Title', '$Category', '$Admin', '$Image', '$Sample', '$Post')";
            $execute = mysqli_query($connection, $query);
            move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
            move_uploaded_file($_FILES["Sample"]["tmp_name"], $SampleTarget);
            if ($execute) {
                $_SESSION["SuccessMessage"] = "Post added successfully";
                Redirect_to("AddNewPost.php");
             
            } else {
                $_SESSION["ErrorMessage"] = "Post failed to add";
                Redirect_to("AddNewPost.php");
                
            }
        }
    }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add New Post</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/adminstyles.css">
        
    </head>
    <body>
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                
                <ul id="Side_menu" class="nav nav-pills nav-stacked">
               
                <li ><a href="dashboard.php">
                <span class="glyphicon glyphicon-th"></span> &nbsp; Dashboard</a> </li> <!-- &nbsp; Asta adauga un spatiu inainte de titlu ca sa nu se suprapuna textul cu iconitele -->
                <li class="active">  <a href="AddNewPost.php">
                <span class="glyphicon glyphicon-list-alt"></span> &nbsp;Add new post</a></li>
                <li >    <a href="categories.php">
                <span class="glyphicon glyphicon-tags"></span> &nbsp;Categories</a></li>
                <li>    <a href="admins.php">
                <span class="glyphicon glyphicon-user"></span>&nbsp; Manage admins</a></li>
                <li>    <a href="comments.php">
                <span class="glyphicon glyphicon-comment"></span> &nbsp;Comments</a></li>
                <li>    <a href="liveblog.php">
                <span class="glyphicon glyphicon-equalizer"></span> &nbsp;Live blog</a></li>
                <li>    <a href="logout.php">
                <span class="glyphicon glyphicon-log-out"></span> &nbsp;Logout</a></li>
                   
                </ul>
            </div> <!--Aici se termina div-ul pentru coloana lateral stanga -->
                <div class="col-sm-10">
                    <h1>Add New Post</h1>
                    <div>
                        <?php echo Message();
                        echo SuccessMessage(); ?>
                    </div>
                    <div>
                        <form action="AddNewPost.php" method="post" enctype="multipart/form-data">
                            <fieldset>
                                    <div class="form-group">
                                        <label for="categoryName"><span class="FieldInfo">Title:</span></label>
                                        <input class="form-control" type="text" name="Title" id="title" placeholder="Name">
                                    </div> <!-- Sfarsitul div-ului form-group -->
                                    <div class="form-group">
                                        <label for="categorySelect"><span class="FieldInfo">Category Select:</span></label>
                                        <select class="form-control" id="categorySelect" name="Category">
                                            <?php
                                            global $connection;
                                            $viewquery = "SELECT * FROM category ORDER BY datetime desc";
                                            $execute = mysqli_query($connection, $viewquery);
                                            while ($DataRows = mysqli_fetch_array($execute)) {
                                                $Id = $DataRows["id"];
                                                $CategoryName = $DataRows["name"];
                                            ?>
                                            <option><?php echo $CategoryName; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div> <!-- Sfarsitul div-ului form-group -->
                                    <div class="form-group">
                                        <label for="imageSelect"><span class="FieldInfo">Select Image:</span></label>
                                        <input type="file" class="form-control" name="Image" id="imageSelect">
                                    </div> <!-- Sfarsitul div-ului form-group -->
                                    <div class="form-group">
                                        <label for="sampleSelect"><span class="FieldInfo">Select Sample(under 2mb, mp3 only):</span></label>
                                        <input type="file" class="form-control" name="Sample" id="sampleSelect" accept=".mp3">
                                    </div> <!-- Sfarsitul div-ului form-group -->
                                    <div class="form-group">
                                        <label for="postArea"><span class="FieldInfo">Post:</span></label>
                                        <textarea class="form-control" name="Post" id="postArea"></textarea>
                            </fieldset>
                            <br>
                            <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add new Post">
                            <br>
                        </form>
                    </div>
            
       
                </div> <!--Aici se termina div-ul pentru zona principala de continut -->

            </div> <!--Aici se termina div-ul pentru coloane -->
        </div><!--Aici se termina div-ul pentru container-->
 
        <div id="Footer">
            <hr><p>Designed by Razvan Bimbasa.
            </p>
            <hr>
        </div> <!--Aici se termina div-ul pentru footer -->
    </body>
</html>
