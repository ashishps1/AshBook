<?php include("includes/sessions.php");?>
<?php include("includes/db_connection.php") ?>
<?php include("functions/query_functions.php") ?>
<?php include("functions/common_functions.php") ?>

<?php
	if(!isset($_SESSION["username"])||empty($_SESSION["username"]))
		redirect_to('login.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>AshBook | Profile</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
</head>
<body>
<div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
        <h1><a href="#"><span>Ash</span>Book<small>A Social Network</small></a></h1>
      </div>
      <div class="search">
        <form method="post" id="search" action="search.php">
          <span>
          <input type="text" placeholder="Search..." name="search_for" id="search_for" />
          <input name="searchsubmit" type="image" src="images/search.gif" value="Go" id="searchsubmit" class="btn"  />
          </span>
        </form>
        <!--/searchform -->
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          
			<li><?php
				if(isset($_SESSION["pic"])){
					$pic=$_SESSION["pic"];
					echo '<img src="' .PATH.$pic. '" height=30 />';
				}
				else{
					echo '<img src="images/default_pic.jpeg" height=30 />';
				}
			?></li>
			<li><a href="user_timeline.php?user_name=<?php echo $_SESSION["username"]; ?>"><?php echo $_SESSION["name"]; ?></a></li>
			<li><a href="search.php">Search</a></li>
			<li><a href="user_home.php?user_name=<?php echo $_SESSION["username"]; ?>">Home</a></li>
			<li class="active"><a href="user_profile.php?user_name=<?php echo $_SESSION["username"]; ?>">Profile</a></li>
			<li><a href="user_notifications.php?user_name=<?php echo $_SESSION["username"]; ?>">Notifications</a></li>
			<li><a href="user_friends.php?user_name=<?php echo $_SESSION["username"]; ?>">Friends</a></li>
			<li><a href="requests.php?user_name=<?php echo $_SESSION["username"]; ?>">Friend Requests</a></li>
			<li><a href="user_messages.php?user_name=<?php echo $_SESSION["username"]; ?>">Messages</a></li>
			<li><a href="logout.php">Log Out</a></li>
        </ul>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content">
      <div class="content_bg">
        <div class="mainbar">
          <div class="article">
		  
			<?php
				if(isset($_POST["add_friend"])){
					
					$user_request=$_POST["add_request"];
					$user_name=$_SESSION["username"];
					$res=make_friend_request($_SESSION["username"],$user_request);

					if($res==1){
						$_SESSION["message"]="Friend Request Sent Successfully";
						echo $_SESSION["message"];
					}
					else if($res==2){
						
						$_SESSION["message"]="You already sent friend request";
						echo $_SESSION["message"];
						
						
					}
					else{
						
						$_SESSION["message"]="Friend request failed";
						echo $_SESSION["message"];
						
					}
					redirect_to("user_profile.php?user_name={$user_request}");
					
				}
			?>
		  
			<?php 
			$user_name=$_GET["user_name"];
			$result=get_user_profile($user_name);
			
			$row=mysqli_fetch_assoc($result);
			$friend_list=$row["friends"];
			$friend_list=trim($friend_list);
			$friend_list=explode(' ',$friend_list);
			
			echo "<table class=\"profile\">";
			
			if(isset($row["profile_pic"])&&!empty($row["profile_pic"])){
				echo "<tr><td>Profile Pic</td>";
				$pic=$row["profile_pic"];
				echo '<td><img src="' .PATH.$pic. '" height=80 width="100" /></td></tr>';
			}
			
			else{
				echo "<tr><td>Profile Pic</td>";
				echo '<td><img src="images/default_pic.jpeg" height=60 /></td></tr>';
			}
			
			echo "<tr><td>Name</td>";
			echo "<td>{$row['name']}</td></tr>";
			
			echo "<tr><td>User Name</td>";
			echo "<td>{$row['user_name']}</td></tr>";
			
			
			if(isset($row["dob"])&&!empty($row["dob"])){
				echo "<tr><td>Date of Birth</td>";
				echo "<td>{$row['dob']}</td></tr>";
			}
			
			if(isset($row["sex"])&&!empty($row["sex"])){
				echo "<tr><td>Sex</td>";
				echo "<td>{$row['sex']}</td></tr>";
			}
			
			if(isset($row["email"])&&!empty($row["email"])){
				echo "<tr><td>Email</td>";
				echo "<td>{$row['email']}</td></tr>";
			}
			
			if(isset($row["phone"])&&!empty($row["phone"])){
				echo "<tr><td>Phone</td>";
				echo "<td>{$row['phone']}</td></tr>";
			}
			
			if(isset($row["address"])&&!empty($row["address"])){
				echo "<tr><td>Address</td>";
				echo "<td>{$row['address']}</td></tr>";
			}		
				
			//echo "</table>";
				
		?>
		
		<?php if($row["user_name"]!=$_SESSION["username"]&&!in_array($_SESSION["username"],$friend_list)) { ?>
			<form method="post" action="user_profile.php" >
				
					<br><br>
					
						<label for="add_request"></label><input type="text" style="display:none" name="add_request" id="add_request" value=<?php echo $row["user_name"]  ?> /></li>
					    <tr><td><label for="add_friend"></label><input type="submit" name="add_friend" id="add_friend" value="Add Friend" /></li></td>
					
				</div>
			</form>
		<?php } ?>
		
		<?php
			if(isset($_POST["message_text"])&&isset($_POST["post_message"])&&!empty($_POST["message_text"])){
				
				if(make_message($_row["user_name"],$_POST["message_text"])){
					
				}
				else{
					echo "<div class=\"error\">Message Sending Failed.</div>";
					
				}
				
			}
		?>
          </div>
		  
		 <td><a class="user_link" href="user_timeline.php?user_req=<?php echo $row["user_name"]?>">View Timeline</a></td></tr>
			<td><input type="button" id="new_message" value="Message" /></td></tr>
		</table>
		<form method="post" action="make_message.php">
			<input type="text" style="display:none" name="user_request" value=<?php echo $row["user_name"]; ?> />
			<input type="text" style="display:none" class="post_box" id="message_text" name="message_text" placeholder=<?php echo 'Say Something'; ?> />
			<input type="submit"  id="post_message" name="post_message" value="Message" />
		</form>
        </div>
        
        <div class="clr"></div>
      </div>
    </div>
  </div>
</div>
<div class="footer">
  <div class="footer_resize">
    
    <div class="clr"></div>
  </div>
</div>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</html>