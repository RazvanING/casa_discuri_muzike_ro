<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_GET["id"])){
    $IdFromURL = $_GET["id"];
    $connection;
    $Query = "UPDATE comments SET status='OFF' WHERE id='$IdFromURL'";
    $Execute = mysqli_query($connection, $Query);
    if($Execute){
        $_SESSION["SuccessMessage"] = "Comment Disapproved Successfully";
        Redirect_to("comments.php");
    }else{
        $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
        Redirect_to("comments.php");
    }
}