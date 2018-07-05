<!DOCTYPE html>
<html>
<head>
	<title>TOK BOX</title>
</head>

<link rel="stylesheet" type="text/css" href="css/app.css">
<body>

	<?php 
	include('conn.php');
	$session_id = 2;

	$query = "SELECT chat_id FROM chat_members WHERE user_id = '$session_id' ";
	$result = mysql_query($query);	
	$chat_ids = array();
	while($row = mysql_fetch_array($result)){
		$chat_ids[]= $row['chat_id'];
	}
	$chat_ids = implode(',',$chat_ids);


	$query = "SELECT user_id FROM chat_members WHERE chat_id IN ($chat_ids)";
	$result = mysql_query($query);
	$user_ids=array(); 
	if($result){
		while($rows = mysql_fetch_array($result)){
			$user_ids[] =$rows['user_id']; 
		}
	}

	?>
	<div id="textchat">
		<div class="username">User : Sivamani</div>

		<div id="user2" class="users" userId = "1">
			BOOMI <?php 

			if(!in_array(1,$user_ids)){
				echo '<button class="btn" onclick="invite(1)" id="btn_1">Invite</button>';					
			} else{				

				$query = "SELECT status,chat_id FROM chat_members WHERE chat_id IN ($chat_ids) AND user_id = '1'";
				$result = mysql_query($query);
				$rows = mysql_fetch_array($result);

				if($rows['status'] == 0){
					echo '<button class="btn" onclick="invite(1)" id="btn_1">Invite</button>'; 							
				}else if($rows['status'] == 1){
					echo '<button class="btn" >Invited</button>'; 				
				}else if($rows['status'] == 2){
					echo '<button class="btn" onclick="approve(1,'.$rows['chat_id'].')" id="btn_1">Approve</button>'; 				
				}else{
					echo '<button class="btn"  id="btn_1">Connected</button>'; 	
				}
			} 
			?>

			
		</div>
		<div id="user3" class="users" userId = "3">
			Narendar <?php 

			if(!in_array(3,$user_ids)){
				echo '<button class="btn" onclick="invite(3)" id="btn_3">Invite</button>';					
			} else{				

				$query = "SELECT status,chat_id FROM chat_members WHERE chat_id IN ($chat_ids) AND user_id = '3'";
				$result = mysql_query($query);
				$rows = mysql_fetch_array($result);				

				if($rows['status'] == 0){
					echo '<button class="btn" onclick="invite(3)" id="btn_3">Invite</button>'; 							
				}else if($rows['status'] == 1){
					echo '<button class="btn" >Invited</button>'; 				
				}else if($rows['status'] == 2){
					echo '<button class="btn" onclick="approve(3,'.$rows['chat_id'].')" id="btn_3">Approve</button>'; 				
				}else{
					echo '<button class="btn"  id="btn_3">Connected</button>'; 	
				}
			} 



			 

			?>
		</div> 
		<div id="user4" class="users" userId = "4">
			Vijay <?php 

			if(!in_array(4,$user_ids)){
				echo '<button class="btn" onclick="invite(3)" id="btn_4">Invite</button>';					
			} else{				

				$query = "SELECT status,chat_id FROM chat_members WHERE chat_id IN ($chat_ids) AND user_id = '4'";
				$result = mysql_query($query);
				$rows = mysql_fetch_array($result);
				
				if($rows['status'] == 0){
					echo '<button class="btn" onclick="invite(4)" id="btn_4">Invite</button>'; 							
				}else if($rows['status'] == 1){
					echo '<button class="btn" >Invited</button>'; 				
				}else if($rows['status'] == 2){
					echo '<button class="btn" onclick="approve(4,'.$rows['chat_id'].')" id="btn_4">Approve</button>'; 				
				}else{
					echo '<button class="btn"  id="btn_4">Connected</button>'; 	
				}
			} 
			
			?>
		</div>		
		<br><br>
		<p id="history"></p>
		<form>
			<input type="text" placeholder="Input your text here" id="msgTxt"></input>
		</form>
	</div>


	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>	
	<script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
	<!-- <script type="text/javascript" src="js/app.js"></script> -->
	<script type="text/javascript">
		function invite(user_id){
			$('#btn_'+user_id).text('Please wait . . ');
			$.post('invite.php',{session_id:2,user_id:user_id},function(res){
				$('#btn_'+user_id).text('Invited');
				initializeSession(res);			
				
			});
		}
		function approve(user_id,chat_id){
			$('#btn_'+user_id).text('Please wait . . ');
			$.post('approve.php',{chat_id:chat_id,user_id:user_id},function(res){
				$('#btn_'+user_id).text('Connected');	
				initializeSession(res);	
				
			});
		}


		$('.users').click(function(){
			var user_id = $(this).attr('userId');
			$('.users').removeClass('active');
			$(this).addClass('active');
			// $.post('session.php',{user_id:user_id},function(res){
			// 	console.log(res);
			// });

		});
	</script>
</body>
</html>



