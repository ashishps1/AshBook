<?php include("includes/sessions.php");?>
<?php include("includes/db_connection.php")?>
<?php include("functions/common_functions.php") ?>

<?php 
	
	mysqli_close($connection);
	$_SESSION["username"]=null;
	$_SESSION["name"]=null;
	$_SESSION["pic"]="null";
	redirect_to("login.php");

?>