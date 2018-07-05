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

		$query = "INSERT chat_members (`chat_id`,`user_id`) VALUES ('$insert_id','$user_id')";
		$result = mysql_query($query);
		$query = "INSERT chat_members (`chat_id`,`user_id`,`status`) VALUES ('$insert_id','$session_user_id','0')";
		$result = mysql_query($query) or mysql_error();
		
	}

	echo json_encode(array('status'=>$result));



?> 