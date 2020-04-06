<?php /// MMMOWWW
use yii\helpers\Url
?>
<h1>Добро пожаловать мой юный друг</h1>
<?

$TESTURL=Url::to('user/user');
echo '<a href = "'.$TESTURL.'">test</a>';
echo "</br>";
try {
 foreach($user as &$currentuser){
 	echo "Ваш номер </br>";
 	echo $currentuser["id"];
 	echo "</br> Ваше имя </br>";
 	echo $currentuser["username"];
 	echo "</br> Ваша фамилия </br>";
 	echo $currentuser["subname"];
 	echo "</br> Ваш электроный ящик </br>";
 	echo $currentuser["email"];
 	echo "</br> Дата создания вашего акаунта </br>";
 	echo $currentuser["created_at"];
 	echo "</br> Дата изменения акаунта </br>";
 	echo $currentuser["updated_at"];
 	echo "</br>";
 }
} catch(Exception $e) {
	echo "Ошибочка в следующем : ".$e;

}finally{
	if(2=>count($user)){
		echo "Внимание есть 2 и более похожих акаунта";
		echo "Обратись к администратуру";
	};
	
}





?>
