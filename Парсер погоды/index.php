
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>For 1C</title>
</head>
<body style="padding: 20px; font-family: Arial, sans-serif; ">

	<form action="" method="post">
		<label>Введите город</label><br>
		<input type="text" placeholder="Москва" name="city"><br><br>
		<label>Дата</label><br>
		<input type="date" name="date" id="datePicker"><br><br>
		<input type="submit" value="Загрузить" name="send"><br><br>


	</form>

<script type="text/javascript">
	var today = moment().format('DD-MM-YYYY');
document.getElementById("datePicker").value = today;</script>

<?php 

require_once 'simplehtmldom/simple_html_dom.php';
if(isset($_POST['send'])){

if($_POST['city'] == ""){
	echo "Введите город!";
}else{
$city = trim($_POST['city']);
$city = mb_strtolower($city);
$date = $_POST['date'];

$html = file_get_html('https://sinoptik.com.ru/погода-'.$city."/".$date);
$news = $html->find("div.header__bottom_title");

$opic = $html->find("div.weather__article_description-text");
$temp = $html->find("div.table__temp");
echo $news[0]."На ".$date;
echo "<br>Температура: ".$temp[0];
echo $opic[0];
}
}


?>


 
</body>
</html>