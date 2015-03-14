<?php
require 'db.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/hello/:name', 'getHowdy');
$app->get('/users','getUsers');
$app->get('/what', 'testConnect');
$app-get('/teams', 'getTeams');

$app->run();

// $app->get('/users','getUsers');
// $app->get('/updates','getUserUpdates');
// $app->post('/updates', 'insertUpdate');
// $app->delete('/updates/delete/:update_id','deleteUpdate');
// $app->get('/users/search/:query','getUserSearch');
// 
// 
// function getUserUpdates() {
// 	$sql = "SELECT
// 				A.user_id,
// 				A.username,
// 				A.name,
// 				A.profile_pic,
// 				B.update_id,
// 				B.user_update,
// 				B.created
// 			FROM
// 				users A, updates B
// 			WHERE
// 				A.user_id=B.user_id_fk
// 			ORDER BY
// 				B.update_id
// 			DESC";
// 	try {
// 		$db = getDB();
// 		$stmt = $db->prepare($sql); 
// 		$stmt->execute();		
// 		$updates = $stmt->fetchAll(PDO::FETCH_OBJ);
// 		$db = null;
// 		echo '{"updates": ' . json_encode($updates) . '}';

// 	} catch(PDOException $e) {
// 	    //error_log($e->getMessage(), 3, '/var/tmp/php.log');
// 		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
// 	}
// }

function getTeams() {
	$sql = "SELECT tname FROM bnp_teams ORDER BY tname";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$teams = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"teams": ' . json_encode($teams) . '}';

	} catch(PDOException $e) {
 		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}


function getHowdy($name) {
	echo "howdy, $name";
}

// GET /api/users
function getUsers() {
	$sql = "SELECT * FROM bnp_schedule";
	$db = getDB();
	try {
		$db = getDB();
		$stmt = $db->query($sql); 
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"users": ' . json_encode($users) . '}';
	} catch(PDOException $e) {
		//error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}


function testConnect() {
	try {	
		$db = getDB();	  
	  	$q = 'SELECT mid, wid, tid1, tid2 FROM bnp_schedule ORDER BY mid ASC';
	  	foreach ($db->query($q) as $r) {
	  		print $r['mid'] . "\t";
	  		print $r['wid'] . "\t";
	  		print $r['tid1'] . "\t";
	  		print $r['tid2'] . "\n";
	  	}

	} catch(PDOException $e) {
	    echo 'ERROR: ' . $e->getMessage();
	}	
}

?>
