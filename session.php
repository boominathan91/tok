<?php 

//@session_start();
require "conn.php";
require "vendor/autoload.php";

$apiKey = '46145352';
$apiSecret = 'ba588dc2fd5ff997c82add14f3d32778566ffc7f';
$token =array();

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;

$opentok = new OpenTok($apiKey, $apiSecret);


if(!empty($_SESSION['user_id'])){

	$query1 = "SELECT session_id FROM user_details WHERE user_id = '$_POST[user_id]' LIMIT 1";
	$result = mysql_query($query1);
	$row = mysql_fetch_array($result);

	if(!empty($row)){
		$token['user_id'] = $row['session_id'];	
		$token['session_id'] = $row['session_id'];	
	}else{ 		
		
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
		$token['session_id'] =  $session->getSessionId();
		$query = "INSERT user_details (`session_id`,`user_id`) VALUES ('$token[session_id]','$_POST[user_id]')";
		$result = mysql_query($query);
		
	}

// Replace with meaningful metadata for the connection:
	$connectionMetaData = "username=Boomi,user_id=1";

// $token['session'] =$sessionId;
	$token['apiKey'] =$apiKey;

// Replace with the correct session ID:
	$token['token']  = $opentok->generateToken($token['session_id'],array('expireTime' => time()+(7 * 24 * 60 * 60), 'data' =>  $connectionMetaData));

}

//$token = $_SESSION;
echo json_encode($token);





?> 