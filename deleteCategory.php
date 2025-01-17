<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php
    if (isset($_GET["id"])) {
        $IdFromURL = $_GET["id"];
        $connection;
        $Query = "DELETE FROM category WHERE id='$IdFromURL'";
        $Execute = mysqli_query($connection, $Query);
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Category Deleted Successfully";
            Redirect_to("categories.php");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
            Redirect_to("categories.php");
        }
    }