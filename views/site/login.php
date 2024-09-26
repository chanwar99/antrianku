<?php
/** @var yii\web\View $this */
/** @var string $content */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';

?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>
<div class="login-form">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

    <?= $form->field($model, 'username')->textInput(['class' => 'form-control'])->label('Username') ?>
    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control'])->label('Password') ?>

    <div class="form-group">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
    </div>

    <div class="text-center mt-3">
        <p>Belum memiliki akun? <?= Html::a('Registrasi di sini', ['site/signup'], ['class' => 'link-primary']) ?></p>
    </div>

    <?php ActiveForm::end(); ?>
</div>