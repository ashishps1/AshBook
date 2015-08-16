<?php define('PATH','images/profiles/'); ?>

<?php 
	
	function get_user_login_info($user_name,$password){
		
		global $connection;
		$query= "select * from login_info where user_name='{$user_name}' and password='{$password}'";
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		
		if($row = mysqli_fetch_assoc($result)) {
			$_SESSION["username"] = $user_name;
			$_SESSION["name"]=$row["name"];
			if(isset($row["profile_pic"])&&!empty($row["profile_pic"]))
				$_SESSION["pic"]=$row["profile_pic"];
			return 1;
		}
		return 0;
	}
	
	function insert_user_info($query){
		
		global $connection;
		$result=mysqli_query($connection,$query);
			//die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}
		return 1;
	}
	
	function get_users_for_search($val){
		
		global $connection;
		$query="select * from login_info where name like '%{$val}%' or user_name like '%{$val}%' or email like '%{$val}%' or phone like '%{$val}%' or address like '%{$val}%'";
		$query.="order by name";
		$result=mysqli_query($connection,$query) or
			die("Database query failed: with query {$query} ".mysqli_error($connection));
		
		return $result;
	}
	
	function get_user_profile($user_name){
		global $connection;
		$query="select * from login_info where user_name='{$user_name}'";
		$result=mysqli_query($connection,$query) or
			die("Database query failed: with query {$query} ".mysqli_error($connection));
			
		return $result;	
	}
	
	function make_friend_request($user_name,$user_request){
		global $connection;
		$query1="select requests from login_info where user_name='{$user_request}'";
		$result1=mysqli_query($connection,$query1);
		$request="";
		if($result1){
			$row= mysqli_fetch_assoc($result1);
			$request=$row["requests"];
			
		}
		
		if(strpos($request,$user_name)===false){
			$request=$user_name.' '.$request;
			$query="update login_info set requests='{$request}' where user_name='{$user_request}'";
		
			$result=mysqli_query($connection,$query) or
				die("Database query failed: ".mysqli_error($connection));
			if(!$result){
				return 0;
			}	
			return 1;
		}
		
		return 2;
		
	}
	
	function make_friend($user_name,$user_request){
		global $connection;
		$query="select friends from login_info where user_name='{$user_request}'";
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		$request="";
		if($result){
			$row= mysqli_fetch_assoc($result);
			$request=$row["friends"];
		}
		$request=$user_name.' '.$request;
		
		$query="update login_info set friends='{$request}' where user_name='{$user_request}'";
		
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}

		$query="select friends from login_info where user_name='{$user_name}'";
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		$request="";
		if($result){
			$row= mysqli_fetch_assoc($result);
			$request=$row["friends"];
		}
		$request=$user_request.' '.$request;
		
		$query="update login_info set friends='{$request}' where user_name='{$user_name}'";
		
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}

		$query="select requests from login_info where user_name='{$user_name}'";
		$result=mysqli_query($connection,$query);
		$request="";
		if($result){
			$row= mysqli_fetch_assoc($result);
			$request=$row["requests"];
			
		}
		
		$request=str_replace($user_request,"",$request);
		$query="update login_info set requests='{$request}' where user_name='{$user_name}'";
	
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}

		$query="select requests from login_info where user_name='{$user_request}'";
		$result=mysqli_query($connection,$query);
		$request="";
		if($result){
			$row= mysqli_fetch_assoc($result);
			$request=$row["requests"];
			
		}
		
		$request=str_replace($user_name,"",$request);
		$query="update login_info set requests='{$request}' where user_name='{$user_request}'";
	
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}

		$query="select notifications from login_info where user_name='{$user_request}'";
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		$request="";
		if($result){
			$row= mysqli_fetch_assoc($result);
			$request=$row["notifications"];
		}
		if(isset($_SESSION["pic"])){
			$pic=$_SESSION["pic"];
			$request.='<img src="' .PATH.$pic. '" height=50 />';
		}
		else{
			$request.='<img src="images/default_pic.jpeg" height=45 />';
		}
		$request.=$_SESSION["name"].' accepted your friend request. brutus'.$request;
		
		$query="update login_info set notifications='{$request}' where user_name='{$user_request}'";
		
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}
		
		
		return 1;
		
	}
	
	function cancel_request($user_name,$user_request){
		global $connection;
		$query="select requests from login_info where user_name='{$user_name}'";
		$result=mysqli_query($connection,$query);
		$request="";
		if($result){
			$row= mysqli_fetch_assoc($result);
			$request=$row["requests"];
			
		}
		
		$request=str_replace($user_request,"",$request);
		$query="update login_info set requests='{$request}' where user_name='{$user_name}'";
	
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}

		$query="select requests from login_info where user_name='{$user_request}'";
		$result=mysqli_query($connection,$query);
		$request="";
		if($result){
			$row= mysqli_fetch_assoc($result);
			$request=$row["requests"];
			
		}
		
		$request=str_replace($user_name,"",$request);
		$query="update login_info set requests='{$request}' where user_name='{$user_request}'";
	
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}	
		
		return 1;
	
	}
	
	function make_post($user_name,$post){
		
		global $connection;
		$query="select home,timeline from login_info where user_name='{$user_name}'";
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}		
		$row= mysqli_fetch_assoc($result);
		
		$home="";
		$timeline="";
		if(isset($row["home"])){
			$home=$row["home"];
			$timeline=$row["timeline"];
		}
		$home=$post.' brutus '.$home;
		$timeline=$post.' brutus '.$timeline;
		
		$query="update login_info set home='{$home}' where user_name='{$user_name}'";
					
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}	
		$query="update login_info set timeline='{$timeline}' where user_name='{$user_name}'";
		
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}
	
		return 1;
	}
	
	function make_message($user_request,$message){
		
		global $connection;
		$user_name=$_SESSION["username"];
		
		$query="select messages from login_info where user_name='{$user_request}'";
		$result=mysqli_query($connection,$query);
		$request="";
		$request1="";
		if($result){
			$row= mysqli_fetch_assoc($result);
			$request1=$row["messages"];
		}
		
		if(isset($_SESSION["pic"])){
			$pic=$_SESSION["pic"];
			$request.='<img src="' .PATH.$pic. '" height=50 />';
		}
		else{
			$request.='<img src="images/default_pic.jpeg" height=45 />';
		}
		
		$request.='<a href="user_profile.php?user_name='.$_SESSION["username"].'">'.$_SESSION["name"].'</a>';

		$request.=':'.$message.'brutus'.$request1;
		$query="update login_info set messages='{$request}' where user_name='{$user_request}'";
	
		$result=mysqli_query($connection,$query) or
			die("Database query failed: ".mysqli_error($connection));
		if(!$result){
			return 0;
		}
		
		return 1;
	}

?>