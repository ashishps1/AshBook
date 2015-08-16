<?php 

	function redirect_to($new_page){
		
		header('Location: '.$new_page);
		exit;
		
	}

?>