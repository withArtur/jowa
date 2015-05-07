<?php
header('Content-type: application/json');
require_once 'libraries/Mysqli.php';

// istanza della classe
$db = new Database_Mysqli('localhost', 'root', '', 'jowa');


$id = $_POST['id'];
// js0 - 9 | php1-9
$newPosition = $_POST['position'] + 1;
// paginazione
$real_page = (isset($_POST['page'])) ? $_POST['page'] : 1;
$page = $real_page - 1;
$offset = $page * 10;

$newPosition = $newPosition + $offset;

$db->query('SELECT * FROM `jowa_videos` WHERE id = '. $id);
$item = $db->fetch(Database_Mysqli::FETCH_OBJ);


// movimento down2up
if($newPosition > $item->position){
	$difference = $newPosition - $item->position;  // numero degli lementi interessati
	
	$start = $item->position + 1;

	for($i=0;$i<$difference;$i++){
		$update = array(
			'position' => $start - 1
		);
		$db->update('jowa_videos', $update, "position = {$start}");
		$start++;
	}
	
	
	$update = array(
		'position' => $newPosition
	);
	$db->update('jowa_videos', $update, "id = {$id}");
	
	
	echo json_encode(array('success' => true));
	die;
} else {
// movimento up2down
	$difference = $item->position - $newPosition;  // numero degli elmenti interessati

	$start = $item->position - 1;
	
	for($i=0;$i<$difference;$i++){
		$update = array(
			'position' => $start + 1
		);
		$db->update('jowa_videos', $update, "position = {$start}");
		$start--;
	}
	
	
	$update = array(
		'position' => $newPosition
	);
	$db->update('jowa_videos', $update, "id = {$id}");
	
	
	echo json_encode(array('success' => true));
	die;
}


echo json_encode(array());
die;