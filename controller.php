<?php  

require 'db_settings.php';
require 'db.php';


function Add($data)
{
	$db = new DataBase();
	$phone_list = explode(",", $data['phone_number']);
	if ($data['name'] != NULL && $data['second_name'] != NULL && $data['patronymic'] != NULL & $data['gender'] != NULL && $data['born_date'] != NULL)
	{
		$query_string = 'INSERT INTO client (name, second_name, patronymic, gender, born_date) VALUES ("'.$data['name'].'", "'.$data['second_name'].'", "'.$data['patronymic'].'", '.$data['gender'].', "'.$data['born_date'].'")';
		$id_client = $db->QueryWithoutResult($query_string, true);
		for ($i=0; $i < count($phone_list); $i++) { 
			$query_string = 'SELECT id FROM phone_number WHERE phone_number ="'.$phone_list[$i].'"';
			$id_phone_number = $db->QueryWithResult($query_string);
			if ($id_phone_number)
			{
				$query_string = 'INSERT INTO clients_phone (id_client, id_phone_number) VALUES ('.$id_client.', '.$id_phone_number[0]['id'].')';
				var_dump($query_string);
				$db->QueryWithoutResult($query_string);
				echo "here";
			}
			else
			{
				$query_string = 'INSERT INTO phone_number (phone_number) VALUES ("'.$phone_list[$i].'")';
				$id_phone_number = $db->QueryWithoutResult($query_string, true);
				$query_string = 'INSERT INTO clients_phone (id_client, id_phone_number) VALUES ('.$id_client.', '.$id_phone_number.')';
				$db->QueryWithoutResult($query_string);
				echo "there";
			}
		}
	}
	else{
		echo 'null value';
	}
}

function Search()
{
	$query = $_POST['query'];
	$search_type = $_POST['search_type'];
	$db = new DataBase();
	if ($search_type == "second_name")
		$query_string = 'SELECT id, name, second_name, patronymic FROM client WHERE second_name="'.$query.'"';
	if ($search_type == "phone_number")
		$query_string = 'SELECT client.id, name, second_name, patronymic FROM client, phone_number, clients_phone WHERE clients_phone.id_client = client.id AND clients_phone.id_phone_number = (SELECT id FROM phone_number WHERE phone_number = "'.$query.'")';
	$over_result = $db->QueryWithResult($query_string);
	$display = '<form action="change_values.php" method="post"><div style="height: 300px; overflow-y: scroll;">';
	for ($i = 0; $i < count($over_result); $i++)
		$display = $display.'<p>'.$over_result[$i]['name'].' '.$over_result[$i]['second_name'].' '.$over_result[$i]['patronymic'].' '.'<input name="id" type="radio" value="'.$over_result[$i]['id'].'"></p>';
	$display = $display.'</div><input type="submit" value="Посмотреть карточку"></form>';
	echo($display);
}


function GetAllClients()
{
	$db = new DataBase();
	$query_string = 'SELECT id, name, second_name, patronymic FROM client';
    $over_result = $db->QueryWithResult($query_string);
	$display = '<form action="change_values.php" method="post"><div style="height: 300px; width: 300px; overflow-y: scroll;">';
	for ($i = 0; $i < count($over_result); $i++)
		if ($i == 0)
			$display = $display.'<p>'.$over_result[$i]['name'].' '.$over_result[$i]['second_name'].' '.$over_result[$i]['patronymic'].' '.'<input checked="true" name="id" type="radio" value="'.$over_result[$i]['id'].'"></p>';
		else
			$display = $display.'<p>'.$over_result[$i]['name'].' '.$over_result[$i]['second_name'].' '.$over_result[$i]['patronymic'].' '.'<input checked="true" name="id" type="radio" value="'.$over_result[$i]['id'].'"></p>';
	$display = $display.'</div><input type="submit" value="Посмотреть карточку""></form>';
	echo($display);
}

function Delete()
{
	$data = $_POST;
    $db = new DataBase();
	$query_string = 'DELETE FROM client WHERE id ='.$data['id'];
	$db->QueryWithoutResult($query_string);
}

function Change()
{
	$data = $_POST;
    if ($data['name'] != NULL && $data['second_name'] != NULL && $data['patronymic'] != NULL & $data['gender'] != NULL && $data['born_date'] != NULL)
	{
		$db = new DataBase();
		$query_string = 'UPDATE client SET name ="'.$data['name'].'", second_name ="'.$data['second_name'].'", patronymic ="'.$data['patronymic'].'", gender = '.$data['gender'].', born_date = "'.$data['born_date'].'" WHERE id ='.$data['id'];
		$db->QueryWithoutResult($query_string);
		$query_string = 'SELECT id, name, second_name, patronymic, born_date, gender FROM client WHERE id='.$data['id'];
		$over_result = $db->QueryWithResult($query_string);
		$query_string = 'SELECT phone_number FROM phone_number, clients_phone WHERE clients_phone.id_client='.$data['id'];
		$phone_numbers = $db->QueryWithResult($query_string);
		$phone_numbers_array = array();
		foreach ($phone_numbers as $key => $value) {
			$phone_numbers_array[] = $value['phone_number'];
		}
		$phone_numbers = implode(",", $phone_numbers_array);
		$phone_number_form_textarea = explode(',', $data['phone_number']);
		$query_string = 'DELETE FROM clients_phone WHERE id_client ='.$data['id'];
		$db->QueryWithoutResult($query_string);
		for ($i=0; $i < count($phone_number_form_textarea); $i++) { 
			$query_string = 'INSERT INTO phone_number (phone_number) VALUES ("'.$phone_number_form_textarea[$i].'")';
			$id_phone_number = $db->QueryWithoutResult($query_string, true);
			$query_string = 'INSERT INTO clients_phone (id_client, id_phone_number) VALUES ('.$data['id'].', '.$id_phone_number.')';
			$db->QueryWithoutResult($query_string);
		}
	}
}



?>
