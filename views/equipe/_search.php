<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EquipeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipe-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_equipe') ?>

    <?= $form->field($model, 'data_cadastro') ?>

    <?= $form->field($model, 'fk_id_projeto') ?>

    <?= $form->field($model, 'fk_id_participante') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
