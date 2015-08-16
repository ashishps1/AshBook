<?php include("includes/sessions.php");?>
<?php include("includes/db_connection.php") ?>
<?php include("functions/query_functions.php") ?>
<?php include("functions/common_functions.php") ?>

<?php
	if(!isset($_SESSION["username"])||empty($_SESSION["username"]))
		redirect_to('login.php');

?>


<?php
	if(isset($_POST["message_text"])&&isset($_POST["post_message"])&&!empty($_POST["message_text"])){
		
		if(make_message($_POST["user_request"],$_POST["message_text"])){
			echo "<div class=\"success\">Message Sent Successfully.</div>";
		}
		else{
			echo "<div class=\"error\">Message Sending Failed.</div>";
		}
		
	}
?>