<?php
header('Content-type: application/json');
require_once 'libraries/Mysqli.php';

// istanza della classe
$db = new Database_Mysqli('localhost', 'root', '', 'jowa');

$real_page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$page = $real_page - 1;
$offset = $page * 10;

$limit = 10;

$db->query("SELECT * FROM jowa_videos ORDER BY position ASC LIMIT {$offset}, {$limit}");
$videos = $db->fetchAll(Database_Mysqli::FETCH_OBJ);

if(count($videos) == 0){
	echo json_encode(array());
	die;
}

$tbody = '';
foreach($videos as $video){
	$tbody .= '
		<tr class="ui-state-default" data-elementid="'.$video->id.'">
			<td class="">
				#'.$video->id.'
			</td>
			<td>'.$video->user_id.'</td>
			<td>'.$video->title.'</td>
			<td>
				'.substr($video->description, 0, 100).'
				...
			</td>
			<td>
				'. ($video->lenght_seconds / 60) .' minuti
				<br>
				('. $video->lenght_seconds. ' secondi)
			</td>
			<td><a href="https://youtu.be/'.$video->id_youtube.'" target="_blank">'.$video->id_youtube.'</a></td>
			<td>'.$video->ts_uploaded.'</td>
			<td class="srtbl-move">
				'.$video->position.'
				<i class="glyphicon glyphicon-move"></i>
			</td>
		</tr>';
}


echo json_encode(array('success' => true, 'tbody' => $tbody));
die;
?>
