<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParticipanteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="participante-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_participante') ?>

    <?= $form->field($model, 'data_cadastro') ?>

    <?= $form->field($model, 'nome_participante') ?>

    <?= $form->field($model, 'cargo') ?>

    <?= $form->field($model, 'ingresso') ?>

    <?php // echo $form->field($model, 'salario') ?>

    <?php // echo $form->field($model, 'grau_eficiencia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
