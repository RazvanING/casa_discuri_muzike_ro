<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
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
                    <li class="active"><a href="Blog.php" target="_blank">Blog</a></li>
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
                <li class="active"><a href="dashboard.php">
                <span class="glyphicon glyphicon-th"></span> &nbsp; Dashboard</a> </li> <!-- &nbsp; Asta adauga un spatiu inainte de titlu ca sa nu se suprapuna textul cu iconitele -->
                <li>  <a href="AddNewPost.php">
                <span class="glyphicon glyphicon-list-alt"></span> &nbsp;Add new post</a></li>
                <li>    <a href="categories.php">
                <span class="glyphicon glyphicon-tags"></span> &nbsp;Categories</a></li>
                <li>    <a href="admins.php">
                <span class="glyphicon glyphicon-user"></span>&nbsp; Manage admins</a></li>
                <li>    <a href="comments.php">
                <span class="glyphicon glyphicon-comment"></span> &nbsp;Comments
                <?php
                $connection;
                $QueryTotalUnApproved = "SELECT COUNT(*) FROM comments WHERE status='OFF'";
                $ExecuteTotalUnApproved = mysqli_query($connection, $QueryTotalUnApproved);
                $RowsTotalUnApproved = mysqli_fetch_array($ExecuteTotalUnApproved);
                $TotalUnApproved = array_shift($RowsTotalUnApproved);
                if ($TotalUnApproved > 0) {
                    ?>
                    <span class="label label-warning pull-right">
                        <?php echo $TotalUnApproved; ?>
                    </span>
                <?php } ?>
                
            </a></li>
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
                    <h1>Admin Dashboard</h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>No</th>
                                <th>Post Title</th>
                                <th>Date & Time</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Banner</th>
                                <th>Sample</th>
                                <th>Comments</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Details</th>
                            </tr>
                            <?php
                            global $connection;
                            $ViewQuery = "SELECT * FROM admin_panel ORDER BY datetime desc";
                            $Execute = mysqli_query($connection, $ViewQuery);
                            $SrNo = 0;
                            while ($DataRows = mysqli_fetch_array($Execute)) {
                                $Id = $DataRows["id"];
                                $DateTime = $DataRows["datetime"];
                                $Title = $DataRows["title"];
                                $Category = $DataRows["category"];
                                $Admin = $DataRows["author"];
                                $Image = $DataRows["image"];
                                $Sample = $DataRows["sample"];
                                $Post = $DataRows["post"];
                                $SrNo++;
                            
                                ?>
                                <tr>
                                    <td><?php echo $SrNo; ?></td>
                                    <td><?php
                                    if (strlen($Title) > 20) {
                                        $Title = substr($Title, 0, 20) . '...';
                                    }
                                    echo $Title; ?></td>
                                    <td><?php echo $DateTime; ?></td>
                                    <td><?php
                                    if (strlen($Admin) > 6) {
                                        $Admin = substr($Admin, 0, 6) . '...';
                                    }
                                    echo $Admin; ?></td>
                                    <td><?php
                                    if (strlen($Category) > 8) {
                                        $Category = substr($Category, 0, 8) . '...';
                                    }
                                    echo $Category; ?></td>
                                    <td><img src="Upload/<?php echo $Image; ?>" width="100" height="50"></td>
                                    <td>
                                        <?php
                                     if (!empty($Sample)) { ?>
                                    <audio controls >
                                        <source src="Samples/<?php echo $Sample; ?>" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                    <?php } ?>
                                    
                                      

                                    </td>
                                    <td>
                                        <?php
                                        $QueryApproved = "SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
                                        $ExecuteApproved = mysqli_query($connection, $QueryApproved);
                                        $RowsApproved = mysqli_fetch_array($ExecuteApproved);
                                        $TotalApproved = array_shift($RowsApproved);
                                        if ($TotalApproved > 0) {
                                            ?>
                                            <span class="label label-success pull-right">
                                                <?php echo $TotalApproved; ?>
                                            </span>
                                        <?php } ?>
                                        <?php
                                        $QueryUnApproved = "SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='OFF'";
                                        $ExecuteUnApproved = mysqli_query($connection, $QueryUnApproved);
                                        $RowsUnApproved = mysqli_fetch_array($ExecuteUnApproved);
                                        $TotalUnApproved = array_shift($RowsUnApproved);
                                        if ($TotalUnApproved > 0) {
                                            ?>
                                            <span class="label label-danger pull-left">
                                                <?php echo $TotalUnApproved; ?>
                                            </span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                    <a href="EditPost.php?Edit=<?php echo $Id; ?>">
                                            <span class="btn btn-warning"> Edit
                                            </span>
                                            </a>
                                    </td>
                                    <td>
                                        
                                        <a href="DeletePost.php?Delete=<?php echo $Id; ?>"> 
                                        <span class="btn btn-danger">Delete
                                        </span>
                                        </a> 
                                    </td>
                                    <td><a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank">
                                        <span class="btn btn-primary">Live Preview
                                        </span>
                                        </a>
                                        </td>
                                </tr>

                                   

<?php } ?>
                            </table>
                    </div>
                   <p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
<p><br></p>
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
