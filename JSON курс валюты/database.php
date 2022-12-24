<?php


$link = mysqli_connect('localhost', 'root', 'root', 'money');


if(mysqli_connect_errno()){
	echo 'Ошибка в подключении к БД ('.mysqli_connect_errno().'): '.mysqli_connect_error();
	exit();
}