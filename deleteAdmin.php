<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php Confirm_Login(); ?>
<?php
    if (isset($_GET["id"])) {
        $IdFromURL = $_GET["id"];
        $connection;
        $Query = "DELETE FROM admin WHERE id='$IdFromURL'";
        $Execute = mysqli_query($connection, $Query);
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Admin Deleted Successfully";
            Redirect_to("admins.php");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
            Redirect_to("admins.php");
        }
    }