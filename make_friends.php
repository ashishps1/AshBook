<?php include("includes/sessions.php");?>
<?php include("includes/db_connection.php") ?>
<?php include("functions/query_functions.php") ?>
<?php include("functions/common_functions.php") ?>

<?php
	if(!isset($_SESSION["username"])||empty($_SESSION["username"]))
		redirect_to('login.php');
?>

<?php

	$user_request=$_POST["add_request"];
	$user_name=$_SESSION["username"];
	$res=make_friend_request($_SESSION["username"],$user_request);
	
		
	if($res==1){
		$_SESSION["message"]="Hell happenes";
		redirect_to("user_profile.php?user_name={$user_request}");
	}
	else if($res==2){
		
		echo "<div class=\"error\">You already sent friend request</div>";
		
	}
	else{
		
		echo "<div class=\"error\">Friend request failed</div>";
		
	}
	

?>