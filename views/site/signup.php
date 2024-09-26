<?php
/** @var yii\web\View $this */
/** @var string $content */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Signup';

?>

<div class="signup-form">
    <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>

    <?= $form->field($model, 'username')->textInput(['class' => 'form-control'])->label('Username') ?>
    <?= $form->field($model, 'email')->textInput(['class' => 'form-control'])->label('Email') ?>
    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control'])->label('Password') ?>

    <div class="form-group">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-success w-100', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>