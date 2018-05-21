<?php
	require "controller.php";
	/*
	Я попытался реализовать MVC паттерн. В файлах index.php и change_values.php находятся "представления".
	Согласно заданию использовались только чистый php и mysql, без js. Из - за ограничености инструментов
	пришлось осуществлять работу с телефонами через textarea. Возможно, это не лучший вариант. Для хранения телефонов реализована связь многие ко многим.
	*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Клиенты</title>
</head>
<body>
	<div style="display: inline-block; width: 100%;">
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
			/*
			С помощью скрытого инпута type определяется из какой 
			формы пришел запрос
			*/
			switch ($_POST['type']) {
				case 'search':
					Search(); // метод из файла controller.php
					break;
				case 'list':
					GetAllClients(); // метод из файла controller.php
					break;
				case 'add':
					Add(); // метод из файла controller.php
					break;
				case 'change':
					Change(); // метод из файла controller.php
					break;
				default:
					break;
			}
		?>
		</div>
	</div>
</body>
</html>
