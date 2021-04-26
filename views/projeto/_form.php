<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\number\NumberControl;
// use yii\widgets\MaskedInputAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Projeto */
/* @var $form yii\widgets\ActiveForm */

// MaskedInputAsset::register($this);
// $this->registerJs('jQuery("#projeto-data_inicio").inputmask({mask: "999-999-9999"});');
?>


<div class="projeto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_projeto')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'data_inicio')->widget(DatePicker::class, 
        [
            'options' =>[
                'readonly'  => 'readonly',
            ],
            'clientOptions' => [
                'format'            => 'dd/mm/yyyy',
                'language'          => 'pt',
                'autoclose'         => true,
                'todayHighlight'    => true,
                'orientation'       => 'bottom auto',
                'clearBtn'          => true,
            ],
        ]);
    ?>

    <?= $form->field($model, 'data_termino')->widget(DatePicker::class, 
        [
            'options' =>[
                'readonly'  => 'readonly',
            ],
            'clientOptions' => [
                'format'            => 'dd/mm/yyyy',
                'language'          => 'pt',
                'autoclose'         => true,
                'todayHighlight'    => true,
                'orientation'       => 'bottom auto',
                'clearBtn'          => true,
            ],
        ]); 
    ?>

    <? // $form->field($model, 'valor_projeto')->textInput() ?>
    <?= $form->field($model, 'valor_projeto')->widget(NumberControl::classname(), 
        [
            'maskedInputOptions' => [
                'prefix' => 'R$ ',
                'suffix' => '',
                'groupSeparator' => '.',
                'radixPoint' => ',',
                'digits' => 2,
                'rightAlign' => false,
                'max' => 10000000
            ],
            'options' => [
                'type' => 'text', 
                'readonly' => true, 
                'maxlenght' => 10,
            ],
            /*'saveInputContainer' => [
                'class' => 'kv-saved-cont'
            ]*/
        ]);
    ?>

    <?= $form->field($model, 'risco')
        ->dropDownList(
            [
                '0'=>'0 - Baixo',
                '1'=>'1 - Mediano',
                '2'=>'2 - Alto',
            ],       
            ['prompt'=>'..:: Selecione o Risco ::..']    // options
        ); ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
