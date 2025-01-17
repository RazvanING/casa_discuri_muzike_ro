<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php Confirm_Login(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Manage Comments</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/adminstyles.css">
        
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
                    <li><a href="Blog.php" target="_blank">Blog</a></li>
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
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                
                <ul id="Side_menu" class="nav nav-pills nav-stacked">
                <br>
                <li ><a href="dashboard.php">
                <span class="glyphicon glyphicon-th"></span> &nbsp; Dashboard</a> </li> <!-- &nbsp; Asta adauga un spatiu inainte de titlu ca sa nu se suprapuna textul cu iconitele -->
                <li>  <a href="AddNewPost.php">
                <span class="glyphicon glyphicon-list-alt"></span> &nbsp;Add new post</a></li>
                <li>    <a href="categories.php">
                <span class="glyphicon glyphicon-tags"></span> &nbsp;Categories</a></li>
                <li>    <a href="#">
                <span class="glyphicon glyphicon-user"></span>&nbsp; Manage admins</a></li>
                <li class="active">    <a href="comments.php">
                <span class="glyphicon glyphicon-comment"></span> &nbsp;Comments</a></li>
                <li>    <a href="#">
                <span class="glyphicon glyphicon-equalizer"></span> &nbsp;Live blog</a></li>
                <li>    <a href="#">
                <span class="glyphicon glyphicon-log-out"></span> &nbsp;Logout</a></li>
                   
                </ul>
            </div> <!--Aici se termina div-ul pentru coloana lateral stanga -->
                <div class="col-sm-10">
                <div>
                        <?php echo Message();
                        echo SuccessMessage(); ?>
                    </div>
                    <h1>Unapproved Comments</h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Comment</th>
                                <th>Approve</th>
                                <th>Delete Comment</th>
                                <th>Details</th>
                            </tr>
                            <?php
                            global $connection;
                            $viewquery = "SELECT * FROM comments WHERE status='OFF' ORDER BY datetime desc";
                            $execute = mysqli_query($connection, $viewquery);
                            $SrNo = 0;
                            while ($DataRows = mysqli_fetch_array($execute)) {
                                $CommentId = $DataRows["id"];
                                $DateTimeOfComment = $DataRows["datetime"];
                                $PersonName = $DataRows["name"];
                                $PersonComment = $DataRows["comment"];
                                $CommentedPostId = $DataRows["admin_panel_id"];
                                $SrNo++;
                                if (strlen($PersonComment) > 18) {
                                    $PersonComment = substr($PersonComment, 0, 18) . '...';
                                }
                                if (strlen($PersonName) > 10) {
                                    $PersonName = substr($PersonName, 0, 10) . '...';
                                }
                                if (strlen($DateTimeOfComment) > 11) {
                                    $DateTimeOfComment = substr($DateTimeOfComment, 0, 11) . '...';
                                }
                                ?>
                                <tr>
                                    <td><?php echo htmlentities($SrNo); ?></td>
                                    <td style="color: #5e5eff;"><?php echo htmlentities($PersonName); ?></td>
                                    <td><?php echo htmlentities($DateTimeOfComment); ?></td>
                                    <td><?php echo htmlentities($PersonComment); ?></td>
                                    <td><a href="ApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span></a></td>
                                    <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
                                    <td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <h1>Approved Comments</h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Comment</th>
                                <th>Approved by</th>
                                <th>Revert Approve</th>
                                <th>Delete Comment</th>
                                <th>Details</th>
                            </tr>
                            <?php
                            global $connection;
                            $Admin = $_SESSION["Username"];
                            $viewquery = "SELECT * FROM comments WHERE status='ON' ORDER BY datetime desc";
                            $execute = mysqli_query($connection, $viewquery);
                            $SrNo = 0;
                            while ($DataRows = mysqli_fetch_array($execute)) {
                                $CommentId = $DataRows["id"];
                                $DateTimeOfComment = $DataRows["datetime"];
                                $PersonName = $DataRows["name"];
                                $PersonComment = $DataRows["comment"];
                                $ApprovedBy = $DataRows["approvedby"];
                                $CommentedPostId = $DataRows["admin_panel_id"];
                                $SrNo++;
                                if (strlen($PersonComment) > 18) {
                                    $PersonComment = substr($PersonComment, 0, 18) . '...';
                                }
                                if (strlen($PersonName) > 10) {
                                    $PersonName = substr($PersonName, 0, 10) . '...';
                                }
                                if (strlen($DateTimeOfComment) > 11) {
                                    $DateTimeOfComment = substr($DateTimeOfComment, 0, 11) . '...';
                                }
                                if (strlen($ApprovedBy) > 10) {
                                    $ApprovedBy = substr($ApprovedBy, 0, 10) . '...';
                                }
                                ?>
                                <tr>
                                    <td><?php echo htmlentities($SrNo); ?></td>
                                    <td style="color: #5e5eff;"><?php echo htmlentities($PersonName); ?></td>
                                    <td><?php echo htmlentities($DateTimeOfComment); ?></td>
                                    <td><?php echo htmlentities($PersonComment); ?></td>
                                    <td><?php echo htmlentities($ApprovedBy); ?></td>
                                    <td><a href="DisApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-warning">Dis-Approve</span></a></td>
                                    <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
                                    <td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
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
