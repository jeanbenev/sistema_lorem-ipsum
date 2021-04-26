<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_cadastro')->textInput() ?>

    <?= $form->field($model, 'fk_id_projeto')->textInput() ?>

    <?= $form->field($model, 'fk_id_participante')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
