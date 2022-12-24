<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>


<!-- <div id="min"></div> -->
<!-- <input type="submit" name="send" onload="CBR_XML_Daily_Ru()"> -->



<form name="myForm" method="post">
    <select name="language" size="5">
        <option value="USD" selected="selected">USD</option>
        <option value="EUR">EUR</option>
        <option value="CHF">CHF</option>
        
    </select>


<div id="selection"></div>
<div id="usd" name="usd" style="display: none;"></div>
<div id="eur" style="display: none;"></div>
<div id="chf" style="display: none;"></div>
<input type="submit" name="send">
</form>
<script>
	let url = 'https://www.cbr-xml-daily.ru/latest.js';


fetch(url)
.then(res => res.json())
.then((out) => {
  var USD = out.rates.USD;
  var EUR = out.rates.EUR;
  var CHF = out.rates.CHF;

 var USD = 1 / USD;
  var EUR = 1 / EUR;
  var CHF = 1 / CHF;
 
document.getElementById("usd").innerHTML = USD;
document.getElementById("eur").innerHTML = EUR;
document.getElementById("chf").innerHTML = CHF;
 
})
.catch(err => { throw err });
var languagesSelect = myForm.language;
 
function changeOption(){
     
    var selection = document.getElementById("selection");
    var selectedOption = languagesSelect.options[languagesSelect.selectedIndex];
    selection.textContent = "Вы выбрали: " + selectedOption.text;
  if(selectedOption.text == "USD"){

  	document.getElementById("selection").innerHTML = "Курс: "+document.getElementById("usd").innerHTML;

  }else if(selectedOption.text == "CHF"){
  		document.getElementById("selection").innerHTML = "Курс: "+document.getElementById("chf").innerHTML;
  	
  }else if(selectedOption.text == "EUR"){
  		document.getElementById("selection").innerHTML = "Курс: "+document.getElementById("eur").innerHTML;
  }
}
 
languagesSelect.addEventListener("change", changeOption);
</script>

<script>
// function CBR_XML_Daily_Ru(rates) {

    
//   var USDrate = rates.Valute.USD.Value.toFixed(4).replace('.', ',');
//   var EURrate = rates.Valute.EUR.Value.toFixed(4).replace('.', ',');
//   var CHFrate = rates.Valute.CHF.Value.toFixed(4).replace('.', ',');
// document.getElementById("min").innerHTML = CHFrate;

//responseObj = readJsonFromUrl('https://www.cbr-xml-daily.ru/latest.js');

 
</script>
<!-- <link rel="dns-prefetch" href="https://www.cbr-xml-daily.ru/" /> -->
<!-- <script src="//www.cbr-xml-daily.ru/daily_jsonp.js" async></script> -->

</body>
</html>

<?php 
require_once 'database.php';
if(isset($_POST['send'])){
$name_val = mysqli_real_escape_string($link, $name_val);
 //Проверяем, если ли подписчик в таблице subscriders
	
	$query = "SELECT * FROM kurs ";
	$result = mysqli_query($link, $query);



	if(!mysqli_num_rows($result)){
	

		$insert_query = "INSERT INTO kurs (`Name_val`, `Date`) VALUES ('$name_val', '$date')";
		$result = mysqli_query($link, $insert_query);
		if($result){
			return 'created';
			echo "created";
		}else{
			return 'failed';
			echo "failed";
		}

	}else{
		return 'exist';
	}

}