<?php

	require_once('db.php');

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;
	}


	$db->beginTransaction();

	for($i = 1; $i <= 50000; $i++) {
			$str = generateRandomString(rand(4, 20) );

			// для разовой задачи делать множественную вставку - избыточно
			$sql = "INSERT INTO dictionary (name) VALUES ('{$str}')";
			$db->exec($sql);
	}

	$db->commit();

	return;
