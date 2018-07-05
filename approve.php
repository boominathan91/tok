<?php 

//@session_start();
require "conn.php";
require "vendor/autoload.php";

$token =array();

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;

$opentok = new OpenTok($apiKey, $apiSecret);
$token = array();

if(!empty($_POST['user_id'])){
	$query = "UPDATE chat_members SET `status` = '3' WHERE chat_id = '$_POST[chat_id]' ";
	$result = mysql_query($query);

	$query1 = "SELECT session_id FROM chat_group_details WHERE chat_id = '$_POST[chat_id]'";
	$result = mysql_query($query1);
	$row = mysql_fetch_array($result);
	$token = array();

	$token['session_id'] =$row['session_id'];
	$token['apiKey'] ='46145352';
	

	// Replace with meaningful metadata for the connection:
	$connectionMetaData = "username=Boomi,user_id=1";
	
	// Replace with the correct session ID:
	$token['token']  = $opentok->generateToken($token['session_id'],array('expireTime' => time()+(7 * 24 * 60 * 60), 'data' =>  $connectionMetaData));

	echo json_encode($token);

}

?>