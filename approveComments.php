<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php
if(isset($_GET["id"])){
    $IdFromURL = $_GET["id"];
    $connection;
    $Query = "UPDATE comments SET status='ON' WHERE id='$IdFromURL'";
    $Execute = mysqli_query($connection, $Query);
    if($Execute){
        $_SESSION["SuccessMessage"] = "Comment Approved Successfully";
        Redirect_to("comments.php");
    }else{
        $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
        Redirect_to("comments.php");
    }
}
?>

