<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Projeto */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs('
    //Exibir o alert somente quando houver mensagem
    $(document).on("pjax:complete", function() {
        $("#feedback_mensagem").removeClass("hidden");
    })
');
?>

<?php Pjax::begin(['enablePushState' => false]); ?>
    <div class="projeto-form">
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
            <?= $form->field($model, 'risco')->dropDownList($model->getRiscoOptions(), ['prompt'=>'..:: Selecione o Risco ::..', 'disabled' => true,]); ?>
            <div class="form-group field-projeto-participantes required">
                <?= Html::label('Valor Projeto', 'valor_projeto', ['class' => 'control-label']) ?>
                <?= Html::input('text', 'valor_projeto', $model->valorProjetoFormatado(), ['class' => 'form-control', 'readonly' => true,]) ?>
            </div>
            <?= $form->field($model, 'participantes')->widget(Select2::classname(), [
                'data' => $model->getParticipantes(),
                'maintainOrder' => true,
                'options' => [
                    'placeholder' => '..:: Selecione os Participantes ::..',
                    'readonly' => 'true',
                    'disabled' => true,
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true
                ],
            ]);
            ?>
            <?= $form->field($model, 'valor_investimento_simulacao')->widget(NumberControl::classname(), 
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
            <?php ActiveForm::end(); ?>

            <div id="feedback_mensagem" class="hidden alert alert-<?= $feedback['status']?>" role="alert">
                <p class="text-center">
                    <?= $feedback['mensagem']; ?>
                </p>
            </div>
    </div>
<?php Pjax::end(); ?>