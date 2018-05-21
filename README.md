Проект запускался на линукс+apache. Для работы необходымы: apache, mysql, php. 
Для установки необходимо выполнить в терминале команды:

```
sudo apt install tasksel
sudo tasksel install lamp-server
```

После этого нужно переместить файлы в директорию var/www/html. Приложение будет доступно по адресу localhost.
Создать базу данных с тестовыми данными можно из дампа dump.sql. Для этого нужно создать чистую базу данных. Поселедовательность команд:

```
mysql -u*login* -p*pass*
create datebase *dbname*
exit
mysql -u*login* -p*pass* *dbname* < dump.sql
```

После этого надо изменить данные для соединения с базой данных в файле settings.php.

