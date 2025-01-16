<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("include/db.php");
require_once("include/sessions.php");
?>

<?php
if (isset($_POST["Submit"])) {
    $Category = mysqli_real_escape_string($connection, $_POST["Category"]);
    date_default_timezone_set('Europe/Bucharest');
$CurrentTime = time();
$DateTime = strftime("%d-%m-%Y %H:%M:%S", $CurrentTime);
$DateTime;
    if (empty($Category)) {
        $_SESSION["ErrorMessage"] = "Please fill out the category name";
        header("Location: dashboard.php");
        exit;
    } else {
        global $connection;
        $query = "INSERT INTO category(datetime, name) VALUES('$DateTime', '$category')";
        $execute = mysqli_query($connection, $query);
        if ($execute) {
            echo "Category added successfully";
        } else {
            echo "Category failed to add";
        }
    }
}
?>

<?php
require_once("include/db.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
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
                <h1>Razvan</h1>
                <li ><a href="dashboard.php">
                <span class="glyphicon glyphicon-th"></span> &nbsp; Dashboard</a> </li> <!-- &nbsp; Asta adauga un spatiu inainte de titlu ca sa nu se suprapuna textul cu iconitele -->
                <li>  <a href="#">
                <span class="glyphicon glyphicon-list-alt"></span> &nbsp;Add new post</a></li>
                <li class="active">    <a href="categories.php">
                <span class="glyphicon glyphicon-tags"></span> &nbsp;Categories</a></li>
                <li>    <a href="#">
                <span class="glyphicon glyphicon-user"></span>&nbsp; Manage admins</a></li>
                <li>    <a href="#">
                <span class="glyphicon glyphicon-comment"></span> &nbsp;Comments</a></li>
                <li>    <a href="#">
                <span class="glyphicon glyphicon-equalizer"></span> &nbsp;Live blog</a></li>
                <li>    <a href="#">
                <span class="glyphicon glyphicon-log-out"></span> &nbsp;Logout</a></li>
                   
                </ul>
            </div> <!--Aici se termina div-ul pentru coloana lateral stanga -->
                <div class="col-sm-10">
                    <h1>Manage categories</h1>
                    <div>
                        <form action="categories.php" method="post">
                            <fieldset>
                                    <div class="form-group">
                                <label for="categoryName">Name</label>
                                <input class="form-control" type="text" name="Category" id="categoryName" placeholder="Name">
</div> <!-- Sfarsitul div-ului form-group -->
                            </fieldset>
                            <br>
                            <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add new Category">
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
