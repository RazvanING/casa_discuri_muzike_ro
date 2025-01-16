<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
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
                <li class="active"><a href="dashboard.php">
                <span class="glyphicon glyphicon-th"></span> &nbsp; Dashboard</a> </li> <!-- &nbsp; Asta adauga un spatiu inainte de titlu ca sa nu se suprapuna textul cu iconitele -->
                <li>  <a href="AddNewPost.php">
                <span class="glyphicon glyphicon-list-alt"></span> &nbsp;Add new post</a></li>
                <li>    <a href="categories.php">
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
                    
                    <h1>Admin Dashboard</h1>
                    <div>
                        <?php echo Message();
                        echo SuccessMessage(); ?>
                    </div>
                    <h4>About</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>
                    <h4> about us</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit labore accusantium deserunt dolore est animi nesciunt, voluptatibus at maiores, laudantium pariatur impedit perferendis aliquam libero iusto iure quas et aliquid!</p>

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
