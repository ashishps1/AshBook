$(document).ready(function(){
	$('.entry , .login_entry, .comp_entry').focusin(function(){
		
		$(this).addClass('bright_entry');
		
	});
	$('.entry , .login_entry, .comp_entry').focusout(function(){
		
		$(this).removeClass('bright_entry');
		
	});
	
	$('.login_entry').keyup(function(){
		
		var val1=$('#user_name').val();
		var val2=$('#password').val();
		if(val1&&val2){
			$('#login').removeAttr('disabled');
		}
		if(!val1||!val2){
			$('#login').attr('disabled','disabled');
		}
		
	});
	
	$('.comp_entry').keyup(function(){
		var val1=$('#name').val();
		var val2=$('#user_name').val();
		var val3=$('#password').val();
		var val4=$('#rep_password').val();
		if(val1&&val2&&val3&&val4){
			$('#register').removeAttr('disabled');
		}
		if(!val1||!val2||!val3||!val4){
			$('#register').attr('disabled','disabled');
		}
		
	});
	
	$('#rep_password, #password').keyup(function(){
		
		var pass1=$('#password').val();
		var pass2=$('#rep_password').val();
		
		if(!pass1&&!pass2){
			$('#pass_error').text('');
		}
		if(!pass1&&pass2){
			$('#pass_error').text('Incorrect');
		}
		if(pass1&&!pass2){
			$('#pass_error').text('');
		}
		if(pass1&&pass2){
			var j=pass2.length;
			var k=pass1.length;
			if(j>k){
				$('#pass_error').css('color','red');
				$('#pass_error').text('Incorrect');
			}
			else{
				var i=0;
				for(i=0;i<j;i++){
					if(pass2[i]!=pass1[i])
						break;
				}
				if(i==j){
					$('#pass_error').text('');
				}
				else{
					$('#pass_error').css('color','red');
					$('#pass_error').text('Incorrect');
				}
				if(i==k){
					$('#pass_error').css('color','blue');
					$('#pass_error').text('Correct');
				}
			}
		}
		
	});
	
	$('#select_search').change(function(){
		
		var val=$(this).val();
		
		if(val=='name')
			$('#search_value').attr('placeholder','Enter name');
		else if(val=='user_name')
			$('#search_value').attr('placeholder','Enter username');
		else if(val=='email')
			$('#search_value').attr('placeholder','Enter email');
		else if(val=='phone')
			$('#search_value').attr('placeholder','Enter phone');
		else if(val=='address')
			$('#search_value').attr('placeholder','Enter address');
		
	});

	$('#search_value').keyup(function(){
		
		var val=$(this).val();
		if(!val){
			$('#search_button').attr('disabled','disabled');
		}
		else{
			$('#search_button').removeAttr('disabled');
		}
	});
	
	$('#new_message').click(function(){
		$('#message_text').show();
	});
	
	
	$('.datepicker').focus(function(){
		$('.datepicker').datepicker(
		{	
			dateFormat: 'yy-mm-dd',
			changeYear:true,
			changeMonth:true,
			maxDate: "+0D"
		
	}).datepicker('show');
	});
	
});
