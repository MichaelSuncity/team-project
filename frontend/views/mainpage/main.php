<?php
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>';
echo "<h1>Добро пожаловать в менеджер финансов</h1>";
echo "<h2>Список последних зарегистрированных</h2>";
?>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Имя пользователя</th>
      <th scope="col">Дата регистрации</th>
    </tr>
  </thead>
<?
$i = 0;
foreach($userLastRegisteredresult as $renderResult){
	$i++;
echo '<tbody>';
echo '    <tr>';
echo '      <th scope="row">'.$i.'</th>';
echo '      <td>'.$renderResult["username"].'</td>';
echo '      <td>'.$renderResult["created_at"].'</td>';
echo '     </tr>';
echo '   </tbody>';
}

?>

  
</table>
<h2>Мы предоставляем лучший менеджмент ваших и не только ваших финансов</h2>
<table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Валютная пара</th>
      <th>Цена</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td class = "eur/usd">eur/usd</td>
      <td class = "PriceEurUsd">Цена</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td class = "gpb/usd">gpb/usd</td>
      <td class = "PriceGpbUsd">Цена</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td class = "usd/cad">usd/cad</td>
      <td class = "PriceUsdCad">цена</td>
    </tr>
  </tbody>
</table>
<script type="text/javascript">

var EurUsd;
var GbpUsd;
var UsdCad;
var i = 0;
const urlAjax = "https://quotes.instaforex.com/api/quotesTick";
	var timerId = setTimeout(function tick() {
		$.ajax({
  			url: urlAjax,
  			success: function(data){
    		
    		EurUsd = data[0]; // eurUsd
    		GbpUsd = data[1];  //gpbusd
    		UsdCad = data[4];  //usccad
    		$('.PriceEurUsd').text(EurUsd.bid);
  			$('.PriceGpbUsd').text(GbpUsd.bid);
  			$('.PriceUsdCad').text(UsdCad.bid);
  				}});
		  	i++; 
			console.log(i);
  			
  			
  			timerId = setTimeout(tick, 2000); // (*)
			}, 2000);

</script>