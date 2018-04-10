<?php

	$query = $_GET['query'];

	if(empty($query) ) {
		return;
	}

	$output = apcu_fetch($query, $ok);

	if($ok) {
		echo $output;
		return;
	}

	require_once('db.php');

	$sql = "SELECT name FROM dictionary WHERE name LIKE '{$query}%' LIMIT 15;";

	$sth = $db->prepare($sql);
	$sth->execute();

	$result = $sth->fetchAll(PDO::FETCH_ASSOC);

	$output = json_encode(['query' => $query, 'data' => $result]);

	apcu_store($query, $output, 300);

	echo $output;