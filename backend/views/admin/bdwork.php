<? // MMMOWWW // Недаработан
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<?
var_dump($tableCount);
echo "</br>";
//var_dump($ANSWER);
var_dump($Table[0]["Tables_in_myfinance"]);

?>
<?  Url::toRoute(['admin/bdwork','SQL' => ['SELECT','*','FROM','`user`','WHERE','id' =>1]]); ?>
<?php $form = ActiveForm::begin(); ?>
				<h2>Введите первое значение</h2>
                <?= $form->field($model, 'qvery')->textInput() ?>
                <h2>Введите Полную команду</h2>
                <?= $form->field($model, 'comand')->textInput() ?>
                
                <div class="form-group">
                <?= Html::submitButton('WorkComand', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>