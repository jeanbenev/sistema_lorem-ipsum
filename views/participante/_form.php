<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Participante */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="participante-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_participante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cargo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
