<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjetoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJs("$('.modalButton').click(function(){
    $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
});");

$this->title = 'Projetos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="projeto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Projeto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php 
    Modal::begin([
        'header' => '<h1>Simular Investimento</h1>',
        'footer' => 
            '<button class="btn btn-warning" onclick="$(\'#w0\').submit();">Simular Investimento</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id_projeto',
            'data_cadastro',
            'nome_projeto',
            'data_inicio',
            'data_termino',
            // 'valor_projeto',
            [
                'label' => 'Número de Dias',
                'value' => function ($data) {
                    return $data->calcularQuantidadeDiasEntreDuasDatas()." dia(s)"; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],
            [
                'label' => 'Risco',
                'attribute' => 'risco',
                'value' => function ($data) {
                    return $data->getRiscoText(); // $data['name'] for array data, e.g. using SqlDataProvider.
                },
                'filter' => $searchModel->getRiscoOptions(),
                'filterInputOptions' => ['prompt' => '..:: Selecione o Risco ::..', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Valor do Projeto',
                'attribute' => 'valor_projeto',
                'value' => function ($data) {
                    return $data->valorProjetoFormatado(); // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete} {download}',
                'buttons'=>[
                    'download' => function ($url, $model) {     
                        return Html::a('<span class="glyphicon glyphicon-usd"></span>', '#', [
                            'title' => Yii::t('yii', 'Simular Investimento'),
                            'class' => 'modalButton',
                            'value' => Url::to('simular-investimento/?id='.$model->id_projeto),
                            'onclick' => 'return false;'
                        ]);                                
                    }
                ],
            ],
        ],
    ]); ?>


</div>
