<?php /// MMMOWWW ?>
<h1>Регистрация</h1>
<? /*var_dump($RegistrationData);*/?>
<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<?var_dump($test);?>

<?$form=ActiveForm::begin(['class'=>'form-horizontal'])?>
<?= $form->field($RegistrationData,'username')->textInput()?>
<?= $form->field($RegistrationData,'email')->textInput()?>
<?= $form->field($RegistrationData,'password1')->passwordInput()?>
<?= $form->field($RegistrationData,'password2')->passwordInput()?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

<?\yii\bootstrap\ActiveForm::end();?>
