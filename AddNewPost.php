<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("include/db.php");
require_once("include/sessions.php");
require_once("include/functions.php");
?>

<?php
if (isset($_POST["Submit"])) {
    $Category = mysqli_real_escape_string($connection, $_POST["Category"]);
    date_default_timezone_set('Europe/Bucharest');
$CurrentTime = time();
$DateTime = date("d-m-Y H:i:s", $CurrentTime);
$DateTime;
$Admin = "Razvan";
    if (empty($Category)) {
        $_SESSION["ErrorMessage"] = "Please fill out the category name";
        Redirect_to("categories.php");
       
    }elseif (strlen($Category) > 99) {
        $_SESSION["ErrorMessage"] = "Category name is too long";
        Redirect_to("categories.php");
    } else {
        global $connection;
        $query = "SELECT * FROM category WHERE name = '$Category'";
        $execute = mysqli_query($connection, $query);
        if (mysqli_num_rows($execute) > 0) {
            $_SESSION["ErrorMessage"] = "Category already exists";
            Redirect_to("categories.php");
        } else {
            $query = "INSERT INTO category(datetime, name, createdby)
            VALUES('$DateTime', '$Category', '$Admin')";
            $execute = mysqli_query($connection, $query);
            if ($execute) {
                $_SESSION["SuccessMessage"] = "Category added successfully";
                Redirect_to("categories.php");
             
            } else {
                $_SESSION["ErrorMessage"] = "Category failed to add";
                Redirect_to("categories.php");
                
            }
        }
    }
        global $connection;
        $query = "INSERT INTO category(datetime, name, createdby)
        VALUES('$DateTime', '$Category', '$Admin')";
        $execute = mysqli_query($connection, $query);
        if ($execute) {
            $_SESSION["SuccessMessage"] = "Category added successfully";
            Redirect_to("categories.php");
         
        } else {
            $_SESSION["ErrorMessage"] = "Category failed to add";
            Redirect_to("categories.php");
            
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
               
                <li ><a href="dashboard.php">
                <span class="glyphicon glyphicon-th"></span> &nbsp; Dashboard</a> </li> <!-- &nbsp; Asta adauga un spatiu inainte de titlu ca sa nu se suprapuna textul cu iconitele -->
                <li>  <a href="AddNewPost.php">
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
                        <?php echo Message();
                        echo SuccessMessage(); ?>
                    </div>
                    <div>
                        <form action="categories.php" method="post">
                            <fieldset>
                                    <div class="form-group">
                                <label for="categoryName"><span class="FieldInfo">Insert category name:</span></label>
                                <input class="form-control" type="text" name="Category" id="categoryName" placeholder="Name">
</div> <!-- Sfarsitul div-ului form-group -->
                            </fieldset>
                            <br>
                            <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add new Category">
                            <br>
                        </form>
                    </div>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr>
                <th>No.</th>
                <th>Date & Time</th>
                <th>Category Name</th>
                <th>Creator Name</th>
                <th>Action</th>
            </tr>
            <?php
            global $connection;
            $viewquery = "SELECT * FROM category ORDER BY datetime desc";
            $execute = mysqli_query($connection, $viewquery);
            $SrNo = 0; // variabila pentru numarul de ordine
            while ($DataRows = mysqli_fetch_array($execute)) {
                $Id = $DataRows["id"];
                $DateTime = $DataRows["datetime"];
                $CategoryName = $DataRows["name"];
                $CreatorName = $DataRows["createdby"];
                $SrNo++;
            ?>
            <tr>
                <td><?php echo $SrNo; ?></td>
                <td><?php echo $DateTime; ?></td>
                <td><?php echo $CategoryName; ?></td>
                <td><?php echo $CreatorName; ?></td>
                <td><a href="#">Delete</a></td>
            </tr>
                <?php
                }
                ?>
        </table>
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
