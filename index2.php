<!DOCTYPE html>
<html>
<head>
	<title>TOK BOX</title>
</head>

<link rel="stylesheet" type="text/css" href="css/app.css">
<body>

	<?php 
	include('conn.php');
	$session_id = 3;

	 $query = "SELECT * FROM chat_members WHERE user_id = '$session_id' ";
	$result = mysql_query($query);	
	$chat_ids = array();
	while($row = mysql_fetch_array($result)){
		$chat_ids[]= $row['chat_id'];
	}
		$chat_ids = implode(',',$chat_ids);

		// echo '<pre>';
		// print_r($chat_ids);
		// exit;
	

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
		<div id="user1" class="users" userId = "1">
			Boomi  <?php echo (!in_array(1,$user_ids))?'<button class="btn" onclick="invite(1)" id="btn_1">Invite</button>':'<span id="btn_1"></span>'; ?>
		</div>
		<div id="user2" class="users" userId = "2">
			Siva <?php echo (!in_array(2,$user_ids))?'<button class="btn" onclick="invite(2)" id="btn_2">Invite</button>':'<span id="btn_2"></span>'; ?>
		</div>
		<!-- <div id="user3" class="users" userId = "3">
			Narendar <?php echo (!in_array(3,$user_ids))?'<button class="btn" onclick="invite(3)" id="btn_3">Invite</button>':'<span id="btn_3"></span>'; ?>
		</div> -->
		<div id="user4" class="users" userId = "4">
			Vijay <?php echo (!in_array(4,$user_ids))?'<button class="btn" onclick="invite(4)" id="btn_4">Invite</button>':'<span id="btn_4"></span>'; ?>
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
			$.post('invite.php',{session_id:3,user_id:user_id},function(res){
				$('#btn_'+user_id).text('Invited');
				setTimeout(function() {
					$('#btn_'+user_id).remove();	
				}, 2000);
				
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



