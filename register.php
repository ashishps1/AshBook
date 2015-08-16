<?php include("includes/sessions.php");?>
<?php include("includes/db_connection.php") ?>
<?php include("functions/query_functions.php") ?>
<?php include("functions/common_functions.php") ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>AshBook | Register</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<!--<link rel="stylesheet" type="text/css" href="css/main.css" />-->
<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
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
      
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          <li><a href="login.php">Log In</a></li>
		  <li class="active"><a href="register.php">Register</a></li>
          <li><a href="support.php">Support</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="blog.php">Blog</a></li>
          <li><a href="contact.php">Contact Us</a></li>
        </ul>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content">
      <div class="content_bg">
        <div class="mainbar">
          <div class="article">
			<?php 
				//print_r($_POST);
			if(isset($_POST["name"])&&isset($_POST["user_name"])&&isset($_POST["password"])&&isset($_POST["rep_password"])&&!empty($_POST["name"])&&!empty($_POST["user_name"])&&!empty($_POST["password"])&&!empty($_POST["rep_password"])){
			
				
				$query="INSERT INTO login_info(name, user_name, password";
				
				if(isset($_POST["user_dob"])&&!empty($_POST["user_dob"]))
					$query.=", dob";
				
				if(isset($_POST["user_sex"])&&!empty($_POST["user_sex"]))
					$query.=", sex";
				
				if(isset($_POST["user_email"])&&!empty($_POST["user_email"]))
					$query.=", email";
				
				if(isset($_POST["user_phone"])&&!empty($_POST["user_phone"]))
					$query.=", phone";
				
				if(isset($_POST["user_address"])&&!empty($_POST["user_address"]))
					$query.=", address";
				
				if(isset($_FILES["user_pic"]['name'])&&!empty($_FILES["user_pic"]['name']))
					$query.=", profile_pic";
				
				$query.=") VALUES ('{$_POST["name"]}','{$_POST["user_name"]}','{$_POST["password"]}'";
				
				if(isset($_POST["user_dob"])&&!empty($_POST["user_dob"]))
					$query.=",'{$_POST["user_dob"]}'";
				
				if(isset($_POST["user_sex"])&&!empty($_POST["user_sex"]))
					$query.=",'{$_POST["user_sex"]}'";
				
				if(isset($_POST["user_email"])&&!empty($_POST["user_email"]))
					$query.=",'{$_POST["user_email"]}'";
				
				if(isset($_POST["user_phone"])&&!empty($_POST["user_phone"]))
					$query.=",'{$_POST["user_phone"]}'";
				
				if(isset($_POST["user_address"])&&!empty($_POST["user_address"]))
					$query.=",'{$_POST["user_address"]}'";
				
				if(isset($_FILES['user_pic']['name'])&&!empty($_FILES['user_pic']['name'])){
					$profile_pic = $_FILES['user_pic']['name'];
					$profile_pic_type = $_FILES['user_pic']['type'];
					$profile_pic_size = $_FILES['user_pic']['size']; 
					
					if ((($profile_pic_type == 'image/gif') || ($profile_pic_type == 'image/jpeg') || ($profile_pic_type == 'image/pjpeg') || ($profile_pic_type == 'image/png'))
						&& ($profile_pic_size > 0) ) {
						if ($_FILES['user_pic']['error'] == 0) {
							$target = PATH.$profile_pic;
							if (move_uploaded_file($_FILES['user_pic']['tmp_name'], $target)) {
									 
							}
							else {
								echo '<div class="error">Sorry, there was a problem uploading your screen shot image.</p>';
							}
							 
							 
						}
								
							
					}
					
					else {
						echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
					}
					$query.=", '{$_FILES['user_pic']['name']}'";
					@unlink($_FILES['user_pic']['tmp_name']);
				}	
			
				$query.=")";
				
				if(insert_user_info($query)){
					$_SESSION["name"]=$_POST["name"];
					$_SESSION["username"]=$_POST["user_name"];
					if(isset($_FILES['user_pic']['name'])&&!empty($_FILES['user_pic']['name']))
						$_SESSION["pic"]=$_FILES['user_pic']['name'];
					redirect_to('user_home.php');
				}
				
				else{
					echo "<div class=\"error\">User Name already exists</div>";
				}
				
			}
		?>
            <h2><span>Register</span></h2>
            <div class="clr"></div>
            <form action="register.php" method="post" enctype="multipart/form-data" >
              <ol>
                <li>
                  <label for="name">Name (required)</label>
                  <input id="name" name="name" class="text" />
                </li>
				 <li>
                  <label for="user_name">User Name (required)</label>
                  <input id="user_name" name="user_name" class="text" />
                </li>
				 <li>
                  <label for="password">Password (required)</label>
                  <input type="password" id="password" name="password" class="text" />
                </li>
				 <li>
                  <label for="rep_password">Repeat Password (required)</label>
                  <input type="password" id="rep_password" name="rep_password" class="text" />
					<span id="pass_error"></span></li>
                </li>
                <li>
                  <label for="user_dob">Date Of Birth</label>
                  <input type="text" id="user_dob" name="user_dob" class="datepicker" />
                </li>
				<span><li><label for="user_male">Male</label><input type="radio" name="user_sex" id="user_male" value="Male" />
						<label for="user_female">Female</label><input type="radio" name="user_sex" id="user_female" value="Female" /></li></span>
                <li>
                  <label for="user_email">Email</label>
                  <input type="text" id="user_email" name="user_email" class="text" />
                </li>
				<li>
                  <label for="user_phone">Phone</label>
                  <input type="text" id="user_phone" name="user_phone" class="text" />
                </li>
                <li>
                  <label for="user_address">Address</label>
                  <textarea id="user_address" name="user_address" rows="8" cols="50"></textarea>
                </li>
				<li>
					<label for="user_pic">Profile Pic</label>
					<input type="file" name="user_pic" id="user_pic" />
				</li>
                <li>
                  <input type="image" name="imageField" id="imageField" src="images/submit.gif" class="send" />
                  <div class="clr"></div>
                </li>
              </ol>
            </form>
          </div>
        </div>
        
        <div class="clr"></div>
      </div>
    </div>
  </div>
</div>
<div class="footer">
  <div class="footer_resize">
    <p class="lf">&copy; Copyright <a href="#">AshBook</a>.</p>
    <p class="rf">Layout by Rocket <a href="http://www.rocketwebsitetemplates.com/">Website Templates</a></p>
    <div class="clr"></div>
  </div>
</div>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/main.js"></script>

</html>