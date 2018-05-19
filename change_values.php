<?php
	require "controller.php";

    if ($_POST['action'] == 'edit')
    {
    	Change();
    }
    if ($_POST['action'] == 'delete')
    {
    	Delete();
    }
    else
    {
		$data = $_POST;
		$db = new DataBase();
		$query_string = 'SELECT id, name, second_name, patronymic, born_date, gender FROM client WHERE id='.$data['id'];
		$over_result = $db->QueryWithResult($query_string);
		$query_string = 'SELECT phone_number FROM phone_number, clients_phone WHERE clients_phone.id_phone_number = phone_number.id AND clients_phone.id_client='.$data['id'];
		$phone_numbers = $db->QueryWithResult($query_string);
		$phone_numbers_array = array();
		foreach ($phone_numbers as $key => $value) {
			$phone_numbers_array[] = $value['phone_number'];
		}
		$phone_numbers = implode(",", $phone_numbers_array);
		var_dump($phone_numbers);
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Клиенты</title>
</head>
<body>
<form action="change_values.php" method="post">
	<p>Карточка клиента</p>
	<label for="name">Имя:</label>
	<p><input id="name" type="text" name="name" value="<?php echo $over_result[0]['name']?>"></p>
	<label for="second_name">Фамилия:</label>
	<p><input id="second_name" type="text" name="second_name" value="<?php echo $over_result[0]['second_name']?>"></p>
	<label for="patronymic">Отчество</label>
	<p><input id="patronymic" type="text" name="patronymic" value="<?php echo $over_result[0]['patronymic']?>"></p>
	<label for="date">Дата рождения</label>
	<p><input id="date" type="date" name="born_date" value="<?php echo $over_result[0]['born_date']?>"></p>
	<p><input name="gender" type="radio" value="true" <?php if ($over_result[0]['gender'] == 1) echo 'checked="true"'; ?>><span>Мужчина</span>
		<input name="gender" type="radio" value="false" <?php if ($over_result[0]['gender'] == 0) echo 'checked="true"'; ?>><span>Женщина</span></p>
	<label for="date">Телефоны(через запятую)</label>
	<p><textarea id="phone_number" name="phone_number"><?php echo $phone_numbers; ?></textarea></p>
	<p><input name="action" type="radio" value="edit" checked="true"><span>Изменить</span><input name="action" type="radio" value="delete"><span>Удалить</span></p>
	<input id="id" type="hidden" value="<?php echo $over_result[0]['id']?>" name="id">
	<input type="submit" value="Изменить/Удалить">
</form>
</body>
</html>
