<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("include/db.php");
require_once("include/sessions.php");
require_once("include/functions.php");
?>

<?php
if (isset($_POST["Submit"])) {
    $Username = mysqli_real_escape_string($connection, $_POST["Username"]);
    $Password = mysqli_real_escape_string($connection, $_POST["Password"]);
    
  
    if (empty($Username) || empty($Password)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect_to("Login.php");
    }

        else {
               $Found_Account = Login_Attempt($Username, $Password);
                if ($Found_Account) {
                     $_SESSION["User_Id"] = $Found_Account["id"];
                     $_SESSION["Username"] = $Found_Account["username"];
                     $_SESSION["SuccessMessage"] = "Welcome {$_SESSION["Username"]}";
                     Redirect_to("dashboard.php");
            } else {
                $_SESSION["ErrorMessage"] = "Invalid Username / Password";
                Redirect_to("Login.php");
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
        <style>
                body{
                    background-color: #ffffff;
                }
        </style>
        
    </head>
    <body>
        <div class="container-fluid">
        <div class="row">
            
                <div class="col-sm-offset-4 col-sm-4">
                <div>
                <br><br><br><br>
                        <?php echo Message();
                        echo SuccessMessage(); ?>
                    </div>
                    
                    <h2>Welcome!</h2>
                  
                    <div>
                        <form action="Login.php" method="post">
                            <fieldset>
                                    <div class="form-group">
                                <label for="Username"><span class="FieldInfo">Username:</span></label>
                                <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                <label for="Password"><span class="FieldInfo">Password:</span></label>
                                <input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
                                </div>
                                

                            </fieldset>
                            <br>
                            <input class="btn btn-info btn-block" type="Submit" name="Submit" value="Login">
                            <br>
                        </form>

            </div> <!--Aici se termina div-ul pentru coloane -->
        </div><!--Aici se termina div-ul pentru container-->
 
       
    </body>
</html>
