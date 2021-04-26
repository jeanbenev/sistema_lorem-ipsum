<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjetoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projeto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_projeto') ?>

    <?= $form->field($model, 'data_cadastro') ?>

    <?= $form->field($model, 'nome_projeto') ?>

    <?= $form->field($model, 'data_inicio') ?>

    <?= $form->field($model, 'data_termino') ?>

    <?php // echo $form->field($model, 'valor_projeto') ?>

    <?php // echo $form->field($model, 'risco') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
