<?php

require 'db_settings.php';

class DataBase
{
	public function QueryWithResult($query)
	{
		global $db_settings;
		$link = new mysqli($db_settings['db_host'], $db_settings['login'], $db_settings['pass'], $db_settings['db_name']);
		$result = $link->query($query);
		$over_result = array();
	    while ($row = $result->fetch_assoc()) {
	        $over_result[] = $row;
	    }
	    $link->close();

	    return $over_result;
	}

	public function QueryWithoutResult($query, $return_last_id = false)
	{
		global $db_settings;
		$link = new mysqli($db_settings['db_host'], $db_settings['login'], $db_settings['pass'], $db_settings['db_name']);
		$link->query($query);
		if ($return_last_id)
			$id = $link->insert_id;
		$link->close();
		if($return_last_id)
			return $id;
	}

}

?>
