<?php // MMMOWWW ?>
<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<h1>Авторизация</h1>
<?var_dump($AuthorizationData);?>

<?$form=ActiveForm::begin(['class'=>'form-horizontal'])?>
<?= $form->field($AuthorizationData,'username')->textInput()?>
<?= $form->field($AuthorizationData,'password_hash')->passwordInput()?>


                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

<?\yii\bootstrap\ActiveForm::end();?>

<a href ="http://teamfront/index.php?r=userauthorization/authorization" >1</a>