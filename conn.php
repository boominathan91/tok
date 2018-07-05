<?php 
	mysql_connect('localhost','root','');
	$conn = mysql_select_db('tok_box');
	if(!$conn){
		echo mysql_error();
	}
 ?>