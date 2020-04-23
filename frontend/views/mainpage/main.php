<?php
use yii\helpers\Html;
use yii\helpers\Url;
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>';
echo "<h1>Добро пожаловать в менеджер финансов</h1>";
echo "<h2>Новости</h2>";
?>

<table class="table table-dark">
  <thead>
    <tr>
     
     <th scope="col">#</th>
     <th scope="col">Header</th>
     <th scope="col">News</th>
     <th scope="col">Author</th>
     <th scope="col">Type_News</th>
     <th scope="col">Date</th>



    </tr>
  </thead>
<?
$i = 0;
echo '<tbody>';
foreach($News as $renderNews){
if($i == 0){
  echo '<style>
  </style>';
echo '      <tr>';
echo '      <th scope="row"> <div class = "HotNews"'.$i.' </div></th>';
echo '      <td> <div class = "HotNews"'.$renderNews["Header"].' </div></td>';
echo '      <td> <div class = "HotNews"'.$renderNews["News"].' </div></td>';
echo '      <td> <div class = "HotNews"'.$renderNews["Author"].' </div></td>';
echo '      <td> <div class = "HotNews"'.$renderNews["Type_News"].' </div></td>';
echo '      <td> <div class = "HotNews"'.$renderNews["Date"].' </div></td>';
};
$i++;
echo '      <tr>';
echo '      <th scope="row">'.$i.'</th>';
echo '      <td>'.$renderNews["Header"].'</td>';
echo '      <td>'.$renderNews["News"].'</td>';
echo '      <td>'.$renderNews["Author"].'</td>';
echo '      <td>'.$renderNews["Type_News"].'</td>';
echo '      <td>'.$renderNews["Date"].'</td>';


}
echo '   </tbody>';
?>

</table>
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
  
echo '<tbody>';
echo '    <tr>';
echo '      <th scope="row">'.$i.'</th>';
echo '      <td>'.$renderResult["username"].'</td>';
echo '      <td>'.$renderResult["created_at"].'</td>';
echo '     </tr>';
echo '   </tbody>';
$i++;
}

?>
<h2>Мы предоставляем лучший менеджмент ваших и не только ваших финансов</h2>
<h2>Список последних зарегистрированных</h2>
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