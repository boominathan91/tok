<?php 

@session_start();
require "conn.php";
require "vendor/autoload.php";

$apiKey = '46145352';
$apiSecret = 'ba588dc2fd5ff997c82add14f3d32778566ffc7f';
$token =array();

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;

$opentok = new OpenTok($apiKey, $apiSecret);


if(!empty($_POST['user_id'])){

		$user_id = $_POST['user_id'];
		// Create a session that attempts to use peer-to-peer streaming:
		$session = $opentok->createSession();

		// A session that uses the OpenTok Media Router, which is required for archiving:
		$session = $opentok->createSession(array( 'mediaMode' => MediaMode::ROUTED ));

		// A session with a location hint:
		$session = $opentok->createSession(array( 'location' => '12.34.56.78' ));

		// An automatically archived session:
		$sessionOptions = array(
		// 'archiveMode' => ArchiveMode::ALWAYS,
			'mediaMode' => MediaMode::ROUTED
		);
		$opentok->createSession($sessionOptions);
		// Store this sessionId in the database for later use
		
		$session_id =  $session->getSessionId();

		$query = "INSERT chat_group_details (`session_id`,`type`) VALUES ('$session_id','1-1')";
		$result = mysql_query($query) or mysql_error();
		$insert_id = mysql_insert_id();

		$session_user_id = $_POST['session_id'];
		$token['apiKey'] ='46145352';
		$token['session_id'] = $session_id;

		$query = "INSERT chat_members (`chat_id`,`user_id`) VALUES ('$insert_id','$user_id')";
		$result = mysql_query($query);
		$query = "INSERT chat_members (`chat_id`,`user_id`,`status`) VALUES ('$insert_id','$session_user_id','2')";
		$result = mysql_query($query) or mysql_error();

		// Replace with meaningful metadata for the connection:
	$connectionMetaData = "username=Boomi,user_id=1";

		// Replace with the correct session ID:
		$token['token']  = $opentok->generateToken($token['session_id'],array('expireTime' => time()+(7 * 24 * 60 * 60), 'data' =>  $connectionMetaData));


		
	}



	echo json_encode($token);



?> 