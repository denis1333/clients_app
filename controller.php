<?php  

require 'db_settings.php';
require 'db.php';

/*
Функция Add служит для добавления данных из формы в бд. 
*/
function Add()
{
	$db = new DataBase(); // объект для работы с базой данных
	$data = $_POST;
	$phone_list = explode(",", $data['phone_number']); // телефоны перечисленные в textarea через запятую, этот метод преобразует строку в массив с номерами
	if ($data['name'] != NULL && $data['second_name'] != NULL && $data['patronymic'] != NULL & $data['gender'] != NULL && $data['born_date'] != NULL)//проверка на пустые поля
	{
		$query_string = 'INSERT INTO client (name, second_name, patronymic, gender, born_date) VALUES ("'.$data['name'].'", "'.$data['second_name'].'", "'.$data['patronymic'].'", '.$data['gender'].', "'.$data['born_date'].'")';
		$id_client = $db->QueryWithoutResult($query_string, true); // добавление новой записи о пользователе
		for ($i=0; $i < count($phone_list); $i++) { // весь блок кода проверяет, есть ли такой телефон в бд и если есть то присваивает его пользователю иначе добавляет и присваивает
			$query_string = 'SELECT id FROM phone_number WHERE phone_number ="'.$phone_list[$i].'"';
			$id_phone_number = $db->QueryWithResult($query_string);
			if ($id_phone_number)
			{
				$query_string = 'INSERT INTO clients_phone (id_client, id_phone_number) VALUES ('.$id_client.', '.$id_phone_number[0]['id'].')';
				$db->QueryWithoutResult($query_string);
			}
			else
			{
				$query_string = 'INSERT INTO phone_number (phone_number) VALUES ("'.$phone_list[$i].'")';
				$id_phone_number = $db->QueryWithoutResult($query_string, true);
				$query_string = 'INSERT INTO clients_phone (id_client, id_phone_number) VALUES ('.$id_client.', '.$id_phone_number.')';
				$db->QueryWithoutResult($query_string);
			}
		}
	}
	else{
		echo 'null value';
	}
}
/*
	Поиск по фамилии или номеру телефона
*/
function Search()
{
	$query = $_POST['query'];
	$search_type = $_POST['search_type'];
	$db = new DataBase();
	if ($search_type == "second_name") // запрос для поиска по фамилии
		$query_string = 'SELECT id, name, second_name, patronymic FROM client WHERE second_name="'.$query.'"';
	if ($search_type == "phone_number") // запрос для поиска по номеру телефона
		$query_string = 'SELECT DISTINCT client.id, name, second_name, patronymic FROM client, phone_number, clients_phone WHERE clients_phone.id_client = client.id AND clients_phone.id_phone_number = (SELECT id FROM phone_number WHERE phone_number = "'.$query.'")';
	$over_result = $db->QueryWithResult($query_string);
	$display = '<form action="change_values.php" method="post"><div style="height: 300px; overflow-y: scroll;">'; // генерация html кода для списка всех пользователей
	for ($i = 0; $i < count($over_result); $i++)
		$display = $display.'<p>'.$over_result[$i]['name'].' '.$over_result[$i]['second_name'].' '.$over_result[$i]['patronymic'].' '.'<input name="id" type="radio" value="'.$over_result[$i]['id'].'"></p>';
	$display = $display.'</div><input type="submit" value="Посмотреть карточку"></form>';
	echo($display);
}

/*
	Получить список всех клиентов и сгенерировать html код
*/
function GetAllClients()
{
	$db = new DataBase();
	$query_string = 'SELECT id, name, second_name, patronymic FROM client';
    $over_result = $db->QueryWithResult($query_string);
	$display = '<form action="change_values.php" method="post"><div style="height: 300px; width: 300px; overflow-y: scroll;">';
	for ($i = 0; $i < count($over_result); $i++)
		if ($i == 0) // для первого элемента в списке установить значение checked для radio
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

/*
	Функция для изменения данных о клиенте
*/
function Change()
{
	$data = $_POST;
    if ($data['name'] != NULL && $data['second_name'] != NULL && $data['patronymic'] != NULL & $data['gender'] != NULL && $data['born_date'] != NULL)//проверка на пустые поля
	{
		$db = new DataBase();
		$query_string = 'UPDATE client SET name ="'.$data['name'].'", second_name ="'.$data['second_name'].'", patronymic ="'.$data['patronymic'].'", gender = '.$data['gender'].', born_date = "'.$data['born_date'].'" WHERE id ='.$data['id']; // обновления данных о клиенте
		$db->QueryWithoutResult($query_string);
		$query_string = 'SELECT id, name, second_name, patronymic, born_date, gender FROM client WHERE id='.$data['id']; // новая информация для заполнения полей
		$over_result = $db->QueryWithResult($query_string);
		$phone_number_form_textarea = explode(',', $data['phone_number']);
		$query_string = 'DELETE FROM clients_phone WHERE id_client ='.$data['id']; //удаление привязки телефонов к клиенту
		$db->QueryWithoutResult($query_string);
		for ($i=0; $i < count($phone_number_form_textarea); $i++) // проверка на содержание номера в бд
		{ 
			$query_string = 'SELECT id FROM phone_number WHERE phone_number ="'.$phone_number_form_textarea[$i].'"';
			$id_phone_number = $db->QueryWithResult($query_string);
			if(!$id_phone_number)
			{
				$query_string = 'INSERT INTO phone_number (phone_number) VALUES ("'.$phone_number_form_textarea[$i].'")';
				$id_phone_number = $db->QueryWithoutResult($query_string, true);
				$query_string = 'INSERT INTO clients_phone (id_client, id_phone_number) VALUES ('.$data['id'].', '.$id_phone_number.')';
				$db->QueryWithoutResult($query_string);
			}
			else
			{
				$query_string = 'INSERT INTO clients_phone (id_client, id_phone_number) VALUES ('.$data['id'].', '.$id_phone_number[0]['id'].')';
				$db->QueryWithoutResult($query_string);
			}
		}
		$query_string = 'SELECT phone_number FROM phone_number, clients_phone WHERE clients_phone.id_client='.$data['id']; // выборка новых данных для заполнения полей
		$phone_numbers = $db->QueryWithResult($query_string);
		$phone_numbers_array = array();
		foreach ($phone_numbers as $key => $value) 
		{
			$phone_numbers_array[] = $value['phone_number'];
		}
		$phone_numbers = implode(",", $phone_numbers_array);
	}
}



?>
