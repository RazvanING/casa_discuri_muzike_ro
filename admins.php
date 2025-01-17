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
    $Username = mysqli_real_escape_string($connection, $_POST["Username"]);
    $Password = mysqli_real_escape_string($connection, $_POST["Password"]);
    $ConfirmPassword = mysqli_real_escape_string($connection, $_POST["ConfirmPassword"]);
    date_default_timezone_set('Europe/Bucharest');
$CurrentTime = time();
$DateTime = date("d-m-Y H:i:s", $CurrentTime);
$DateTime;
$Admin = "Razvan";
    if (empty($Username) || empty($Password) || empty($ConfirmPassword)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect_to("admins.php");
    } elseif (strlen($Password) < 10) {
    // TODO ADD MORE SECURITY
        $_SESSION["ErrorMessage"] = "Password should be at least 10 characters";
        Redirect_to("admins.php");
    } elseif ($Password !== $ConfirmPassword) {
        $_SESSION["ErrorMessage"] = "Passwords do not match";
        Redirect_to("admins.php");
    } else {
        global $connection;
        $query = "SELECT * FROM registration WHERE username = '$Username'";
        $execute = mysqli_query($connection, $query);
        if (mysqli_num_rows($execute) > 0) {
            $_SESSION["ErrorMessage"] = "Username already exists";
            Redirect_to("admins.php");
        } else {
            $query = "INSERT INTO registration(datetime, username, password, addedby)
            VALUES('$DateTime', '$Username', '$Password', '$Admin')";
            $execute = mysqli_query($connection, $query);
            if ($execute) {
                $_SESSION["SuccessMessage"] = "Admin added successfully";
                Redirect_to("admins.php");
            } else {
                $_SESSION["ErrorMessage"] = "Admin failed to add";
                Redirect_to("admins.php");
            }
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
        <title>Manage Admins</title>
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
                <li >    <a href="categories.php">
                <span class="glyphicon glyphicon-tags"></span> &nbsp;Categories</a></li>
                <li class="active">    <a href="admins.php">
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
                    <h1>Manage admin access</h1>
                    <div>
                        <?php echo Message();
                        echo SuccessMessage(); ?>
                    </div>
                    <div>
                        <form action="admins.php" method="post">
                            <fieldset>
                                    <div class="form-group">
                                <label for="Username"><span class="FieldInfo">Username:</span></label>
                                <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                <label for="Password"><span class="FieldInfo">Password:</span></label>
                                <input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                <label for="ConfirmPassword"><span class="FieldInfo">Confirm password:</span></label>
                                <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Confirm password">
                                </div>

                            </fieldset>
                            <br>
                            <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add new admin">
                            <br>
                        </form>
                    </div>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr>
                <th>No.</th>
                <th>Date & Time</th>
                <th>Admin Name</th>
                <th>Created by</th>
                <th>Action</th>
            </tr>
            <?php
            global $connection;
            $viewquery = "SELECT * FROM registration ORDER BY datetime desc";
            $execute = mysqli_query($connection, $viewquery);
            $SrNo = 0; // variabila pentru numarul de ordine
            while ($DataRows = mysqli_fetch_array($execute)) {
                $Id = $DataRows["id"];
                $DateTime = $DataRows["datetime"];
                $AdminName = $DataRows["username"];
                $CreatorName = $DataRows["addedby"];
                $SrNo++;
            ?>
            <tr>
                <td><?php echo $SrNo; ?></td>
                <td><?php echo $DateTime; ?></td>
                <td><?php echo $AdminName; ?></td>
                <td><?php echo $CreatorName; ?></td>
                <td><a href="deleteAdmin.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a></td>
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
