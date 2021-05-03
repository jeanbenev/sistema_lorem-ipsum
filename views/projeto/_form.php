<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\number\NumberControl;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Projeto */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs('$("#projeto-valor_projeto").change(function(){
    if($("#projeto-valor_projeto").val() > 10000000){
        $("#projeto-valor_projeto").val(10000000);
    }
})');
$this->registerCSS('.select2-search__field{
    margin-left: 11px;
}');
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
            'options' => [
                'type' => 'text', 
                'readonly' => true, 
                'maxlenght' => 10,
            ],
            'maskedInputOptions' => [
                'prefix' => 'R$ ',
                'suffix' => '',
                'groupSeparator' => '.',
                'radixPoint' => ',',
                'digits' => 2,
                'rightAlign' => false,
                'max' => 10000000,
                'min' => 1000,
            ],
            // 'displayOptions' => [
            //     'class' => 'form-control kv-monospace',
            //     'placeholder' => '..:: Digite um valor no máximo R$ 10.000.000 ::..'
            // ],
            // 'saveInputContainer' => [
            //     'class' => 'kv-saved-cont',
            //     'maxlenght' => 10,
            // ],
        ]);
    ?>

    <?= $form->field($model, 'risco')->dropDownList($model->getRiscoOptions(), ['prompt'=>'..:: Selecione o Risco ::..']); ?>

    <?= $form->field($model, 'participantes')->widget(Select2::classname(), [
        'data' => $model->getParticipantes(),
        'options' => ['placeholder' => '..:: Selecione os Participantes ::..'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ]);
    ?>
    
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
