<?php
	require "controller.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Клиенты</title>
</head>
<body>
	<form action="index.php" method="post" style="width: 50%; float: left">
		<p>Добавить клиента</p>
		<label for="name">Имя:</label>
		<p><input id="name" type="text" name="name"></p>
		<label for="second_name">Фамилия:</label>
		<p><input id="second_name" type="text" name="second_name"></p>
		<label for="patronymic">Отчество</label>
		<p><input id="patronymic" type="text" name="patronymic"></p>
		<label for="date">Дата рождения</label>
		<p><input id="date" type="date" name="born_date"></p>
		<p><input name="gender" type="radio" value="true" checked="true"><span>Мужчина</span><input name="gender" type="radio" value="false"><span>Женщина</span></p>
		<label for="date">Телефоны(через запятую)</label>
		<p><textarea id="phone_number" name="phone_number"></textarea></p>
		<input type="hidden" value="add" name="type">
		<input type="submit" value="Добавить">
	</form>
	<div style="width: 50%; float: left">
	<form action="index.php" method="post">
	  	<label for="search">Поиск</label>
	  	<p><input name="search_type" type="radio" value="second_name" checked="true"><span>По фамилии</span><input name="search_type" type="radio" value="phone_number"><span>По номеру телефона</span></p>
	  	<input id="search" type="text" name="query">
	  	<input id="hidden" type="hidden" value="search" name="type">
		<input type="submit" value="Поиск">
	</form>
	<form action="index.php" method="post">
	  	<input id="hidden" type="hidden" value="list" name="type">
		<input type="submit" value="Список" style="margin-top: 5px;">
	</form>
	<?php
		switch ($_POST['type']) {
			case 'search':
				Search();
				break;
			case 'list':
				GetAllClients();
				break;
	?>
	</div>
</body>
</html>

<?php

			case 'add':
				Add($_POST);
				break;
			case 'change':
				Change();
				break;
		}
?>
