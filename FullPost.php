<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("include/db.php");
require_once("include/sessions.php");
require_once("include/functions.php");
?>

<?php
if (isset($_POST["Submit"])) {
    $Name = mysqli_real_escape_string($connection, $_POST["Name"]);
    $Email = mysqli_real_escape_string($connection, $_POST["Email"]);
    $Comment = mysqli_real_escape_string($connection, $_POST["Comment"]);
    date_default_timezone_set('Europe/Bucharest');
    $CurrentTime = time();
    $DateTime = date("d-m-Y H:i:s", $CurrentTime);
    $DateTime;
    $PostId = $_GET["id"];
    if (empty($Name) || empty($Email) || empty($Comment)) {
        $_SESSION["ErrorMessage"] = "All fields are required";
    } elseif (strlen($Comment) > 500) {
        $_SESSION["ErrorMessage"] = "Comment is too long";
   
    } else { 
        global $connection;
        $PostIdFromURL = $_GET["id"];
        $query = "INSERT INTO comments(datetime, name, email, comment, status, admin_panel_id)
        VALUES('$DateTime', '$Name', '$Email', '$Comment', 'OFF', '$PostIdFromURL')";
        $execute = mysqli_query($connection, $query);
        if ($execute) {
            $_SESSION["SuccessMessage"] = "Comment added successfully";
            Redirect_to("FullPost.php?id= {$PostId}");
        } else {
            $_SESSION["ErrorMessage"] = "Comment failed to add";
            Redirect_to("FullPost.php?id={$PostId}");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Full Blog post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/publicstyles.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .FieldInfo {
            color: rgb(251, 174, 44);
            font-family: Bitter, Georgia, "Times New Roman", Times, serif;
            font-size: 1.2em;
        }
        .CommentBlock {
            background-color: #f6f7f9;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.navbar-toggle').click(function() {
                $('#collapse').collapse('toggle');
            });
        });
    </script>
</head>
<body>
    <div style="height: 10px; background: #27aae1;"></div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Blog.php">
                    <img style="margin-top: -12px; background-color: white;" src="images/1.png" width="200" height="40" alt="Logo">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">Home</a></li>
                    <li class="active"><a href="Blog.php">Blog</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Features</a></li>
                </ul>
                <form action="Blog.php" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name="Search">
                    </div>
                    <button class="btn btn-default" name="SearchButton">Go</button>
                </form>
            </div>
        </div>
    </nav>
    <div style="height: 10px; margin-top: -20px; background: #27aae1;"></div>
    <div class="container"> <!-- Aici incepe container-ul -->
        <div class="blog-header">
            <h1>Muzike.ro blog</h1>
            <p class="lead">By Razvan</p>
        </div>
        <div class="row">
            <div class="col-sm-8"> <!-- Fereastra principala -->
               
               <?php
                echo Message();
                echo SuccessMessage();
                ?>
               <?php
                global $connection;
                if (isset($_GET["SearchButton"])) {
                    $Search = $_GET["Search"];
                    $ViewQuery = "SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
                } else {
                    $PostIdFromURL = $_GET["id"];
                    if (!isset($PostIdFromURL)) {
                        $_SESSION["ErrorMessage"] = "Bad request!";
                        Redirect_to("Blog.php");
                    }
                    $ViewQuery = "SELECT * FROM admin_panel WHERE id = '$PostIdFromURL' ORDER BY datetime desc";
                }

                $Execute = mysqli_query($connection, $ViewQuery);
                while ($DataRows = mysqli_fetch_array($Execute)) {
                    $PostId = $DataRows["id"];
                    $DateTime = $DataRows["datetime"];
                    $Title = $DataRows["title"];
                    $Category = $DataRows["category"];
                    $Admin = $DataRows["author"];
                    $Image = $DataRows["image"];
                    $Sample = $DataRows["sample"];
                    $Post = $DataRows["post"];
                ?>
                <div class="blogpost thumbnail">
                    <img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?>" alt="">
                    <div class="caption">
                        <h1 id="heading"><?php echo htmlentities($Title); ?></h1>
                        <p class="description">Category: <?php echo htmlentities($Category); ?> Published on <?php echo htmlentities($DateTime); ?></p>
                        <p class="post">
                            <?php
                          
                            echo htmlentities($Post);
                            ?>
                        </p>
                        <div>
                        <h4> Sample Audio </h4>
                            <?php if (!empty($Sample)) { ?>
                            <audio controls >
                                <source src="Samples/<?php echo htmlentities($Sample); ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <span class="FieldInfo">Share your thoughts</span>
                <br>
                <span class="FieldInfo">Comments</span>
                <br>
                <?php
                $connection;
                $PostIdForComments = $_GET["id"];
                $ExtractingCommentsQuery = "SELECT * FROM comments WHERE admin_panel_id = '$PostIdForComments' AND status = 'ON'";
                $Execute = mysqli_query($connection, $ExtractingCommentsQuery);
                while ($DataRows = mysqli_fetch_array($Execute)) {
                    $CommentDate = $DataRows["datetime"];
                    $CommenterName = $DataRows["name"];
                    $Comments = $DataRows["comment"];
                ?>
                <div class="CommentBlock">
                    <img style="margin-left: 10px; margin-top: 10px;" src="images/comment.png" width="70" height="70">
                    <p style="margine-left: 90px" class="Comment-info"><?php echo $CommenterName; ?></p>
                    <p style="margine-left: 90px" class="description"> <?php echo $CommentDate; ?></p>
                    <p style="margine-left: 90px" class="Comment"><?php echo $Comments; ?></p>
                </div>
                <hr>
                <?php
                }
                ?>
                <br>
                <br>

                <div>
                        <form action="FullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
                            <fieldset>    
                                    <div class="form-group">
                                        <label for="Name"><span class="FieldInfo">Name:</span></label>
                                        <input class="form-control" type="text" name="Name" id="Name" placeholder="Name">
                                    </div> <!-- Sfarsitul div-ului form-group -->
                                    <div class="form-group">
                                        <label for="Email"><span class="FieldInfo">Email:</span></label>
                                        <input class="form-control" type="email" name="Email" id="Email" placeholder="Email">
                                    </div> <!-- Sfarsitul div-ului form-group -->

                                    <div class="form-group">
                                        <label for="commantArea"><span class="FieldInfo">Comment:</span></label>
                                        <textarea class="form-control" name="Comment" id="commentArea"></textarea>
                            </fieldset>
                            <br>
                            <input class="btn btn-primary" type="Submit" name="Submit" value="Add comment">
                            <br>
                        </form>
                    </div>
            
       
            </div> <!-- Aici se termina div-ul pentru coloana stanga -->
            <div class="col-sm-offset-1 col-sm-3"> <!-- Fereastra secundara -->
                <h2>Test</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad quis non architecto beatae consequuntur accusamus molestias, maxime nemo optio magnam omnis deleniti asperiores fuga voluptate, porro a excepturi? Deserunt, id.</p>
            </div> <!--Aici se termina div-ul pentru coloana dreapta -->
        </div> <!--Aici se termina div-ul pentru rand -->
    </div> <!-- Aici se termina div-ul pentru container -->
    <div id="Picior">
        <hr><p>Designed by Razvan Bimbasa.</p>
        <hr>
    </div> <!--Aici se termina div-ul pentru footer -->
</body>
</html>