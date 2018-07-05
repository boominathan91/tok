<?php 

	include('conn.php');
	if(!empty($_POST['user_id'])){
		$query = "UPDATE chat_members SET `status` = '2' WHERE chat_id = '$_POST[chat_id]' AND user_id = '$_POST[user_id]'";
		echo $result = mysql_query($query);
	}

 ?>